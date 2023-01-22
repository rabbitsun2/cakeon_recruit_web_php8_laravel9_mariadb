<?php
/*
    Filename: CareerController.php
    Created Date: 2023-01-12(Fri)
    Author: Doyoon Jung (rabbitsun2@gmail.com)
    Description: 
    1. 초기 생성, 2023-01-12, Doyoon Jung.

*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Library\CaptchaFn;
use App\Library\PagingLogic;                // 사용자 정의 - 페이징 알고리즘 추가
use App\Library\PageCriteria;
use App\Library\BoardFn;
use App\Library\NetworkFn;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


use Session;

class CareerController extends Controller
{

    public function __construct(){



    }

    //
    public function index(){

        $data['title'] = "커리어(Career) / CAKEON Project";

        $country_sql = "select * from cakeon_career_country order by country_id";        
        $country_value = DB::select($country_sql);
        
        // $tmp_country = ["대한민국", "미국", "캐나다", "호주", "베트남", "영국"];

        $region_sql = "select * from cakeon_career_region order by region_id";
        $region_value = DB::select($region_sql);

        $position_sql = "select * from cakeon_career_position order by position_id";
        $position_value = DB::select($position_sql);

        $job_type_sql = "select * from cakeon_job_type order by job_type_id";
        $job_type_value = DB::select($job_type_sql);

        $relation_sql = "select * from cakeon_career_relation order by relation_id";
        $relation_value = DB::select($relation_sql);

        $corporation_sql = "select * from cakeon_career_corporation order by corp_id";
        $corporation_value = DB::select($corporation_sql);

/*        // 국가별
        $country_kor = array();

        for ($i = 0; $i < sizeof($tmp_country); $i++){
            array_push($country_kor, [
                "country" => $tmp_country[$i],
                "value" => $i + 1
            ]);
        }
*/

        $data['country'] = $country_value;
        $data['region'] = $region_value;
        $data['position'] = $position_value;
        $data['job_type'] = $job_type_value;
        $data['relation'] = $relation_value;
        $data['corporation'] = $corporation_value;

        return view('cakeon/career/index', $data);

    }

    public function career_ok(Request $request){

        $data['title'] = "커리어(Career) / CAKEON Project";

        $response=array('country' => $request->country, 
                        'region' => $request->region,
                        'position' => $request->position,
                        'job_type' => $request->job_type, 
                        'relation' => $request->relation, 
                        'corporation' => $request->corporation); 

        $token = $request->session()->token();
        $token_validate = csrf_token();

        // CSRF 토큰 생성이 잘못되었을 때
        if($token != $token_validate){
            $data['error'] = "오류 - CSRF 토큰 생성이 잘못되었습니다.";
            return redirect()->route('career', $data);
        }

        return redirect()->route('career.list', $response);

    }

    public function list(Request $request){

        
        $country_sql = "select * from cakeon_career_country order by country_id";        
        $country_value = DB::select($country_sql);
        
        // $tmp_country = ["대한민국", "미국", "캐나다", "호주", "베트남", "영국"];

        $region_sql = "select * from cakeon_career_region order by region_id";
        $region_value = DB::select($region_sql);

        $position_sql = "select * from cakeon_career_position order by position_id";
        $position_value = DB::select($position_sql);

        $job_type_sql = "select * from cakeon_job_type order by job_type_id";
        $job_type_value = DB::select($job_type_sql);

        $relation_sql = "select * from cakeon_career_relation order by relation_id";
        $relation_value = DB::select($relation_sql);

        $corporation_sql = "select * from cakeon_career_corporation order by corp_id";
        $corporation_value = DB::select($corporation_sql);

        // 페이징 로직 생성
        $pagingLogic = new PagingLogic();
        $pageCri = new PageCriteria();

        // 전체 게시글 갯수
        $board_total_cnt_qry = "select COUNT(*) AS `cnt`  
                                from cakeon_career_list a 
                                INNER JOIN cakeon_career_country b 
                                    ON a.career_id = b.country_id
                                INNER JOIN cakeon_career_region c 
                                ON a.region_id = c.region_id 
                                INNER JOIN cakeon_career_position d 
                                ON a.position_id = d.position_id 
                                INNER JOIN cakeon_job_type e 
                                    ON a.job_type_id = e.job_type_id
                                INNER JOIN cakeon_career_relation f 
                                ON a.relation_id = f.relation_id
                                INNER JOIN cakeon_career_corporation g 
                                    ON a.corp_id = g.corp_id 
                                INNER JOIN cakeon_member h
                                    ON a.member_id = h.member_id 
                                WHERE a.country_id = :country_id AND 
                                a.region_id = :region_id AND 
                                a.position_id = :position_id AND 
                                a.job_type_id = :job_type_id AND 
                                a.relation_id = :relation_id AND 
                                a.corp_id = :corp_id";

        $board_total_bind['country_id'] = $request->country;
        $board_total_bind['region_id'] = $request->region;
        $board_total_bind['position_id'] = $request->position;
        $board_total_bind['job_type_id'] = $request->job_type;
        $board_total_bind['relation_id'] = $request->relation;
        $board_total_bind['corp_id'] = $request->corporation;

        $board_total_cnt_qry = DB::select($board_total_cnt_qry, $board_total_bind);

        $board_total_cnt = 0;


        if ( isset($request->page) ){
            $page_no = $request->page;
        }else{
            $page_no = 1;
        }

        // 페이지 설정
        if ($page_no >= 0 && 
            is_numeric($page_no)){

            $pageCri->setPage($page_no);
        }
        
        // 전체 갯수
        foreach($board_total_cnt_qry as $item){
            $board_total_cnt = $item->cnt;
        }
        
        // 현재 페이지 구하기
        $page_size = $pageCri->getPerPageNum();
        
        $pagingLogic->setPageNo($page_no);
        $pagingLogic->setPageSize($page_size);
        $pagingLogic->setTotalCount($board_total_cnt);
        
        $pagingObj = $pagingLogic->getObject();
        $start_num = $pagingLogic->getDbStartNum();
        $end_num = $pagingLogic->getDbEndNum();

        // 오라클 페이징(자바 버전)
        //paramMap.put("startnum", startnum);		
        //paramMap.put("endnum", endnum);			
        
        // mariaDB(MySQL) 페이징(PHP 버전)
        if ( $start_num === 1) {
            $_start_num = 0;
        }
        else {
            $_start_num = $start_num - 1;
        }
            
        $_limnum = ( $end_num - $start_num ) + 1;

        $career_paging_qry = "select a.career_id, a.country_id, 
                            b.country_name, a.region_id, 
                            c.region_name, a.position_id,
                            d.position_name, a.job_type_id,
                            e.job_type_name, a.relation_id, 
                            f.relation_name, a.corp_id,
                            g.corp_code, g.corp_name, 
                            a.member_id,
                            h.email, h.nickname, 
                            a.subject, a.content, 
                            a.salary, a.max_cnt, 
                            a.ext_position, 
                            a.open_start_date, a.open_end_date, 
                            a.army_start_hour, a.army_start_min, 
                            a.army_end_hour, a.army_end_min, 
                            a.regidate 
                            from cakeon_career_list a 
                            INNER JOIN cakeon_career_country b 
                                ON a.career_id = b.country_id
                            INNER JOIN cakeon_career_region c 
                                ON a.region_id = c.region_id 
                            INNER JOIN cakeon_career_position d 
                                ON a.position_id = d.position_id 
                            INNER JOIN cakeon_job_type e 
                                ON a.job_type_id = e.job_type_id
                            INNER JOIN cakeon_career_relation f 
                                ON a.relation_id = f.relation_id
                            INNER JOIN cakeon_career_corporation g 
                                ON a.corp_id = g.corp_id 
                            INNER JOIN cakeon_member h
                                ON a.member_id = h.member_id  
                            WHERE a.country_id = :country_id AND 
                            a.region_id = :region_id AND 
                            a.position_id = :position_id AND 
                            a.job_type_id = :job_type_id AND 
                            a.relation_id = :relation_id AND 
                            a.corp_id = :corp_id 
                            ORDER BY a.career_id DESC 
                            LIMIT :lim_num OFFSET :start_num";

        // 채용 바인딩
        $career_binding['country_id'] = $request->country;
        $career_binding['region_id'] = $request->region;
        $career_binding['position_id'] = $request->position;
        $career_binding['job_type_id'] = $request->job_type;
        $career_binding['relation_id'] = $request->relation;
        $career_binding['corp_id'] = $request->corporation;
        $career_binding['lim_num'] = $_limnum;
        $career_binding['start_num'] = $_start_num;

        // 채용 목록 가져오기
        $careerList = DB::select($career_paging_qry, $career_binding);

        // 데이터 값 전송
        $data = Array();
        $data['title'] = "채용 조회 / 커리어(Career) / CAKEON Project";
        $data['career_list'] = $careerList;
        $data['board_paging'] = $pagingLogic;
        
        $data['country'] = $country_value;
        $data['region'] = $region_value;
        $data['position'] = $position_value;
        $data['job_type'] = $job_type_value;
        $data['relation'] = $relation_value;
        $data['corporation'] = $corporation_value;

        return view('cakeon/career/list', $data);

    }

    public function view(Request $request){

        
        $career_id = $request->career_id;

        // 채용 기초 정보 조회
        $career_basic_view_qry = "select a.career_id, a.country_id, 
                                b.country_name, a.region_id, 
                                c.region_name, a.position_id,
                                d.position_name, a.job_type_id,
                                e.job_type_name, a.relation_id, 
                                f.relation_name, a.corp_id,
                                g.corp_code, g.corp_name, 
                                a.member_id,
                                h.email, h.nickname, 
                                a.subject, a.content, 
                                a.salary, a.max_cnt, 
                                a.ext_position, 
                                a.open_start_date, a.open_end_date, 
                                a.army_start_hour, a.army_start_min, 
                                a.army_end_hour, a.army_end_min, 
                                a.regidate 
                                from cakeon_career_list a 
                                INNER JOIN cakeon_career_country b 
                                    ON a.career_id = b.country_id
                                INNER JOIN cakeon_career_region c 
                                    ON a.region_id = c.region_id 
                                INNER JOIN cakeon_career_position d 
                                    ON a.position_id = d.position_id 
                                INNER JOIN cakeon_job_type e 
                                    ON a.job_type_id = e.job_type_id
                                INNER JOIN cakeon_career_relation f 
                                    ON a.relation_id = f.relation_id
                                INNER JOIN cakeon_career_corporation g 
                                    ON a.corp_id = g.corp_id 
                                INNER JOIN cakeon_member h
                                    ON a.member_id = h.member_id   
                                WHERE a.career_id = :career_id";

        $career_basic_bind['career_id'] = $career_id;

        $career_basic_view = DB::select($career_basic_view_qry, $career_basic_bind);

        // 담당자 조회
        $career_dept_view_qry = "SELECT d.career_id, 
                                a.member_id, b.dept_id, 
                                c.dept_name, a.email, 
                                a.passwd, a.nickname, 
                                a.birthdate, a.member_name,
                                a.phone_number, a.auth_id, 
                                a.lock_code, a.failed_cnt, 
                                a.regidate, a.last_accessed_by,
                                a.member_ip 
                                FROM cakeon_member a 
                                INNER JOIN cakeon_dept_member b 
                                    ON a.member_id = b.member_id
                                INNER JOIN cakeon_dept c
                                    ON b.dept_id = c.dept_id
                                INNER JOIN cakeon_career_list d 
                                    ON d.member_id = a.member_id
                                WHERE d.career_id = :career_id";

        $career_dept_bind['career_id'] = $career_id;

        $career_dept_view = DB::select($career_dept_view_qry, $career_dept_bind);

        // 데이터 값 전송
        $data['title'] = "채용 상세 조회 / 커리어(Career) / CAKEON Project";
        $data['career_basic_view'] = $career_basic_view;
        $data['career_dept_view'] = $career_dept_view;

        return view('cakeon/career/view', $data);

    }

    public function apply(Request $request){

        $data['title'] = "채용 입사지원 / 커리어(Career) / CAKEON Project";
        $data['career_id'] = $request->career_id;

        return view('cakeon/career/apply', $data);

    }

    public function signin_ok(Request $request){

        $networkFn = new NetworkFn();

        // 기본 정보 고윳값
        $apply_id = -1;

        // 상태
        $status = 0;

        $data['title'] = "채용 입사지원 / 커리어(Career) / CAKEON Project";
        $data['career_id'] = $request->career_id;

        $basic_info_qry = "select * from cakeon_apply_basic_info " . 
                          "WHERE email = HEX(AES_ENCRYPT(:email, 'cakeon')) AND " . 
                          "passwd = SHA2(:passwd, 256)";

        $basic_info_bind['email'] = $request->email;
        $basic_info_bind['passwd'] = $request->passwd;

        $basic_info_view = DB::select($basic_info_qry, $basic_info_bind);

        foreach($basic_info_view as $item){
            $status = 1;
        }

        // 계정이 존재하지 않을 때
        if ( $status == 0 ){
            
            $message = "계정 정보를 확인하고 다시 시도하세요.";
            
            $data['career_id'] = $request->career_id;
            $data['code'] = 'error';
            $data['message'] = $message;
            $data['url'] = route('career.apply', ['career_id'=> $request->career_id]);

            return view('common/message', $data);

        }
        // 계정이 존재할 때
        else if ( $status == 1 ){
            
            // 세션 저장
            $request->session()->put("apply_member", $basic_info_view);
            //$data['apply_member'] = $request->session()->get('apply_member');
            //$request->session()->forget('apply_member');

            $response = array('career_id' => $request->career_id); 

            $token = $request->session()->token();
            $token_validate = csrf_token();

            // CSRF 토큰 생성이 잘못되었을 때
            if($token != $token_validate){
                $data['error'] = "오류 - CSRF 토큰 생성이 잘못되었습니다.";
                return redirect()->route('career', $data);
            }

            // 접속 기록 업데이트
            $update_basic_info_qry = "update cakeon_apply_basic_info set " . 
                                     "last_accessed_by = :last_accessed_by, " . 
                                     "member_ip = :member_ip WHERE " . 
                                     "apply_id = :apply_id";

            $update_basic_info_bind['last_accessed_by'] = date("Y-m-d H:i:s");
            $update_basic_info_bind['member_ip'] = $networkFn->get_client_ip();
            
            foreach($basic_info_view as $item){
                $apply_id = $item->apply_id;
            }

            $update_basic_info_bind['apply_id'] = $apply_id;
            $results = DB::update($update_basic_info_qry, $update_basic_info_bind);

            return redirect()->route('career.profile', $response);

        }


    }

    public function signup(Request $request){

        $data['title'] = "계정 생성 / 커리어(Career) / CAKEON Project";
        $data['career_id'] = $request->career_id;

        return view('cakeon/career/signup', $data);

    }

    public function signup_ok(Request $request){

        $networkFn = new NetworkFn();

        // 상태
        $status = 1;

        // 비밀번호 일치 여부
        if ($request->passwd1 == $request->passwd2 ){
            $status = 1;
        }else{
            $status = 0;
        }

        // email 또는 phone이 존재할 때(중복 제거)
        if ( $status == 1 ){

            $basic_info_select_qry = "select * from cakeon_apply_basic_info " . 
                                     "WHERE email = HEX(AES_ENCRYPT(:email, 'cakeon')) OR " . 
                                     "phone = HEX(AES_ENCRYPT(:phone, 'cakeon'))";

            $basic_info_select_bind['email'] = $request->email;
            $basic_info_select_bind['phone'] = $request->phone;

            $results = DB::select($basic_info_select_qry, $basic_info_select_bind);

            foreach($results as $item){
                $status = 2;
            }

        }

        // 실패 시
        if ( $status == 0 ){
            $message = "계정 생성에 실패하였습니다.";
            
            $data['career_id'] = $request->career_id;
            $data['code'] = 'error';
            $data['message'] = $message;
            $data['url'] = route('career.signup', ['career_id'=> $request->career_id]);

            return view('common/message', $data);
        }
        // 성공 시
        else if ( $status == 1 ){

            // 기본 정보 생성 쿼리
            $basic_info_insert_qry = "insert into cakeon_apply_basic_info(" . 
                                    "email, name, birthdate, " . 
                                    "passwd, phone, send_ok, " . 
                                    "regidate, last_accessed_by, member_ip) " . 
                                    "VALUES(" . 
                                    "HEX(AES_ENCRYPT(:email, 'cakeon')), :name, :birthdate, " . 
                                    "SHA2(:passwd, 256), HEX(AES_ENCRYPT(:phone, 'cakeon')), :send_ok, " . 
                                    ":regidate, :last_accessed_by, :member_ip)";

            $basic_info_insert_bind['email'] = $request->email;
            $basic_info_insert_bind['name'] = $request->name;
            $basic_info_insert_bind['birthdate'] = $request->birthdate;
            $basic_info_insert_bind['passwd'] = $request->passwd1;
            $basic_info_insert_bind['phone'] = $request->phone;
            $basic_info_insert_bind['send_ok'] = 0;
            $basic_info_insert_bind['regidate'] = date("Y-m-d H:i:s");
            $basic_info_insert_bind['last_accessed_by'] = date("Y-m-d H:i:s");
            $basic_info_insert_bind['member_ip'] = $networkFn->get_client_ip();

            $results = DB::insert($basic_info_insert_qry, $basic_info_insert_bind);

            // 성공
            $message = "계정 생성이 완료되었습니다.";
            
            $data['career_id'] = $request->career_id;
            $data['code'] = 'success';
            $data['message'] = $message;
            $data['url'] = route('career.apply', ['career_id'=> $request->career_id]);

            return view('common/message', $data);

            /*
                try {
                    $decrypted = Crypt::decryptString($encryptedValue);
                } catch (DecryptException $e) {
                    //
                }
            */
        }
        // 중복되었을 때
        else if ( $status == 2 ){

            $message = "이메일 주소 또는 연락처가 중복됩니다.";
            
            $data['career_id'] = $request->career_id;
            $data['code'] = 'error';
            $data['message'] = $message;
            $data['url'] = route('career.signup', ['career_id'=> $request->career_id]);

            return view('common/message', $data);

        }

    }

    private function profile_tbl($apply_id, $data){

        // 공통 쿼리
        $select_profile_qry = "select * from cakeon_apply_profile " . 
                             "where apply_id = :apply_id";

        $select_profile_bind['apply_id'] = $apply_id;

        $result_profile = DB::select($select_profile_qry, $select_profile_bind);

        $data['result_profile'] = $result_profile;

        return $data;

    }

    private function getApply_id($data){
        
        $apply_id = -1;

        foreach($data['apply_member'] as $item){
            $apply_id = $item->apply_id;
        }
        
        return $apply_id;
    }

    public function profile(Request $request){

        $data['title'] = "신상정보 생성 / 커리어(Career) / CAKEON Project";
        $data['career_id'] = $request->career_id;
        $data['apply_member'] = $request->session()->get('apply_member');

        $apply_id = $this->getApply_id($data);
        $data = $this->profile_tbl($apply_id, $data);

        return view('cakeon/career/profile', $data);

    }

    public function profile_ok(Request $request){

        $crud_mode = 1;     // Create: 1, Read: 2, Update: 3, Delete: 4

        // 유효성 검사
        $rules = [
            'apply_id' => 'required',
            'jumin_number' => 'required',
            'address' => 'required',
            'detail_address' => 'required',
            'postcode' => 'required',
        ];
        
        $messages = [
            'apply_id.required' => '지원자 고유값은 필수입니다.',
            'jumin_number.required' => '주민등록번호를 입력하세요.',
            'address.required' => '주소를 입력하세요.',
            'detail_address.required' => '상세주소를 입력하세요.', 
            'postcode.required' => '우편번호를 입력하세요.', 
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data['title'] = "신상정보 생성 / 커리어(Career) / CAKEON Project";
        $data['career_id'] = $request->career_id;
        $data['apply_member'] = $request->session()->get('apply_member');

        $apply_id = $this->getApply_id($data);
        $data = $this->profile_tbl($apply_id, $data);

        foreach($data['result_profile'] as $item){
            $crud_mode = 4;
        }

        // 질의 삭제 수행
        if ( $crud_mode == 4 ){

            $profile_delete_qry = "delete from cakeon_apply_profile " . 
                                  "where apply_id = :apply_id";
            $profile_delete_bind['apply_id'] = $apply_id;
            
            $results = DB::delete($profile_delete_qry, $profile_delete_bind);

            $crud_mode = 1;
        }

        // 질의 추가 수행
        if ( $crud_mode == 1 ){

            $profile_insert_qry = "insert into cakeon_apply_profile(" . 
                                "apply_id, jumin_number, " . 
                                "address, extra_address, detail_address, postcode)" . 
                                " VALUES(" . 
                                ":apply_id, :jumin_number, " . 
                                ":address, :extra_address, " . 
                                ":detail_address, :postcode" . 
                                ")";

            $profile_insert_bind['apply_id'] = $request->apply_id;
            $profile_insert_bind['jumin_number'] = $request->jumin_number;
            $profile_insert_bind['address'] = $request->address;
            $profile_insert_bind['extra_address'] = $request->extra_address;
            $profile_insert_bind['detail_address'] = $request->detail_address;
            $profile_insert_bind['postcode'] = $request->postcode;

            $results = DB::insert($profile_insert_qry, $profile_insert_bind);

        }

        // 성공
        $message = "신상정보 생성이 완료되었습니다.";
        
        $data['career_id'] = $request->career_id;
        $data['code'] = 'success';
        $data['message'] = $message;
        $data['url'] = route('career.education', ['career_id'=> $request->career_id]);

        return view('common/message', $data);

    }

    private function education_tbl($apply_id, $data){

        // 공통 쿼리
        $select_school_qry = "select * from cakeon_apply_education " . 
                             "where apply_id = :apply_id and " . 
                             "education_order = :education_order";

        // 학력 영향 유무
        $select_school_effect_bind['apply_id'] = $apply_id;
        $select_school_effect_bind['education_order'] = 0;

        $result_school_effect = DB::select($select_school_qry, $select_school_effect_bind);

        // 고등학교
        $select_high_school_bind['apply_id'] = $apply_id;
        $select_high_school_bind['education_order'] = 1;

        $result_high_school = DB::select($select_school_qry, $select_high_school_bind);

        // 대학교1
        $select_univ_school1_bind['apply_id'] = $apply_id;
        $select_univ_school1_bind['education_order'] = 2;

        $result_univ_school1 = DB::select($select_school_qry, $select_univ_school1_bind);

        // 대학교2
        $select_univ_school2_bind['apply_id'] = $apply_id;
        $select_univ_school2_bind['education_order'] = 3;

        $result_univ_school2 = DB::select($select_school_qry, $select_univ_school2_bind);

        // 대학교3
        $select_univ_school3_bind['apply_id'] = $apply_id;
        $select_univ_school3_bind['education_order'] = 4;

        $result_univ_school3 = DB::select($select_school_qry, $select_univ_school3_bind);

        // 대학교4
        $select_univ_school4_bind['apply_id'] = $apply_id;
        $select_univ_school4_bind['education_order'] = 5;

        $result_univ_school4 = DB::select($select_school_qry, $select_univ_school4_bind);

        
        // 데이터 가져오기
        $data['result_school_effect'] = $result_school_effect;
        $data['result_high_school'] = $result_high_school;
        $data['result_univ_school1'] = $result_univ_school1;
        $data['result_univ_school2'] = $result_univ_school2;
        $data['result_univ_school3'] = $result_univ_school3;
        $data['result_univ_school4'] = $result_univ_school4;

        return $data;

    }

    public function education(Request $request){

        $data['title'] = "교육사항 / 커리어(Career) / CAKEON Project";
        $data['career_id'] = $request->career_id;
        $data['apply_member'] = $request->session()->get('apply_member');

        $apply_id = $this->getApply_id($data);
        $data = $this->education_tbl($apply_id, $data);

        return view('cakeon/career/education', $data);

    }

    public function education_ok(Request $request){

        $crud_mode = 1;     // Create: 1, Read: 2, Update: 3, Delete: 4

        // 유효성 검사
        $rules = [
            'apply_id' => 'required', 
            'effect_edu' => 'required', 
            'effect_grade_type' => 'required',
        ];
        
        $messages = [
            'apply_id.required' => '지원자 고유값은 필수입니다.', 
            'effect_edu.required' => '학교명을 입력하세요.', 
            'effect_grade_type.required' => '학력 유무를 선택하세요.', 
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        
        $data['title'] = "교육사항 / 커리어(Career) / CAKEON Project";
        $data['career_id'] = $request->career_id;
        $data['apply_member'] = $request->session()->get('apply_member');

        $apply_id = $this->getApply_id($data);
        $data = $this->education_tbl($apply_id, $data);

        // 데이터 존재 유무
        $education_select_qry = "select count(*) as cnt from cakeon_apply_education " . 
                                "where apply_id = :apply_id";

        $education_select_bind['apply_id'] = $request->apply_id;

        $result_education = DB::select($education_select_qry, $education_select_bind);

        foreach($result_education as $item){
            if( $item->cnt == 0 ){
                $crud_mode = 1;
            }else{
                $crud_mode = 4;
            }
        }

        if ( $crud_mode == 4 ){

            $education_delete_qry = "delete from cakeon_apply_education " . 
                                    "where apply_id = :apply_id";
            
            $education_delete_bind['apply_id'] = $request->apply_id;

            $results = DB::delete($education_delete_qry, $education_delete_bind);

            $crud_mode = 1;

        }

        if ( $crud_mode == 1 ){
            
            $education_insert_qry = "insert into cakeon_apply_education(" . 
                                    "apply_id, education_order, school_name, " . 
                                    "start_date, end_date, " . 
                                    "grade_type, " . 
                                    "dept_1, dept_1_type, dept_2, dept_2_type" .
                                    ")" . 
                                    " VALUES(" . 
                                    ":apply_id, :education_order, :school_name, " . 
                                    ":start_date, :end_date, " . 
                                    ":grade_type, " . 
                                    ":dept_1, :dept_1_type, :dept_2, :dept_2_type" . 
                                    ")";

            for ($choose = 0; $choose < 6; $choose++){

                switch($choose){

                    case 0:
                        $education_insert_bind['apply_id'] = $request->apply_id;
                        $education_insert_bind['education_order'] = 0;
                        $education_insert_bind['school_name'] = $request->effect_edu;
                        $education_insert_bind['start_date'] = '9999-01-01';
                        $education_insert_bind['end_date'] = '9999-01-01';
                        $education_insert_bind['grade_type'] = $request->effect_grade_type;
                        $education_insert_bind['dept_1'] = '';
                        $education_insert_bind['dept_1_type'] = '';
                        $education_insert_bind['dept_2'] = '';
                        $education_insert_bind['dept_2_type'] = '';

                        break;

                    case 1:
                        $education_insert_bind['apply_id'] = $request->apply_id;
                        $education_insert_bind['education_order'] = 1;
                        $education_insert_bind['school_name'] = $request->school_name1;
                        $education_insert_bind['start_date'] = $request->school_startdate_1;
                        $education_insert_bind['end_date'] = $request->school_enddate_1;
                        $education_insert_bind['grade_type'] = $request->grade_type_1;
                        $education_insert_bind['dept_1'] = $request->dept_1_1;
                        $education_insert_bind['dept_1_type'] = $request->dept_type_1_1;
                        $education_insert_bind['dept_2'] = $request->dept_2_1;
                        $education_insert_bind['dept_2_type'] = $request->dept_type_2_1;

                        break;
                    
                    case 2:
                        $education_insert_bind['apply_id'] = $request->apply_id;
                        $education_insert_bind['education_order'] = 2;
                        $education_insert_bind['school_name'] = $request->school_name2;
                        $education_insert_bind['start_date'] = $request->school_startdate_2;
                        $education_insert_bind['end_date'] = $request->school_enddate_2;
                        $education_insert_bind['grade_type'] = $request->grade_type_2;
                        $education_insert_bind['dept_1'] = $request->dept_1_2;
                        $education_insert_bind['dept_1_type'] = $request->dept_type_1_2;
                        $education_insert_bind['dept_2'] = $request->dept_2_2;
                        $education_insert_bind['dept_2_type'] = $request->dept_type_2_2;

                        break;

                    case 3:
                        $education_insert_bind['apply_id'] = $request->apply_id;
                        $education_insert_bind['education_order'] = 3;
                        $education_insert_bind['school_name'] = $request->school_name3;
                        $education_insert_bind['start_date'] = $request->school_startdate_3;
                        $education_insert_bind['end_date'] = $request->school_enddate_3;
                        $education_insert_bind['grade_type'] = $request->grade_type_3;
                        $education_insert_bind['dept_1'] = $request->dept_1_3;
                        $education_insert_bind['dept_1_type'] = $request->dept_type_1_3;
                        $education_insert_bind['dept_2'] = $request->dept_2_3;
                        $education_insert_bind['dept_2_type'] = $request->dept_type_2_3;

                        break;

                    case 4:
                        $education_insert_bind['apply_id'] = $request->apply_id;
                        $education_insert_bind['education_order'] = 4;
                        $education_insert_bind['school_name'] = $request->school_name4;
                        $education_insert_bind['start_date'] = $request->school_startdate_4;
                        $education_insert_bind['end_date'] = $request->school_enddate_4;
                        $education_insert_bind['grade_type'] = $request->grade_type_4;
                        $education_insert_bind['dept_1'] = $request->dept_1_4;
                        $education_insert_bind['dept_1_type'] = $request->dept_type_1_4;
                        $education_insert_bind['dept_2'] = $request->dept_2_4;
                        $education_insert_bind['dept_2_type'] = $request->dept_type_2_4;

                        break;

                    case 5:
                        $education_insert_bind['apply_id'] = $request->apply_id;
                        $education_insert_bind['education_order'] = 5;
                        $education_insert_bind['school_name'] = $request->school_name5;
                        $education_insert_bind['start_date'] = $request->school_startdate_5;
                        $education_insert_bind['end_date'] = $request->school_enddate_5;
                        $education_insert_bind['grade_type'] = $request->grade_type_5;
                        $education_insert_bind['dept_1'] = $request->dept_1_5;
                        $education_insert_bind['dept_1_type'] = $request->dept_type_1_5;
                        $education_insert_bind['dept_2'] = $request->dept_2_5;
                        $education_insert_bind['dept_2_type'] = $request->dept_type_2_5;

                        break;

                }

                $results = DB::insert($education_insert_qry, $education_insert_bind);

            }

        }

        // 성공
        $message = "교육사항이 생성되었습니다.";

        $data['career_id'] = $request->career_id;
        $data['code'] = 'success';
        $data['message'] = $message;
        $data['url'] = route('career.education', ['career_id'=> $request->career_id]);

        return view('common/message', $data);

    }


}