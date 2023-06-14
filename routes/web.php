<?php
namespace App\Http\Controllers;


use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

Route::get('/', function () {
    return view('welcome');
});



// Route::get('/xinchao',[UserController::class , 'Xinchao' ]);

// Route::get('/user',[UserController::class , 'GetIndex']);

// //bài sum 
// Route::get('/tinhtong',[UserController::class,'tinhtong']);


// Route::post('/tinhtong',[UserController::class,'tinhtong']);

// //bài areaOfShape
// Route::get('/computeArea', [UserController::class, 'computeArea']);

// // GET: được sử dụng để lấy thông tin từ sever theo URI đã cung cấp.
// Route::post('/computeArea', [UserController::class, 'computeArea']);

// // POST: gửi thông tin tới sever thông qua các biểu mẫu http (đăng kí chả hạn ...);
// Route::get('/signup',[SignupController::class ,'index']);

// Route::post('/signup',[SignupController::class ,'displayInfor']);



// Route::get('/addrooms', [addRoomsController::class, 'index']);
// Route::post('/addrooms', [addRoomsController::class, 'showrooms']);



Route::get('/ac',[PageController::class,'getIndex']);
Route::get('/slide',[PageController::class,'slide']);

Route::get('/type/{id}',[PageController::class,'getLoaiSp']);

Route::get('/detail/{id}',[PageController::class,'getDetail']);


Route::get('/admin', [PageController::class,'getIndexAdmin']);


Route::get('/admin-add-form',[PageController::class,'getAdminAdd'])->name('add-product');

Route::post('/admin-add-form',[PageController::class,'postAdminAdd']);

Route::get('/admin-edit-form/{id}', [PageController::class, 'getAdminEdit']);													

Route::post('/admin-edit',[PageController::class,'postAdminEdit']);

Route::post('/admin-delete/{id}',[PageController::class,'postAdminDelete']);

Route::get('admin-export',[PageController::class,'exportAdminProduct'])->name('export');

Route::get('/register', function () {						
    return view('users.register');						
	});						


Route::post('register',[UserController::class,'Register']);

Route::get('/login', function () {						
	 return view('users.login');						
	});						
Route::post('/login',[UserController::class,'Login']);

Route::get('/trangchu',[PageController::class,'getIndex']);

Route::get('/logout',[UserController::class,'Logout']);

// Cart

Route::get('add-to-cart/{id}', [PageController::class, 'getAddToCart'])->name('themgiohang');												
Route::get('del-cart/{id}', [PageController::class, 'getDelItemCart'])->name('xoagiohang');												

Route::get('/', function(){
    return redirect('/trangchu');
});
// Route::get('/',[PageController::class,'marter']);


// Route::get('/',[PageController::class,'if']);

// Route::get('/',[PageController::class,'for']);

// Route::get('/',[PageController::class,'lienhe']);

// Route::get('/',[PageController::class,'about']);


Route::get('/products', [ProductController::class, 'index'])->name('products.index');














Route::get('/tinhtich/{a}/{b}', function ($a,$b) {
    echo $a*$b;exit;
    
})->whereNumber('a')->whereNumber('b');
Route::get('/tinhtong/{a}/{b}', function ($a,$b) {
    echo $a+$b;exit;
    
})->whereNumber('a')->whereNumber('b');
Route::get('/tinhhieu/{a}/{b}', function ($a,$b) {
    echo $a-$b;exit;
    
})->whereNumber('a')->whereNumber('b');
Route::get('/tinhthuong/{a}/{b}', function ($a,$b) {
    echo $a/$b;exit;
    
})->whereNumber('a')->whereNumber('b');