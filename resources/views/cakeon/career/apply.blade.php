@section('header')
@include('../../layout/career/login_header')

</head>
<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{route('career')}}/apply/{{$career_id}}"><img src="{{ asset('images/login/login_logo.jpg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">로그인</h1>
                    <p class="auth-subtitle mb-5">입사지원을 하기 위해서는 입사지원 계정을 생성해야 합니다.<br>
                    해당 사항에 동의하지 않은 경우, 입사지원을 수행할 수 없습니다.
                    </p>

                    <form action="{{route('career')}}/apply/signin_ok/{{$career_id}}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="email" type="text" class="form-control form-control-xl" placeholder="이메일 주소를 입력해주세요.">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="passwd" type="password" class="form-control form-control-xl" placeholder="비밀번호를 입력하세요.">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">로그인</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">계정이 없으십니까?</p>
                        
                        <p><a href="{{route('career')}}/apply/signup/{{$career_id}}"
                                class="font-bold">계정 생성</a></p>
                        <p><a class="font-bold" href="auth-forgot-password.html">비밀번호 찾기?</a></p>
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