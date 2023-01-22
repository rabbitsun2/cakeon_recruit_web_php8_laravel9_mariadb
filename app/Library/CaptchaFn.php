<?php
/*
    Filename: CaptchaFn.php
    Created Date: 2022-12-31(Sat)
    Author: Doyoon Jung (rabbitsun2@gmail.com)
    Description: 
    1. 초기 생성, 2022-12-31, Doyoon.
    2. 요구사항 - php gd라이브러리 활성화할 것, 2022-12-31, Doyoon.

*/
    namespace App\Library;

    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Storage;

    class CaptchaFn {

        public function print_captcha(){

            //session_start();
            header('Content-Type: image/png');

            $captcha = '';

            // 문자열 패턴
            $pattern = '123456789QWEERTYUIOPASZDFGHJKLZMXNCBVqpwoeirutyalskdjfhgzmxncbv'; //패턴 설정
            for($i = 0, $len = strlen($pattern) -1; $i < 6; $i++){ // 6가지 문자 생성
                $captcha .= $pattern[rand(0, $len)];
            }

            $_SESSION['capt'] = $captcha;
            
            // 크기 지정
            $width = 80;
            $height = 30;

            $img = imagecreatetruecolor($width, $height);               // 크기
            imagefilledrectangle($img, 0, 0, 100, 100, 0xCCFFE5);       // 배경색
            imagestring($img, 5, 15, 15, $captcha, 0x3399FF);           // 문자 여백, 문자색상
            imageline($img,0,rand() % 20, 100, rand() % 20, 0x001458);  // 줄 색상 
            imagepng($img);
            imagedestroy($img);                                         // 초기화

        }

        public function compare_captcha($input_captcha){
    
            //if($_SESSION['capt'] != $_POST['captcha'])
            if($_SESSION['capt'] != $_POST['captcha'])
    		{
                return false;   // 올바르지 않음.
		    }else{
                return true;    // 올바름.
		    }
            
        }

    }