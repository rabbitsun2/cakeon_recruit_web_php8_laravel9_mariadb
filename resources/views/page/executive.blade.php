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
                <h1 class="text-white">About / Executive</h1>
            </div>

        </div>
    </div>
</section>

<section class="about-section section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-5">
                        <img src="{{asset('images/230112_dyj.png') }}"
                            class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="Software Society">
                    </div>

                    <div class="col-lg-5 col-md-3 col-12">
                        <div class="custom-text-block">
                            <h2 class="mb-0">정도윤(Doyoon Jung)</h2>

                            <p class="text-muted mb-lg-4 mb-md-4">(설립자)Founder Cakeon Project</p>

                            <p>
                                <br>
                                Hello, I Based on C, C++, and Java programming, it can handle various languages such as <br>
                                PHP, JSP, Servlet, C#, Python, and VBA.<br>
                                Databases can use mariadb, oracle.<br>
                                I have experience using Atmega128 training kit, Raspberry Pi and Arduino as AVR.
                            </p>
                            <p><b>Education</b></p>
                            </p>
                            <p><b>Training</b></p>
                            <p>
                               1. Department of AI Convergence, Korea Polytechnics Gwangju Campus (2022.03 ~ 2023.02)
                            </p>
                            
                            <p><b>License</b></p>
                            <p>
                               11. Craftsman Web Design (2022. 12)<br>
                               10. Information Processing engineer (2014. 11)<br>
                               9. Information Industrial Processing engineer (2009. 6)<br>
                               8. Industrial Engineer Office Automation (2008. 11)<br>
                               7. Computer Specialist in Spreadsheet & Database Level-2 (2007. 5)<br>
                               6. Craftsman Information Equipment Operation (2007. 4)<br>
                               5. Word Processor User, Level-1 (2007. 3)<br>
                               4. Internet Information Administrator (2007. 2)<br>
                               3. Craftsman Information Processing (2006. 6)<br>
                               2. Word Processor User, Level-2 (2003. 3)<br>
                               1. Word Processor User, Level-3 (2002. 9)<br>
                            </p>
                            <p>Phone Number: 82+010-8420-3478<br>
                               Email: rabbitsun2@gmail.com
                            </p>

                            <p><b>Award</b></p>
                            <p>
                               6. AI+x LF Utilization Capstone Project and Portfolio Review (Portfolio Works) (2022. 10)<br>
                               &nbsp;&nbsp;(Korea Polytechnics 5 Gwangju Campus)<br>
                               5. National High School Student Information Technology Contest (2008. 4)<br>
                               &nbsp;&nbsp;Honam University IT, CT Human Resource Development Project Group<br>
                               4. 2008 Gwangju Regional Convention (2008. 4)<br>
                               &nbsp;&nbsp;(International Skills Olympic Games Korea Committee)<br>
                               3. 2007 Computer Dream Tree - Commendation (2007. 12)<br>
                               2. The 18th Gwangju, Jeonnam Elementary, Middle, and High School Student Computer Contest (2007. 9)<br>
                               &nbsp;&nbsp;(Gwangju Metropolitan City Office of Education)<br>
                               1. The 6th 2007 Korea Web Contest - Subject: Homepage (2007. 8)<br>
                               &nbsp;&nbsp;(Woosong University)
                            </p>
                            <p>Phone Number: 82+010-8420-3478<br>
                               Email: rabbitsun2@gmail.com
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