<?php
/*
    Filename: web.php
    Created Date: 2022-12-30(Fri)
    Author: Doyoon Jung (rabbitsun2@gmail.com)
    Description: 
    1. 초기 생성, 2022-12-30, Doyoon.

*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CareerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MainController::class, 'index'])->name('default');
Route::get('/cakeon/about', [MainController::class, 'about']);
Route::get('/cakeon/executive', [MainController::class, 'executive']);
Route::get('/cakeon/history', [MainController::class, 'history']);
Route::get('/cakeon/product/sw', [MainController::class, 'product_sw']);
Route::get('/cakeon/product/hw', [MainController::class, 'product_hw']);

Route::get('/cakeon/career', [CareerController::class, 'index'])->name('career');
Route::post('/cakeon/career_ok', [CareerController::class, 'career_ok'])->name('career_ok');
Route::get('/cakeon/career/list/{country}/{region}/{position}/{job_type}/{relation}/{corporation}', [CareerController::class, 'list'])->name('career.list');
Route::get('/cakeon/career/view/{career_id}/{country}/{region}/{position}/{job_type}/{relation}/{corporation}', [CareerController::class, 'view'])->name('career.view');

Route::get('/cakeon/career/apply/{career_id}', [CareerController::class, 'apply'])->name('career.apply');
Route::post('/cakeon/career/apply/signin_ok/{career_id}', [CareerController::class, 'signin_ok'])->name('career.signin');
Route::get('/cakeon/career/apply/signup/{career_id}', [CareerController::class, 'signup'])->name('career.signup');
Route::post('/cakeon/career/apply/signup_ok/{career_id}', [CareerController::class, 'signup_ok'])->name('career.signup_ok');
Route::get('/cakeon/career/apply/profile/{career_id}', [CareerController::class, 'profile'])->name('career.profile');
Route::post('/cakeon/career/apply/profile/{career_id}', [CareerController::class, 'profile_ok'])->name('career.profile_ok');
Route::get('/cakeon/career/apply/education/{career_id}', [CareerController::class, 'education'])->name('career.education');
Route::post('/cakeon/career/apply/education/{career_id}', [CareerController::class, 'education_ok'])->name('career.education_ok');

Route::post('/add', [MainController::class, 'add'])->name('add');
Route::get('/captcha', [MainController::class, 'captcha'])->name('captcha');
Route::get('/board/{boardname}/list', [BoardController::class, 'list']);
Route::get('/board/{boardname}/list/{page}', [BoardController::class, 'list']);
Route::get('/board/{boardname}/view/{b_id}', [BoardController::class, 'view']);
Route::get('/board/{boardname}/write', [BoardController::class, 'write'])->name('write');
Route::post('/board/{boardname}/write', [BoardController::class, 'write_ok']);