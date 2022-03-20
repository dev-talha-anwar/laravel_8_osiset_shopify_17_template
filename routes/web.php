<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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
Route::group(['middleware' => ['verify.shopify']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/add-query', [HomeController::class, 'add'])->name('add')->middleware('inquiry.limit.check');
    Route::get('/check', [HomeController::class, 'check'])->name('check');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/data', [AdminController::class, 'data'])->name('admin.data');
Route::post('/admin/changeStatus/{id}', [AdminController::class, 'changeStatus'])->name('admin.changeStatus');


Route::get('/login',function(){
	return view('shopify.login');
})->name('login');



Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);