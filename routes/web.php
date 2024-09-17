<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Client\ClientController;
use App\Http\Middleware\checkLogin;
use App\Http\Middleware\CheckRoomPassword;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\GuestController;

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
Route::get('login', [LoginController::class, 'showLogin'])
->name('showLogin');
Route::post('login',[LoginController::class, 'login']);

Route::get('register',[LoginController::class, 'showRegister'])
->name('showRegister');
Route::post('register',[LoginController::class, 'register'])->name('registerPost');

Route::get('forgetPassword',[LoginController::class,'showForgotPassword'])
->name('forget.password');
Route::post('forgetPassword',[LoginController::class,'forgotPassword'])
->name('forget.password.post');

route::get('resetPassword/{token}',[LoginController::class,'resetPassword'])
->name('reset.password');
route::post('resetPassword',[LoginController::class,'resetPasswordPost'])
->name('reset.password.post');

Route::get('Logout',action: Logout::class)->name('logout');

Route::name('guest.')->group(function(){
    Route::get('/', [GuestController::class, 'index'])->name('index');
    Route::get('/contactUs', [GuestController::class, 'contactUs'])->name('contactUs');
    Route::get('/aboutUs', [GuestController::class, 'aboutUs'])->name('aboutUs');

});

Route::name('client.')->middleware([checkLogin::class])->group(function(){
    Route::get('index', [ClientController::class, 'index'])->name('index')->middleware([CheckRoomPassword::class]);

    Route::get('room', [ClientController::class, 'showRooms'])->name('rooms.show');
    Route::post('/rooms/create', [ClientController::class, 'storeRoom'])->name('rooms.store');
    Route::post('/rooms/{id}/enter', [ClientController::class, 'enterRoom'])->name('rooms.enter');

    Route::get('account/{id}', [ClientController::class, 'showAccount'])->name('showAccount');
    Route::get('change-account/{id}', [ClientController::class, 'changeAccount'])->name('changeAccount');
    Route::post('account/{id}', [ClientController::class, 'account'])->name('account');

    Route::get('checkin', [ClientController::class, 'showCheckin'])->name('showCheckin')->middleware([CheckRoomPassword::class]);
    Route::post('checkin', [ClientController::class, 'checkin'])->name('checkin')->middleware([CheckRoomPassword::class]);

    

});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('index', [AdminController::class, 'index'])->name('index');
    Route::prefix('contact')->name('contact.')->controller(ContactController::class)->group(function () {
        Route::get('index', 'index')->name('index');

        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');

        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('mission')->name('mission.')->controller(MissionController::class)->group(function () {
        Route::get('index', 'index')->name('index');

        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');

        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
        Route::get('index', 'index')->name('index');

        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');

        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });
});
