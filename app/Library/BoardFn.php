<?php
/*
    Filename: BoardFn.php
    Created Date: 2022-12-30(Fri)
    Author: Doyoon Jung (rabbitsun2@gmail.com)
    Description: 
    1. 초기 생성, 2022-12-30, Doyoon.

*/
    namespace App\Library;

    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\DB;

    class BoardFn {

        private $boardname;
        
        public function getBoardname(){
            return $this->boardname;
        }

        public function setBoardname($boardname){
            $this->boardname = $boardname;
        }

        public function isBoardname(){
                
            // 게시판 생성 유무
            $boardname_is_qry = "select count(*) as `cnt` from cake_board " .
                                   "where ck_boardname = :ck_boardname";

            $board_bind = array();
            $board_bind['ck_boardname'] = $this->getBoardname();

            $results = DB::select($boardname_is_qry, $board_bind);
            $board_cnt = 0;
            
            // 존재 유무
            foreach($results as $item){
                $board_cnt = $item->cnt;
            }

            if ( $board_cnt === 1 ){
                return true;
            }else{
                return false;
            }

        }

    }

?>