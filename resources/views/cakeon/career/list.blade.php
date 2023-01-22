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
                        <h2 class="mb-0">커리어 목록</h2>

                        
                        <form method="POST" action="{{route('career_ok')}}">
                            @csrf

                            <!-- 국가 -->
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="country">
                            @foreach ($country as $item)
                                <option value="{{$item->country_id}}">{{$item->country_name}}</option>
                            @endforeach
                                </select>
                            </fieldset>

                            <!-- 지역 -->
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="region">
                            @foreach ($region as $item)
                                <option value="{{$item->region_id}}">{{$item->region_name}}</option>
                            @endforeach
                                </select>
                            </fieldset>

                            <!-- 직무 -->
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="position">
                            @foreach ($position as $item)
                                <option value="{{$item->position_id}}">{{$item->position_name}}</option>
                            @endforeach
                                </select>
                            </fieldset>

                            <!-- 근무유형 -->
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="job_type">
                            @foreach ($job_type as $item)
                                <option value="{{$item->job_type_id}}">{{$item->job_type_name}}</option>
                            @endforeach
                                </select>
                            </fieldset>

                            <!-- 관계 -->
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="relation">
                            @foreach ($relation as $item)
                                <option value="{{$item->relation_id}}">{{$item->relation_name}}</option>
                            @endforeach
                                </select>
                            </fieldset>

                            <!-- 회사 소속 -->
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="corporation">
                            @foreach ($corporation as $item)
                                <option value="{{$item->corp_id}}">{{$item->corp_name}}</option>
                            @endforeach
                                </select>
                            </fieldset>

                            <button type="submit" class="btn btn-primary me-1 mb-1">조회</button>
                            
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>번호</th>
                                        <th>국가별</th>
                                        <th>지역별</th>
                                        <th>직무별</th>
                                        <th>근무유형</th>
                                        <th>관계</th>
                                        <th>회사명</th>
                                        <th>채용명</th>
                                        <th>접수일자</th>
                                        <th>종료일자</th>
                                        <th>채용인원</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($career_list as $item)
                                    <tr>
                                        <td class="text-bold-500">{{$item->career_id}}</td>
                                        <td>{{$item->country_name}}</td>
                                        <td class="text-bold-500">{{$item->region_name}}</td>
                                        <td>{{$item->position_name}}</td>
                                        <td>{{$item->job_type_name}}</td>
                                        <td>{{$item->relation_name}}</td>
                                        <td>{{$item->corp_name}}</td>
                                        <td>
                                            <a href="{{route('career')}}/view/{{$item->career_id}}/{{$item->country_id}}/{{$item->region_id}}/{{$item->position_id}}/{{$item->job_type_id}}/{{$item->relation_id}}/{{$item->corp_id}}">
                                                <i class="badge-circle badge-circle-light-secondary font-medium-1"
                                                    data-feather="mail"></i>{{$item->subject}}
                                            </a>
                                        </td>
                                        <td>{{$item->open_start_date}}</td>
                                        <td>{{$item->open_end_date}}</td>
                                        <td>{{$item->max_cnt}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <?php
                            $data = array();
                            //print_r($board_paging);
                            $data['board_paging'] = $board_paging;
                        ?>

                        @section('paging')
                        @include('../../common/paging', $data)

                    </div>

                </div>
            </div>
        </section>


</main>

@section('bottom')
@include('../../layout/bottom')

@section('footer')
@include('../../layout/footer')