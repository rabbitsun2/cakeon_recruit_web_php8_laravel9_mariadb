<?php
/*
    Filename: Controller.php
    Created Date: 2022-12-30(Fri)
    Author: Doyoon Jung (rabbitsun2@gmail.com)
    Description: 
    1. 초기 생성, 2022-12-30, Doyoon.

*/

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
