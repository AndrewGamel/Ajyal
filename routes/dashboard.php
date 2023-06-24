<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\UsersController;

use Illuminate\Support\Facades\Route;



Route::group([
    'middleware'=> ['auth:web'],
    'as' => 'dashboard.',
    'prefix' => 'admin/dashboard'
],function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategoriesController::class,'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])->name('categories.force-delete');

    Route::resource('/categories',CategoriesController::class)->names(['index'=>'categories.index']);
    Route::get('/search',[CategoriesController::class,'search'])->name('search');
});