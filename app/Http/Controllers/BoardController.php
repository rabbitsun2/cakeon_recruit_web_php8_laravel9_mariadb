<?php
/*
    Filename: BoardController.php
    Created Date: 2022-12-30(Fri)
    Author: Doyoon Jung (rabbitsun2@gmail.com)
    Description: 
    1. 초기 생성, 2022-12-30, Doyoon.

*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Library\PagingLogic;                // 사용자 정의 - 페이징 알고리즘 추가
use App\Library\PageCriteria;
use App\Library\BoardFn;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Session;

class BoardController extends Controller
{

    public function __construct(){

    }

    private function printBoardIsEmpty($boardname){

        $boardFn = new BoardFn();
        $boardFn->setBoardname($boardname);
        
        // 게시판이 존재하지 않을 때
        if( !$boardFn->isBoardname() ){
            return view('common/board_error');
        }
    }
    
    private function isBoardEmpty($boardname){

        $boardFn = new BoardFn();
        $boardFn->setBoardname($boardname);
    
        return $boardFn->isBoardname();

    }

    public function write(Request $request){
        
        $boardname = $request->boardname;
        $this->printBoardIsEmpty($boardname);

        // 데이터 값 전송
        $data['boardname'] = $boardname;

        return view('board/write', $data);

    }

    public function write_ok(Request $request){

        $boardname = $request->boardname;
        $this->printBoardIsEmpty($boardname);
        
        
        // 유효성 검사
        $rules = [
            'b_subject' => 'required|min:5|unique:cake_board_' . $boardname,
            'b_content' => 'required',
            'bf_file.*'   => 'required|mimes:doc,docx,xlsx,xls,pdf,zip,png,bmp,jpg|max:2048',
        ];
        
        $messages = [
            'b_subject.required' => '제목은 is must.',
            'b_subject.min' => '제목은 must have 5 char.', 
            'b_subject.unique' => '제목은 is must unique', 
            'bf_file.*.required'   => '파일첨부에 오류가 발생하였습니다.',
            'bf_file.*.mimes'   => '파일첨부에 허용되지 않은 확장자이다.',
            'bf_file.*.max'   => '파일첨부 최대 크기가 허용되지 않습니다.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }


        // 다중 파일 첨부
        if ($request->bf_file){
            foreach($request->bf_file as $file) {

                $fileName = $file->getClientOriginalName();
                $filePath = 'uploads/' . $fileName;

                $path = Storage::disk('public')->put($filePath, file_get_contents($file));
                $path = Storage::disk('public')->url($path);


            }
        }

        // 게시판 Insert 쿼리
        $board_insert_qry = "insert into cake_board_dd(" . 
                            "b_subject, b_content, b_is_notice, " . 
                            "b_author, b_member_id, b_passwd, " . 
                            "b_file_exist, b_comment_cnt, b_cnt, " . 
                            "b_ip, b_regidate) " . 
                            "VALUES(" . 
                            ":b_subject, :b_content, :b_is_notice, " . 
                            ":b_author, :b_member_id, :b_passwd, " . 
                            ":b_file_exist, :b_comment_cnt, :b_cnt, " . 
                            ":b_ip, :b_regidate)";


        // 데이터 값
        $board_bind['b_subject'] = $request->b_subject;
        $board_bind['b_content'] = $request->b_content;
        $board_bind['b_is_notice'] = $request->b_is_notice;
        $board_bind['b_author'] = $request->b_author;
        $board_bind['b_member_id'] = $request->b_member_id;
        $board_bind['b_passwd'] = $request->b_passwd;
        $board_bind['b_file_exist'] = 0;
        $board_bind['b_comment_cnt'] = 0;
        $board_bind['b_cnt'] = 0;
        $board_bind['b_ip'] = "";
        $board_bind['b_regidate'] = date("Y-m-d H:i:s");

        $token = $request->session()->token();
        $token = csrf_token();

        echo $token;

        // 쿼리 실행
        $results = DB::insert($board_insert_qry, $board_bind);

    }

    public function modify(){

    }

    public function view(Request $request){

        $boardname = $request->boardname;
        $this->printBoardIsEmpty($boardname);

        $b_id = $request->b_id;

        $board_view_qry = "select * from cake_board_" . $boardname . 
                        " where b_id = :b_id";

        $board_bind['b_id'] = $request->b_id;
        
        $boardView = DB::select($board_view_qry, $board_bind);
        
        // 데이터 값 전송
        $data = Array();
        $data['boardview'] = $boardView;

        return view('board/view', $data);

    }

    public function list(Request $request){

        $boardname = $request->boardname;
        
        // 게시판이 존재할 때
        if ( $this->isboardEmpty($boardname) ){

            // 페이징 로직 생성
            $pagingLogic = new PagingLogic();
            $pageCri = new PageCriteria();

            // 전체 게시글 갯수
            $board_total_cnt_qry = DB::select('select count(*) as `cnt` from cake_board_' . $boardname);
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

            $board_paging_qry = "SELECT b_id, b_subject, " . 
                        "b_content, b_author, " . 
                        "b_file_exist, b_cnt, " . 
                        "b_ip, b_regidate " . 
                        "FROM cake_board_" . $boardname . " " .
                        "ORDER BY cake_board_" . $boardname . ".b_is_notice DESC, " . 
                        "cake_board_" . $boardname . ".b_regidate DESC " . 
                        "LIMIT :lim_num OFFSET :start_num";

            // 게시판 바인딩
            $board_binding['lim_num'] = $_limnum;
            $board_binding['start_num'] = $_start_num;

            // 게시판 목록 가져오기
            $boardList = DB::select($board_paging_qry, $board_binding);

            // 데이터 값 전송
            $data = Array();
            $data['board_list'] = $boardList;
            $data['board_paging'] = $pagingLogic;

            return view('board/list', $data);

        }

    }

}