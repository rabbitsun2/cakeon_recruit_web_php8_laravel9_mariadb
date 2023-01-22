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
                <h1 class="text-white">Product / IT Convergence(제품 / IT 융합)</h1>
            </div>

        </div>
    </div>
</section>

<section class="about-section section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-5">
                        <img src="{{asset('template/KindHeart-1.0.0/images/skills-free-img.jpg') }}"
                            class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="Software Society">
                    </div>

                    <div class="col-lg-5 col-md-3 col-12">
                        <div class="custom-text-block">
                            <h2 class="mb-0">케익온 소개</h2>

                            <p class="text-muted mb-lg-4 mb-md-4">세상에 긍정적인 일을 수행합니다.</p>

                            <p>
                                케익온은 소프트웨어 전문적으로 수행하는 조직입니다.<br>
                                주력 사업으로 영상 처리 개발, 서비스, <br>RPA(Robotic Process Automation), <br>
                                인공지능(AI), 오픈소스 개발, 특강, IT 컨설팅을 전문적으로 수행합니다.<br>
                            </p>
                            <p>해외, 국내 표준 규격을 기본적으로 준수하여 소프트웨어 개발을 수행합니다.</p>
                            <p>케익온의 문화는 개발을 좋아하는 취미 및 자원봉사자와 <br>전문 개발자와
                                혼합된 팀으로 개발을 수행할 수 있습니다.
                            </p>
                            <p>우리는 창의적인 메이커를 위한 개발을 지원하고 도와주는 일을<br>
                                수행할 수 있습니다.
                            </p>

                            <ul class="social-icon mt-4">
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-facebook"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>
                            </ul>
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