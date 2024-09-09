<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MissionController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\HomeController;
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

Route::name('client.')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

    Route::get('/pencil', [HomeController::class, 'showPencil'])->name('showPencil');
    Route::post('/pencil', [HomeController::class, 'pencil'])->name('pencil');

    Route::get('/checkin', [HomeController::class, 'showCheckin'])->name('showCheckin');
    Route::post('/checkin', [HomeController::class, 'checkin'])->name('checkin');

    Route::get('/room', [HomeController::class, 'room'])->name('room');

});

Route::get('auth/login', [LoginController::class, 'showLogin'])->name('showLogin');
Route::post('auth/login', [LoginController::class, 'login'])->name('login');

Route::get('auth/register', [RegisterController::class, 'showRegister'])->name('showRegister');
Route::post('auth/register', [RegisterController::class, 'register'])->name('register');


Route::prefix('admin')->name('admin.')->group(function () {
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
