@section('header')
@include('../../layout/header')

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    document.getElementById("sample6_extraAddress").value = extraAddr;
                
                } else {
                    document.getElementById("sample6_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample6_postcode').value = data.zonecode;
                document.getElementById("sample6_address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("sample6_detailAddress").focus();
            }
        }).open();
    }
</script>
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

            <div class="col-lg-8 col-md-7 col-8">
                <div class="custom-text-block">
                    <h2 class="mb-0">입사지원 - 신상정보</h2>

                    <p class="text-muted mb-lg-4 mb-md-4">신상정보 입력입니다. 입사지원 시에만 사용되며, 사용 후 폐기됩니다.</p>

                    <form method="POST" action="{{route('career')}}/apply/profile/{{$career_id}}">
                    @csrf
                    
                    @foreach($apply_member as $item)
                    <input type="hidden" name="apply_id" value="{{$item->apply_id}}" required/>
                    @endforeach
                    <!-- 주민등록번호 -->
                    <fieldset class="form-group">
                        <span>주민등록번호</span><br>
                        <input type="text" id="jumin_number" class="form-control"
                            name="jumin_number" placeholder="123456-1xxxxxx" pattern="\d{6}-\d{7}"
                            value="@foreach($result_profile as $item){{$item->jumin_number}}@endforeach"
                            required>
                        @error('jumin_number')
                            <br>
                            <span>{{$message}}</span>
                        @enderror
                    </fieldset>

                    <fieldset class="form-group">
                        <span>주소</span><br>                                    
                        <input name="postcode" class="form-control" type="text" id="sample6_postcode" placeholder="우편번호" readonly
                            value="@foreach($result_profile as $item){{$item->postcode}}@endforeach"
                            required>
                        <input type="button" class="form-control" onclick="sample6_execDaumPostcode()" class="btn btn-primary me-1 mb-1" value="우편번호 찾기"><br>
                        <input name="address" class="form-control" type="text" id="sample6_address" placeholder="주소" readonly
                            value="@foreach($result_profile as $item){{$item->address}}@endforeach"
                            required>
                        <input name="extra_address" type="text" class="form-control" id="sample6_extraAddress" placeholder="참고항목" 
                            value="@foreach($result_profile as $item){{$item->extra_address}}@endforeach"
                            readonly>
                        <br>
                        <input name="detail_address" type="text" class="form-control" id="sample6_detailAddress" placeholder="상세주소"
                            value="@foreach($result_profile as $item){{$item->detail_address}}@endforeach"
                            required>
                        @error('address')
                            <br>
                            <span>{{$message}}</span>
                        @enderror
                    </fieldset>
                    
                    <br>
                    
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