@section('header')
@include('../../layout/header')

<body id="section_1">
    @section('top')
    @include('../../layout/top')
    @section('menu')
    @include('../../layout/menu')
    <main>
<script type="text/javascript">

    function apply_back(profile, career_id){
        location.replace("{{route('career')}}/apply/profile/" + career_id);
    }

</script>


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

            <div class="col-lg-12 col-md-8 col-8">
                <div class="custom-text-block">
                    <h2 class="mb-0">입사지원 - 교육사항</h2>

                    <p class="text-muted mb-lg-4 mb-md-4">교육사항입니다. 입사지원 시에만 사용되며, 사용 후 폐기됩니다.<br>
                    졸업, 수료증명서만 인정됩니다.</p>

                    <form method="POST" action="{{route('career')}}/apply/education/{{$career_id}}">
                    @csrf
                    
                    @foreach($apply_member as $item)
                    <input type="hidden" name="apply_id" value="{{$item->apply_id}}" required />
                    @endforeach
                    <!-- 주민등록번호 -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width:7%">유형</th>
                                    <th>학교</th>
                                    <th>시작일자</th>
                                    <th>종료일자</th>
                                    <th>구분</th>
                                    <th>학과1</th>
                                    <th>구분1</th>
                                    <th>학과2</th>
                                    <th>구분2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-bold-500">
                                        학력무관<br>여부
                                        <input type="hidden" name="effect_edu" value="블라인드" required />
                                    </td>
                                    <td colspan="3">
                                        평등한 입사기회를 부여하기 위해 기능을 추가하였습니다.
                                    </td>
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="effect_grade_type" required>
                                            <option value="@foreach($result_school_effect as $item){{$item->grade_type}}@endforeach">@foreach($result_school_effect as $item){{$item->grade_type}}@endforeach</option>
                                            <option value="해당">해당</option>
                                            <option value="미해당">미해당</option>
                                        </select>
                                    </td>
                                    <td colspan="4">
                                        
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-bold-500">고등학교</td>
                                    <td>*
                                        <input type="hidden" name="school_name1" value="블라인드">
                                    </td>
                                    <td class="text-bold-500">
                                        <input type="date" class="form-control" id="basicInput" name="school_startdate_1"
                                            style="width:150px" value="@foreach($result_high_school as $item){{$item->start_date}}@endforeach">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="basicInput" name="school_enddate_1" 
                                            style="width:150px" value="@foreach($result_high_school as $item){{$item->end_date}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="grade_type_1">
                                            <option value="@foreach($result_high_school as $item){{$item->grade_type}}@endforeach">@foreach($result_high_school as $item){{$item->grade_type}}@endforeach</option>
                                            <option value="졸업">졸업</option>
                                            <option value="수료">수료</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_1_1"
                                             style="width:150px" value="@foreach($result_high_school as $item){{$item->dept_1}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_1_1">
                                            <option value="value=@foreach($result_high_school as $item){{$item->dept_1_type}}@endforeach">@foreach($result_high_school as $item){{$item->dept_1_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_2_1"
                                             style="width:150px" value="@foreach($result_high_school as $item){{$item->dept_2}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_2_1">
                                            <option value="value=@foreach($result_high_school as $item){{$item->dept_2_type}}@endforeach">@foreach($result_high_school as $item){{$item->dept_2_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="text-bold-500">대학교1</td>
                                    
                                    <td>*
                                        <input type="hidden" name="school_name2" value="블라인드">
                                    </td>
                                    <td class="text-bold-500">
                                        <input type="date" class="form-control" id="basicInput" name="school_startdate_2"
                                            style="width:150px" value="@foreach($result_univ_school1 as $item){{$item->start_date}}@endforeach">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="basicInput" name="school_enddate_2" 
                                            style="width:150px" value="@foreach($result_univ_school1 as $item){{$item->end_date}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="grade_type_2">
                                            <option value="@foreach($result_univ_school1 as $item){{$item->grade_type}}@endforeach">@foreach($result_univ_school1 as $item){{$item->grade_type}}@endforeach</option>
                                            <option value="수료">수료</option>
                                            <option value="직업훈련">직업훈련</option>
                                            <option value="전문학사">전문학사</option>
                                            <option value="학사">학사</option>
                                            <option value="석사">석사</option>
                                            <option value="박사">박사</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_1_2"
                                             style="width:150px" value="@foreach($result_univ_school1 as $item){{$item->dept_1}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_1_2">
                                            <option value="@foreach($result_univ_school1 as $item){{$item->dept_1_type}}@endforeach">@foreach($result_univ_school1 as $item){{$item->dept_1_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_2_2"
                                             style="width:150px" value="@foreach($result_univ_school1 as $item){{$item->dept_2}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_2_2">
                                            <option value="@foreach($result_univ_school1 as $item){{$item->dept_2_type}}@endforeach">@foreach($result_univ_school1 as $item){{$item->dept_2_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="text-bold-500">대학교2</td>
                                    
                                    <td>*
                                        <input type="hidden" name="school_name3" value="블라인드">
                                    </td>
                                    <td class="text-bold-500">
                                        <input type="date" class="form-control" id="basicInput" name="school_startdate_3"
                                            style="width:150px" value="@foreach($result_univ_school2 as $item){{$item->start_date}}@endforeach">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="basicInput" name="school_enddate_3" 
                                            style="width:150px" value="@foreach($result_univ_school2 as $item){{$item->end_date}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="grade_type_3">
                                            <option value="@foreach($result_univ_school2 as $item){{$item->grade_type}}@endforeach">@foreach($result_univ_school2 as $item){{$item->grade_type}}@endforeach</option>
                                            <option value="수료">수료</option>
                                            <option value="직업훈련">직업훈련</option>
                                            <option value="전문학사">전문학사</option>
                                            <option value="학사">학사</option>
                                            <option value="석사">석사</option>
                                            <option value="박사">박사</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_1_3"
                                             style="width:150px" value="@foreach($result_univ_school2 as $item){{$item->dept_1}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_1_3">
                                            <option value="@foreach($result_univ_school2 as $item){{$item->dept_1_type}}@endforeach">@foreach($result_univ_school2 as $item){{$item->dept_1_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_2_3"
                                             style="width:150px" value="@foreach($result_univ_school2 as $item){{$item->dept_2}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_2_3">
                                            <option value="@foreach($result_univ_school2 as $item){{$item->dept_2_type}}@endforeach">@foreach($result_univ_school2 as $item){{$item->dept_2_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-bold-500">대학교3</td>
                                    
                                    <td>*
                                        <input type="hidden" name="school_name4" value="블라인드">
                                    </td>
                                    <td class="text-bold-500">
                                        <input type="date" class="form-control" id="basicInput" name="school_startdate_4"
                                            style="width:150px" value="@foreach($result_univ_school3 as $item){{$item->start_date}}@endforeach">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="basicInput" name="school_enddate_4" 
                                            style="width:150px" value="@foreach($result_univ_school3 as $item){{$item->end_date}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="grade_type_4">
                                            <option value="@foreach($result_univ_school3 as $item){{$item->grade_type}}@endforeach">@foreach($result_univ_school3 as $item){{$item->grade_type}}@endforeach</option>
                                            <option value="수료">수료</option>
                                            <option value="직업훈련">직업훈련</option>
                                            <option value="전문학사">전문학사</option>
                                            <option value="학사">학사</option>
                                            <option value="석사">석사</option>
                                            <option value="박사">박사</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_1_4"
                                             style="width:150px" value="@foreach($result_univ_school3 as $item){{$item->dept_1}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_1_4">
                                            <option value="@foreach($result_univ_school3 as $item){{$item->dept_1_type}}@endforeach">@foreach($result_univ_school3 as $item){{$item->dept_1_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_2_4"
                                             style="width:150px" value="@foreach($result_univ_school3 as $item){{$item->dept_2}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_2_4">
                                            <option value="@foreach($result_univ_school3 as $item){{$item->dept_2_type}}@endforeach">@foreach($result_univ_school3 as $item){{$item->dept_2_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="text-bold-500">대학교4</td>
                                    
                                    <td>*
                                        <input type="hidden" name="school_name5" value="블라인드">
                                    </td>
                                    <td class="text-bold-500">
                                        <input type="date" class="form-control" id="basicInput" name="school_startdate_5"
                                            style="width:150px" value="@foreach($result_univ_school4 as $item){{$item->start_date}}@endforeach">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="basicInput" name="school_enddate_5" 
                                            style="width:150px" value="@foreach($result_univ_school4 as $item){{$item->end_date}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="grade_type_5">
                                            <option value="@foreach($result_univ_school4 as $item){{$item->grade_type}}@endforeach">@foreach($result_univ_school4 as $item){{$item->grade_type}}@endforeach</option>
                                            <option value="수료">수료</option>
                                            <option value="직업훈련">직업훈련</option>
                                            <option value="전문학사">전문학사</option>
                                            <option value="학사">학사</option>
                                            <option value="석사">석사</option>
                                            <option value="박사">박사</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_1_5"
                                             style="width:150px" value="@foreach($result_univ_school4 as $item){{$item->dept_1}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_1_5">
                                            <option value="@foreach($result_univ_school4 as $item){{$item->dept_1_type}}@endforeach">@foreach($result_univ_school4 as $item){{$item->dept_1_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="basicInput" name="dept_2_5"
                                             style="width:150px" value="@foreach($result_univ_school4 as $item){{$item->dept_2}}@endforeach">
                                    </td>
                                    <td>
                                        <select class="form-select" id="basicSelect" name="dept_type_2_5">
                                            <option value="@foreach($result_univ_school4 as $item){{$item->dept_2_type}}@endforeach">@foreach($result_univ_school4 as $item){{$item->dept_2_type}}@endforeach</option>
                                            <option value="주전공">주전공</option>
                                            <option value="복수전공">복수전공</option>
                                            <option value="부전공">부전공</option>
                                        </select>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary me-1 mb-1" onclick="apply_back('profile', {{$career_id}})">이전</button>
                    <button type="submit" class="btn btn-primary me-1 mb-1">입력</button>
                    
                    </form>

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