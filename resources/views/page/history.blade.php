@section('header')
@include('../layout/header')

<body id="section_1">
    @section('top')
    @include('../layout/top')
    @section('menu')
    @include('../layout/menu')
    <main>

<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">About / History</h1>
            </div>

        </div>
    </div>
</section>

<section class="about-section section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-5">
                        <img src="{{asset('template/KindHeart-1.0.0/images/history-free.jpg') }}"
                            class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="Software Society">
                    </div>

                    <div class="col-lg-5 col-md-3 col-12">
                        <div class="custom-text-block">
                            <h2 class="mb-0">케익온의 역사</h2>

                            <p class="text-muted mb-lg-4 mb-md-4">History of Cakeon</p>

                            <p>2023-01월: 새로운 출발
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </section>
</main>

@section('bottom')
@include('../layout/bottom')

@section('footer')
@include('../layout/footer')