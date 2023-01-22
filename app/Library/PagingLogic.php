<?php
/*
    Filename: PagingLogic.php
    Created Date: 2022-12-30(Fri)
    Author: Doyoon Jung (rabbitsun2@gmail.com)
    Description: 
    1. 초기 생성, 2022-12-30, Doyoon.

*/

    namespace App\Library;
    use Illuminate\Support\Facades\Log;

    class PagingLogic {
        
        private $pageSize; 			// 게시 글 수
        private $firstPageNo; 		// 첫 번째 페이지 번호
        private $prevPageNo; 		// 이전 페이지 번호
        private $startPageNo; 		// 시작 페이지 (페이징 네비 기준)
        private $pageNo; 			// 페이지 번호
        private $endPageNo; 		// 끝 페이지 (페이징 네비 기준)
        private $nextPageNo; 		// 다음 페이지 번호
        private $finalPageNo; 		// 마지막 페이지 번호
        private $totalCount; 		// 게시 글 전체 수
        private $dbStartNum;		// db 조회 (시작번호)
        private $dbEndNum;			// db 조회 (종료번호)

        /**
         * @return the pageSize
         */
        public function getPageSize() {
            return $this->pageSize;
        }

        /**
         * @param pageSize the pageSize to set
         */
        public function setPageSize($pageSize) {
            $this->pageSize = $pageSize;
        }

        /**
         * @return the firstPageNo
         */
        public function getFirstPageNo() {
            return $this->firstPageNo;
        }

        /**
         * @param firstPageNo the firstPageNo to set
         */
        public function setFirstPageNo($firstPageNo) {
            $this->firstPageNo = $firstPageNo;
        }

        /**
         * @return the prevPageNo
         */
        public function getPrevPageNo() {
            return $this->prevPageNo;
        }

        /**
         * @param prevPageNo the prevPageNo to set
         */
        public function setPrevPageNo($prevPageNo) {
            $this->prevPageNo = $prevPageNo;
        }

        /**
         * @return the startPageNo
         */
        public function getStartPageNo() {
            return $this->startPageNo;
        }

        /**
         * @param startPageNo the startPageNo to set
         */
        public function setStartPageNo($startPageNo) {
            $this->startPageNo = $startPageNo;
        }

        /**
         * @return the pageNo
         */
        public function getPageNo() {
            return $this->pageNo;
        }

        /**
         * @param pageNo the pageNo to set
         */
        public function setPageNo($pageNo) {
            $this->pageNo = $pageNo;
        }

        /**
         * @return the endPageNo
         */
        public function getEndPageNo() {
            return (int)$this->endPageNo;
        }

        /**
         * @param endPageNo the endPageNo to set
         */
        public function setEndPageNo($endPageNo) {
            $this->endPageNo = $endPageNo;
        }

        /**
         * @return the nextPageNo
         */
        public function getNextPageNo() {
            return (int)$this->nextPageNo;
        }

        /**
         * @param nextPageNo the nextPageNo to set
         */
        public function setNextPageNo($nextPageNo) {
            $this->nextPageNo = $nextPageNo;
        }

        /**
         * @return the finalPageNo
         */
        public function getFinalPageNo() {
            return (int)$this->finalPageNo;
        }

        /**
         * @param finalPageNo the finalPageNo to set
         */
        public function setFinalPageNo($finalPageNo) {
            $this->finalPageNo = $finalPageNo;
        }

        /**
         * @return the totalCount
         */
        public function getTotalCount() {
            return $this->totalCount;
        }

        /**
         * @param totalCount the totalCount to set
         */
        public function setTotalCount($totalCount) {
            $this->totalCount = $totalCount;
            $this->makePaging();
            $this->makeDbPaging();
        }

        /**
         * 페이징 생성 (setTotalCount에서 호출함)
         */
        private function makePaging() {
            
            if ($this->totalCount === 0) 
                return; 
            
            // 게시 글 전체 수가 없는 경우
            
            if ($this->pageNo === 0) 
                $this->setPageNo(1); // 기본 값 설정
            
            if ($this->pageSize === 0) 
                $this->setPageSize(10); // 기본 값 설정

            $finalPage = ($this->totalCount + ($this->pageSize - 1)) / $this->pageSize; // 마지막 페이지
            
            if ($this->pageNo > $finalPage) 
                $this->setPageNo($finalPage); // 기본 값 설정

            if ($this->pageNo < 0 || $this->pageNo > $finalPage) 
                $this->pageNo = 1; // 현재 페이지 유효성 체크

            if ($this->pageNo === 1){
                $isNowFirst = true;
            }else{
                $isNowFirst = false;
            }   // 시작 페이지 (전체)

            if ($this->pageNo === $finalPage ){
                $isNowFinal = true;
            }else{
                $isNowFinal = false; 
            }   // 마지막 페이지 (전체)

            //boolean isNowFirst = pageNo == 1 ? true : false; // 시작 페이지 (전체)
            //boolean isNowFinal = pageNo == finalPage ? true : false; // 마지막 페이지 (전체)

            $startPage = (($this->pageNo - 1) / 10) * 10 + 1; // 시작 페이지 (페이징 네비 기준)
            $endPage = $startPage + 10 - 1; // 끝 페이지 (페이징 네비 기준)

            if ($endPage > $finalPage) { // [마지막 페이지 (페이징 네비 기준) > 마지막 페이지] 보다 큰 경우
                $endPage = $finalPage;
            }

            $this->setFirstPageNo(1); // 첫 번째 페이지 번호

            if ($isNowFirst) {
                $this->setPrevPageNo(1); 									   // 이전 페이지 번호
            } else {

                if ( ($this->pageNo - 1) < 1 ){
                    $num = 1;
                }else{
                    $num = ($this->pageNo - 1);
                }

                $this->setPrevPageNo($num);

                //$this->setPrevPageNo((($this->pageNo - 1) < 1 ? 1 : ($this->pageNo - 1))); // 이전 페이지 번호
            }

            $this->setStartPageNo($startPage); // 시작 페이지 (페이징 네비 기준)
            $this->setEndPageNo($endPage); // 끝 페이지 (페이징 네비 기준)

            if ($isNowFinal) {
                $this->setNextPageNo($finalPage); // 다음 페이지 번호
            } else {

                if(($this->pageNo + 1) > $finalPage){
                    $num = $finalPage;
                }
                else{
                    $num = ($this->pageNo + 1);
                }

                $this->setNextPageNo($num);

                //this.setNextPageNo(((pageNo + 1) > finalPage ? finalPage : (pageNo + 1))); // 다음 페이지 번호
            }

            $this->setFinalPageNo($finalPage); // 마지막 페이지 번호
            
        }
        
        private function makeDbPaging() {
            
            $current = $this->getPageNo();
            $weight = $this->getPageSize();
            $endNum = 0;
            
            $this->setDbEndNum( $current * $weight );
            
            $endNum = $this->getDbEndNum();
            $this->setDbStartNum( ($endNum - $weight) + 1 );
            
        }

        /**
         * @return the dbStartNum
         */
        public function getDbStartNum() {
            return $this->dbStartNum;
        }

        /**
         * @param dbStartNum the dbStartNum to set
         */
        public function setDbStartNum($dbStartNum) {
            $this->dbStartNum = $dbStartNum;
        }
        
        /**
         * @return dbEndNum
         */
        public function getDbEndNum() {
            return $this->dbEndNum;
        }

        /**
         * @param dbEndNum the dbEndNum to set
         */
        public function setDbEndNum($dbEndNum) {
            $this->dbEndNum = $dbEndNum;
        }

        public function getObject(){

            $rows = array();

            $rows['pageNo'] = $this->getPageNo();
            $rows['firstPageNo'] = $this->getFirstPageNo();
            $rows['prevPageNo'] = $this->getPrevPageNo();
            $rows['startPageNo'] = $this->getStartPageNo();
            $rows['endPageNo'] = $this->getEndPageNo();
            $rows['nextPageNo'] = $this->getNextPageNo();
            $rows['finalPageNo'] = $this->getFinalPageNo();

            return $rows;

        }
        
    }

?>