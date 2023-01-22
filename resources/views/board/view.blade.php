@section('header')
@include('board/header')

<!-- Contents(내용) -->
@foreach ($boardview as $item)
<div class="manage">
	<ul class="view-top" style="position:relative">
			<li class="subject">
			<p>
				<strong>
                    {{$item->b_subject}}
                </strong>
			</p>
		</li>
		<li class="writer">
			<span>
                <strong>작성자 : </strong>{{$item->b_author}}
            </span>
			<span class="date"><strong>작성일 : </strong>{{$item->b_regidate}}</span>
			<span><strong>조회수 : </strong>{{$item->b_cnt}}</span>
			<span><strong>아이피 : </strong>{{$item->b_regidate}}</span>
		</li>
	</ul>
</div>

<!-- 본문-->
<div class="view-contents">
    <div id="EditorViewer">
        <p style='margin:10px 0px;'>
        {{$item->b_content}}
	</div>
</div>
<!-- Contents(내용) -->
@endforeach
<div class="fieldBox manage">
	<dl>
		<dt></dt>
		<dd>
			<ul>
                <li>1.
                    <a href="javascript:file_download('1');" title="logo_sample.gif 다운받기">
					logo_sample.gif (27.40 Kb) Hit: 1</a>
                </li>
			</ul>
		</dd>
	</dl>
</div>

@section('footer')
@include('board/footer')