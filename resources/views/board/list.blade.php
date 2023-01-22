@section('header')
@include('board/header')
    <table>
        <tr>
            <td>번호</td>
            <td>제목</td>
            <td>파일여부</td>
            <td>작성자명</td>
            <td>등록일자</td>
            <td>조회수</td>
        </tr>
        @foreach ($board_list as $item)
        <tr>
            <td>{{$item->b_id}}</td>
            <td>
                <a href="view/{{$item->b_id}}">{{$item->b_subject}}</a>
            </td>
            <td>{{$item->b_file_exist}}</td>
            <td>{{$item->b_author}}</td>
            <td>{{$item->b_regidate}}</td>
            <td>{{$item->b_cnt}}</td>
        </tr>
        @endforeach
    </table>

<?php
    $data = array();
    //print_r($board_paging);
    $data['board_paging'] = $board_paging;
?>

@section('paging')
@include('common/paging', $data)

<a href="write">글쓰기</a>

@section('footer')
@include('board/footer')
