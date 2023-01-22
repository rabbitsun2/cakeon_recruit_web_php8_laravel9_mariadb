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

                    <div class="col-lg-6 col-md-12 col-5">
                        <img src="{{asset('images/career/intro.jpg') }}"
                            class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="Software Society">
                    </div>

                    <div class="col-lg-5 col-md-3 col-12">
                        <div class="custom-text-block">
                            <h2 class="mb-0">케익온 커리어</h2>

                            <p class="text-muted mb-lg-4 mb-md-4">인류에 이바지를 할 수 있는 인재를 원합니다.</p>

                            <p>
                                케익온은 학교 이름, 성적, 경력, 나이, 성별, 인종 제한을<br>두지 않습니다.<br>
                                (Cakeon does not impose restrictions on school name, grades, experience, age, gender, or race.)<br>
                                하지만, IT 기업 특성상 기업의 핵심 리소스에 접근하므로<br>
                                기초 신원 조회는 실시합니다. 부담 갖지 마세요.<br>
                                (However, due to the nature of IT companies, basic background checks are conducted as they access key corporate resources.)<br>
                                <br>(Don't worry)
                                주어진 과업에 책임감을 가지고 도전하실 인재를 정중히 모십니다.<br>
                                (We respectfully recruit talented people who take on the challenge of a given task with a sense of responsibility.)
                            </p>
                            <p>해외, 국내 표준 규격을 기본적으로 준수하여 소프트웨어 개발을 수행합니다.</p>
                            <p>케익온의 문화는 개발을 좋아하는 취미 및 자원봉사자와 <br>전문 개발자와
                                혼합된 팀으로 개발을 수행할 수 있습니다.
                            </p>
                            <p>우리는 창의적인 메이커를 위한 개발을 지원하고 도와주는 일을<br>
                                수행할 수 있습니다.
                            </p>

                            <form method="POST" action="{{route('career_ok')}}">
                            @csrf

                            <?php /*
                            <!-- 국가 -->
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="country">
                                    <?php for ($i = 0; $i < count($country_kor); $i++){ ?>                                      
                                    <option value="<?php echo $country_kor[$i]['value'];?>"><?php echo $country_kor[$i]['country'];?></option>
                                    <?php } ?>
                                </select>
                            </fieldset>
                            */ ?>
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