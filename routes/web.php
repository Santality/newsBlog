<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [NewsController::class, 'index']);

Route::post('/signin', [UserController::class, 'signIn']);

Route::post('/signup', [UserController::class, 'signUp']);

Route::get('/auth', function(){
    return view('auth');
});

Route::get('/reg', function(){
    return view('reg');
});

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/news/{id}', [NewsController::class, 'detailNews']);

Route::get('/list/{id}', [NewsController::class, 'list']);

Route::middleware('checkRole:Пользователь')->group(function(){

    Route::get('/like/{id}', [NewsController::class, 'like']);

    Route::get('/profile', [UserController::class, 'profile']);

    Route::post('/editProfile', [UserController::class, 'editProfile']);

    Route::post('/commentCreate', [NewsController::class, 'comment']);
});

Route::middleware('checkRole:Администратор')->group(function(){

    Route::get('/admin', [AdminController::class, 'admin']);

    Route::get('/addNews', [AdminController::class, 'addNews']);

    Route::post('/createNews', [AdminController::class, 'createNews']);

    Route::get('/block/{id}', [AdminController::class, 'block']);

    Route::get('/unblock/{id}', [AdminController::class, 'unblock']);

    Route::get('/delete/{id}', [AdminController::class, 'delete']);

    Route::get('/editNews/{id}', [AdminController::class, 'editNews']);

    Route::post('/updateNews', [AdminController::class, 'updateNews']);

    Route::get('/userList', [AdminController::class, 'userList']);

    Route::get('/blockUser/{id}', [AdminController::class, 'blockUser']);

    Route::get('/unblockUser/{id}', [AdminController::class, 'unblockUser']);
});
