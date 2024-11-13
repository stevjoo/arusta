<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BehindTheLenseController;
use App\Http\Controllers\PhotographyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('admin-behind-the-lense', BehindTheLenseController::class)
     ->names([
         'adminbtlindex'   => 'admin-behind-the-lense.index',
         'adminbtlcreate'  => 'admin-behind-the-lense.create',
         'adminbtlstore'   => 'admin-behind-the-lense.store',
         'adminbtlshow'    => 'admin-behind-the-lense.show',
         'adminbtledit'    => 'admin-behind-the-lense.edit',
         'adminbtlupdate'  => 'admin-behind-the-lense.update',
         'adminbtldestroy' => 'admin-behind-the-lense.destroy',
     ]);

     Route::resource('admin-photography', PhotographyController::class)
     ->names([
         'adminphotographyindex'   => 'admin-photography.index',
         'adminphotographycreate'  => 'admin-photography.create',
         'adminphotographystore'   => 'admin-photography.store',
         'adminphotographyshow'    => 'admin-photography.show',
         'adminphotographyedit'    => 'admin-photography.edit',
         'adminphotographyupdate'  => 'admin-photography.update',
         'adminphotographydestroy' => 'admin-photography.destroy',
     ]);

require __DIR__.'/auth.php';
