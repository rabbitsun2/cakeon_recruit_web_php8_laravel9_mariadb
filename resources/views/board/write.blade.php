@section('header')
@include('board/header_write')

@section('content')
<form name="fwrite" method="post" action="{{route('default')}}/board/{{$boardname}}/write"
    enctype="multipart/form-data" accept-charset="utf-8">
    
<div class="content">
    <div class="various-form write manage">
        @csrf
        <input type=hidden name="wr_id" value="">

        <!--상단내용:시작!-->
        <ul class="sec-tion">
            <li>
                <label class="lab" for="title"><strong>제목</strong></label>
                <input type="text" id="title" name="b_subject" title="제목" class="ts" value="" style="width:250px;"/>
            </li>
            @error('b_subject')
            <li>
                    <span class="text-danger">{{ $message }}</span>
            </li>
            @enderror
        </ul>
        <ul class="sec-tion">
            <li>
                <span class="lab" for="options"><strong>공지글</strong></span>
                <input type="checkbox" id="wr_is_notice" name="b_is_notice" value="1"  /> 
                <label for="wr_is_notice">공지글</label>&nbsp;&nbsp;&nbsp;
            </li>
        </ul>
        <!--상단내용:종료!-->
    
    <!--내용:시작!-->
    <div class="writing" >
            <textarea name="b_content" id="wr_content" cols="30" rows="10" ></textarea>
    </div>
    <!--내용:종료!-->
    
    
    <!--파일첨부하기:시작!-->
    <ul class="sec-tion attachbox">
        <li style="position:absolute;top:18px;left:80px;">
            <a class="con_file_plus">첨부파일추가</a>
            <a class="con_file_minus">첨부파일삭제</a>
        </li>
        <li>
            <label for="bf_file[]" class="lab" style="float:left;"><strong>첨부파일</strong></label>
                <ul class="attach_list finput_box" style="float:left;">
                <li>
                    <input type="file" class="ts fileinput" name="bf_file[]" id="bf_file[]" value="파일선택" multiple="multiple" />
                </li>
            </ul>
        </li>
        
        @if ($errors->has('bf_file.*'))
        <li>
            <span class="text-danger">{{ $errors->first('bf_file.*') }}</span>
        </li>
        @endif

    </ul>
    <!-- 파일첨부하기:종료 !-->

    <!-- Captcha -->
    <script type="text/javascript">
        /* 문자 새로고침 */
        function refresh_captcha(){
            document.getElementById("capt_img").src="{{route('captcha')}}?waste="+Math.random(); 
            // capt_img id를 불러와 문구들을 랜덤으로 돌린다
        }
    </script>
		<h2>자동가입방지문구 입력</h2><img src="{{route('captcha')}}" alt="captcha" title="captcha" id="capt_img"/>
        <input type="text" name="captcha" />
	    <a href="javascript:refresh_captcha();">새로고침</a>

    <!-- // Captcha -->

    <!--하단버튼:시작!-->
    <div class="sendbtn">
        <input type="submit" value="등록">
        <input type="button" value="취소">
    </div>
    <!--하단버튼:종료!-->
    
</div>

</form>

<script type="text/javascript">
// <![CDATA[
$(document).ready(function(){
    // 첨부파일 관련 스크립트
    $('.con_file_plus').bind('click', function(){
        $('.finput_box').append('<li><input type="file" class="ts fileinput" name="bf_file[]" value="" multiple="multiple" /></li>');
    });
    $('.con_file_minus').bind('click', function(){
        if($('.finput_box > li').size() == 1) return false;
        
        $('.finput_box > li:last').remove();
    });


});
// ]]>
</script>
</div>

@section('header')
@include('board/footer')