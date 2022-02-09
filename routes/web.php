<?php

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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('account.login');
})->name('login');
Route::post('/login', [LoginController::class, 'checkLogin'])->name('checkLogin');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role'], function () {
        //Route department
        Route::get('/department', [DepartmentController::class, 'index'])->name('department');
        Route::get('/department/create', [DepartmentController::class, 'create'])->name('department/create');
        Route::post('/department/store', [DepartmentController::class, 'store'])->name('department/store');
        Route::get('/department/{id}/edit', [DepartmentController::class, 'edit'])->name('department/edit');
        Route::post('/department/{id}/update', [DepartmentController::class, 'update'])->name('department/update');
        Route::get('/department/{id}/delete', [DepartmentController::class, 'delete'])->name('department/delete');
        //End route department

        //Route user
        Route::resource('user', 'UserController')->except(['index']);
        //End route user

        Route::get('/reset-password/{id}', [ResetPasswordController::class, 'resetPassword'])->name('reset_password');
    });
    Route::get('/export/user', [UserController::class, 'export'])->name('user.export')->middleware('role:' . config('common.IS_MANAGEMENT'));
    Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware('role:' . config('common.IS_MANAGEMENT'));

    //Route login logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    //End route login logout

    //Route profile user
    Route::get('/profile', function () {
        return view('users.profile');
    })->name('profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('user.update-profile');
    //End route profile user


    Route::get('/change-password', function () {
        return view('account.changePassword');
    })->name('change-password');

    Route::post('/update', [UserController::class, 'changePassword'])->name('user.change-password');
});
