<?php
/*
    Filename: NetworkFn.php
    Created Date: 2023-01-13(Fri)
    Author: Doyoon Jung (rabbitsun2@gmail.com)
    Description: 
    1. 초기 생성, 2023-01-13, Doyoon.

*/
    namespace App\Library;

    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Storage;

    class NetworkFn {

        public function get_client_ip() {
            
            $ipaddress = '';

            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
                $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'Unknown';

            return $ipaddress;
        }

    }