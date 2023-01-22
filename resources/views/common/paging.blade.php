
<?php

?>
<!-- 페이지네이션 -->
<nav aria-label="Page navigation">
        <ul class="pagination pagination-primary">
                <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $board_paging->getFirstPageNo();?>">처음</a>
                </li>
                <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $board_paging->getPrevPageNo();?>">이전</a>
                </li>
                <?php
                for ($i = $board_paging->getStartPageNo(); $i <= $board_paging->getEndPageNo(); $i++){

                        if ( $i == $board_paging->getPageNo() ){
                ?>
                        <li class="page-item active">
                                <a class="page-link" href="?page={{$i}}">{{$i}}</a>
                        </li>
                <?php
                        }
                        else{
                ?>
                        <li class="page-item">
                                <a class="page-link" href="?page={{$i}}">{{$i}}</a>
                        </li>
                <?php
                        }
                ?>
                <?php
                }
                ?>
                <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $board_paging->getNextPageNo();?>">다음</a>
                </li>
                <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $board_paging->getFinalPageNo();?>">마지막</a>
                </li>
        </ul>
</nav>