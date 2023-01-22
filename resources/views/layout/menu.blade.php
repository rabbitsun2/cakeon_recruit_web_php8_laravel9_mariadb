<!-- 메뉴 -->
<nav class="navbar navbar-expand-lg bg-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ asset('') }}">
                <img src="{{asset('template/free-icon/free-icon-developer-2829038.png') }}" class="logo img-fluid" alt="Kind Heart Charity">
                <span>
                    케익온 소프트웨어 센터
                    <small>전문분야: 소프트웨어 개발 및 연구</small>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="{{asset('') }}">홈</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link click-scroll dropdown-toggle" href="{{asset('cakeon/about') }}"
                            id="navBar_aboutDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">소개</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navBar_aboutDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{asset('cakeon/about') }}">소개</a></li>
                            <li><a class="dropdown-item" href="{{asset('cakeon/executive') }}">경영진</a></li>
                            <li><a class="dropdown-item" href="{{asset('cakeon/history') }}">역사</a></li>
                            <li><a class="dropdown-item" href="{{asset('cakeon/career') }}">Cakeon 커리어스</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link click-scroll dropdown-toggle" href="{{asset('cakeon/product') }}"
                            id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">제품</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{asset('cakeon/product/sw') }}">소프트웨어</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/product/hw') }}">IT 융합</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link click-scroll dropdown-toggle" href="{{asset('cakeon/dev/volunteer/project') }}"
                            id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Volunteer</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{asset('cakeon/dev/volunteer/project') }}">Project</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/dev/volunteer/event') }}">Offline</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/dev/volunteer/education') }}">Education</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/dev/volunteer/qna') }}">QnA</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/dev/volunteer/certificate') }}">Certificate</a></li>

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link click-scroll dropdown-toggle" href="{{asset('cakeon/board/notice') }}"
                            id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Board</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{asset('cakeon/board/notice') }}">Notice</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/board/ourstory') }}">Our story</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/board/download') }}">Download</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/board/qna') }}">QnA</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link click-scroll dropdown-toggle" href="{{asset('cakeon/consulting/engineering') }}"
                            id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Consulting</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{asset('cakeon/consulting/engineering') }}">SW Engineering</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/consulting/design') }}">Design</a></li>

                            <li><a class="dropdown-item" href="{{asset('cakeon/consulting/education') }}">IT Education</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="{{asset('cakeon/contact') }}">Contact</a>
                    </li>

                    <li class="nav-item ms-3">
                        <a class="nav-link custom-btn custom-border-btn btn" href="{{asset('cakeon/donate') }}">Donate</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- 메뉴 -->