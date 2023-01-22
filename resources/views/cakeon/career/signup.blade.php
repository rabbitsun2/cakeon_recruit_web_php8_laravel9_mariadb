@section('header')
@include('../../layout/career/login_header')
<style type="text/css">
    /* jQuery 버그 개선 */
    body{
        overflow-y:hidden;
    }
</style>
    <script src="{{ asset('js/jquery/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-5.2.2-dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){

            $("#alert-success").hide();
            $("#alert-danger").hide();
            $("input").keyup(function(){

                var pwd1 = $("#passwd1").val();
                var pwd2 = $("#passwd2").val();
                
                if(pwd1 != "" || pwd2 != ""){
                
                    if(pwd1 == pwd2){
                        $("#alert-success").show();
                        $("#alert-danger").hide();
                        $("#submit").removeAttr("disabled");
                    }else{
                        $("#alert-success").hide();
                        $("#alert-danger").show();
                        $("#submit").attr("disabled", "disabled");
                    }    

                }

            });

        });
    </script>
</head>
<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{route('career')}}/apply/{{$career_id}}"><img src="{{ asset('images/login/login_logo.jpg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">계정 생성</h1>
                    <p class="auth-subtitle mb-5">빈 칸의 내용을 채워주세요.</p>

                    <form method="POST" action="{{route('career')}}/apply/signup_ok/{{$career_id}}">
                        @csrf
                        <input type="hidden" name="career_id" value="{{$career_id}}">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" placeholder="이메일 주소를 입력하세요"
                                pattern="[a-zA-Z0-9]+[@][a-zA-Z0-9]+[.]+[a-zA-Z]+[.]*[a-zA-Z]*" name="email" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="사용자 이름을 입력하세요" 
                                max_length="40" name="name" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="passwd1" type="password" class="form-control form-control-xl"
                                 placeholder="비밀번호를 입력하세요" name="passwd1" required />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="passwd2" type="password" class="form-control form-control-xl"
                                 placeholder="비밀번호 확인을 입력하세요" name="passwd2" required />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <div class="alert alert-success" id="alert-success">비밀번호가 일치합니다.</div>
                            <div class="alert alert-danger" id="alert-danger">비밀번호가 일치하지 않습니다.</div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="tel" class="form-control form-control-xl" placeholder="연락처를 입력하세요" 
                                pattern="[0-9]{3}-[0-9]{3,4}-[0-9]{4}" name="phone" required />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="date" class="form-control form-control-xl" name="birthdate" 
                                required />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">회원가입</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>이미 계정을 보유하고 있습니까? </p>
                            <a href="{{route('career')}}/apply/{{$career_id}}"
                                class="font-bold">로그인</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>