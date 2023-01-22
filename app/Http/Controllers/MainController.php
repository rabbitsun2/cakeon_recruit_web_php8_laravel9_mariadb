<?php
/*
    Filename: MainController.php
    Created Date: 2022-12-30(Fri)
    Author: Doyoon Jung (rabbitsun2@gmail.com)
    Description: 
    1. 초기 생성, 2022-12-30, Doyoon.

*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Library\CaptchaFn;


class MainController extends Controller
{
    //
    public function index(Request $request){

        $data['title'] = "CAKEON Project";
        return view('index', $data);
    }

    public function about(){
        $data['title'] = "소개(About) / CAKEON Project";
        return view('page/about', $data);
    }

    public function executive(){
        $data['title'] = "경영진(Executive) / CAKEON Project";
        return view('page/executive', $data);
    }

    public function history(){
        $data['title'] = "역사(History) / CAKEON Project";
        return view('page/history', $data);
    }

    public function product_sw(){
        $data['title'] = "제품(Product) - 소프트웨어 / CAKEON Project";
        return view('cakeon/product/sw', $data);
    }

    public function product_hw(){
        $data['title'] = "제품(Product) - 하드웨어 / CAKEON Project";
        return view('cakeon/product/hw', $data);
    }

    public function add(Request $request){

        $title = $request->input('title');
        echo "[" . $title . "]";

        $data['title'] = $request->input('title');
        $data['body'] = $request->input('body');
        $data['totalpage'] = $request->input('totalpage');
        $data['author'] = $request->input('author');

        return view('add', $data);

    }
    
    public function captcha(){

        $captcha = new CaptchaFn();
        $captcha->print_captcha();

    }

}
