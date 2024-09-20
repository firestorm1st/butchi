<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\RoomController;
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
    Route::get('/contactUs', [GuestController::class, 'showContactUs'])->name('showContactUs');
    Route::post('/contactUs', [GuestController::class, 'contactUs'])->name('contactUs');
    Route::get('/aboutUs', [GuestController::class, 'aboutUs'])->name('aboutUs');
    
    

});

Route::name('client.')->middleware([checkLogin::class])->group(function(){
    Route::get('index/{id}', [RoomController::class, 'index'])->name('index')->middleware([CheckRoomPassword::class]);
    Route::get('emotion/{id}', [RoomController::class, 'showFullEmo'])->name('emotion.full')->middleware([CheckRoomPassword::class]);

    Route::get('room', [RoomController::class, 'showRooms'])->name('rooms.show');
    Route::post('/rooms/create', [RoomController::class, 'storeRoom'])->name('rooms.store');
    Route::post('client/rooms/enter/{id}', [RoomController::class, 'enterRoom'])
    ->name('rooms.enter');
    Route::post('/logout-room', [RoomController::class, 'logoutRoom'])->name('logoutRoom');

    Route::get('account/{id}', [AccountController::class, 'showAccount'])->name('showAccount');
    Route::get('change-account/{id}', [AccountController::class, 'changeAccount'])->name('changeAccount');
    Route::post('account/{id}', [AccountController::class, 'account'])->name('account');

    Route::get('chart', [AccountController::class, 'chart'])->name('chart');
    // Route::get('data', [ClientController::class, 'getIconData']);

    Route::get('/emotion/{id}/tracker', [RoomController::class, 'showEmotionForm'])->name('emotion.form')->middleware([CheckRoomPassword::class]);
    Route::post('/emotion/{id}/store', [RoomController::class, 'saveEmotionDaily'])->name('emotion.store')->middleware([CheckRoomPassword::class]);

    Route::get('checkin', [ClientController::class, 'showCheckin'])->name('showCheckin');
    Route::post('checkin', [ClientController::class, 'checkin'])->name('checkin');

    
    

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
