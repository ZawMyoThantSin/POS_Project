<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//  project start=>
Route::redirect('/', 'auth/login');
Route::middleware('admin')->group(function(){
    Route::get('auth/register',[AuthController::class,'registerPage'])->name('userRegister');
    Route::get('auth/login',[AuthController::class,'loginPage'])->name('userLogin');
});

// github and google login
Route::get('/auth/{provider}/redirect',[ProviderController::class,'redirect']);
Route::get('/auth/{provider}/callback',[ProviderController::class,'callback']);
