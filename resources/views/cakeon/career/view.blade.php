@section('header')
@include('../../layout/header')

<body id="section_1">
    @section('top')
    @include('../../layout/top')
    @section('menu')
    @include('../../layout/menu')
    <main>

<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">Cakeon Career(케익온 커리어)</h1>
            </div>

        </div>
    </div>
</section>

<section class="about-section section-padding">
            <div class="container">
                <div class="row">

                    <div class="custom-text-block">
                        <h2 class="mb-0">커리어 조회</h2>

                        <div class="table-responsive">
                            
                            <!-- 채용명 -->
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>채용명</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($career_basic_view as $item)
                                    <tr>
                                        <td class="text-bold-500">{{$item->subject}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- 회사명 -->
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>회사명</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($career_basic_view as $item)
                                    <tr>
                                        <td class="text-bold-500">{{$item->corp_name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- 채용 기초 정보 -->
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>국가별</th>
                                        <th>지역별</th>
                                        <th>직무별</th>
                                        <th>근무유형</th>
                                        <th>관계</th>
                                        <th>접수일자</th>
                                        <th>종료일자</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($career_basic_view as $item)
                                    <tr>
                                        <td>{{$item->country_name}}</td>
                                        <td>{{$item->region_name}}</td>
                                        <td>{{$item->position_name}}</td>
                                        <td>{{$item->job_type_name}}</td>
                                        <td>{{$item->relation_name}}</td>
                                        <td>{{$item->open_start_date}}</td>
                                        <td>{{$item->open_end_date}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- 채용 담당자 정보 -->
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>부서명</th>
                                        <th>별칭</th>
                                        <th>담당자명</th>
                                        <th>연락처</th>
                                        <th>이메일</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($career_dept_view as $item)
                                    <tr>
                                        <td class="text-bold-500">{{$item->dept_name}}</td>
                                        <td>{{$item->nickname}}</td>
                                        <td class="text-bold-500">{{$item->member_name}}</td>
                                        <td>{{$item->phone_number}}</td>
                                        <td>{{$item->email}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            
                            <!-- 채용 기본 정보2 -->
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>채용직급</th>
                                        <th>채용인원</th>
                                        <th>세금전 급여</th>
                                        <th>업무시작시간</th>
                                        <th>업무종료시간</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($career_basic_view as $item)
                                    <tr>
                                        <td class="text-bold-500">{{$item->ext_position}}</td>
                                        <td>{{$item->max_cnt}}</td>
                                        <td class="text-bold-500">{{$item->salary}}</td>
                                        <td>
                                            <?php
                                                if ( $item->army_start_hour < 10 ){
                                                    echo "0" . $item->army_start_hour . ":";
                                                }else{
                                                    echo $item->army_start_hour . ":";
                                                }
                                                if ( $item->army_start_min < 10 ){
                                                    echo "0" . $item->army_start_min;
                                                }else{
                                                    echo $item->army_start_min;
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ( $item->army_end_hour < 10 ){
                                                    echo "0" . $item->army_end_hour . ":";
                                                }else{
                                                    echo $item->army_end_hour . ":";
                                                }
                                                if ( $item->army_end_min < 10 ){
                                                    echo "0" . $item->army_end_min;
                                                }else{
                                                    echo $item->army_end_min;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            
                            <!-- 채용 상세 정보 -->
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>상세정보</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($career_basic_view as $item)
                                    <tr>
                                        <td>{{$item->content}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="buttons">
                            @foreach ($career_basic_view as $item)
                                <a href="{{route('career')}}/apply/{{$item->career_id}}" class="btn btn-primary" style="color:#FFFFFF" target="_blank">지원</a>
                            @endforeach
                                <a href="javascript:history.back()" class="btn btn-primary" style="color:#FFFFFF">이전</a>
                            </div>
                        </div>
                        

                    </div>

                </div>
            </div>
        </section>


</main>

@section('bottom')
@include('../../layout/bottom')

@section('footer')
@include('../../layout/footer')