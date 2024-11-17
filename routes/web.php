<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BehindTheLenseController;
use App\Http\Controllers\PhotographyController;
use App\Http\Controllers\GraphicDesignController;
use App\Http\Controllers\VideoReelsController;
use App\Models\GraphicDesign;
use App\Models\Photography;
use App\Models\VideoReels;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('usersview/main');
})->name('landing-page');

Route::get('/behind-the-lense', [BehindTheLenseController::class, 'publicIndex'])->name('behind-the-lense.index');
Route::get('/photography', [PhotographyController::class, 'publicIndex'])->name('photography.index');
Route::get('/graphic-design', [GraphicDesignController::class, 'publicIndex'])->name('graphic-design.index');
Route::get('/video-reels', [VideoReelsController::class, 'publicIndex'])->name('video-reels.index');

Route::get('/portfolio', function(){
    return view('usersview/portfolio');
})->name('portfolio');

Route::get('/schedule', function(){
    return view('usersview/schedule');
})->name('schedule');

Route::get('/contact',[ContactFormController::class, 'form_view'])->name('contactus');
Route::post('/post-message',[ContactFormController::class,'post_message']);

Route::get('/admin-dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('admin-behind-the-lense', BehindTheLenseController::class)
    ->names([
        'index' => 'admin-behind-the-lense.index',
        'create' => 'admin-behind-the-lense.create',
        'store' => 'admin-behind-the-lense.store',
        'show' => 'admin-behind-the-lense.show',
        'edit' => 'admin-behind-the-lense.edit',
        'update' => 'admin-behind-the-lense.update',
        'destroy' => 'admin-behind-the-lense.destroy',
    ])->middleware(['auth', 'verified']);


Route::resource('admin-photography', PhotographyController::class)
    ->names([
        'adminphotographyindex' => 'admin-photography.index',
        'adminphotographycreate' => 'admin-photography.create',
        'adminphotographystore' => 'admin-photography.store',
        'adminphotographyshow' => 'admin-photography.show',
        'adminphotographyedit' => 'admin-photography.edit',
        'adminphotographyupdate' => 'admin-photography.update',
        'adminphotographydestroy' => 'admin-photography.destroy',
    ])->middleware(['auth', 'verified']);


Route::resource('admin-graphic-design', GraphicDesignController::class)
    ->names([
        'admingraphicdesignindex' => 'admin-graphic-design.index',
        'admingraphicdesigncreate' => 'admin-graphic-design.create',
        'admingraphicdesignstore' => 'admin-graphic-design.store',
        'admingraphicdesignshow' => 'admin-graphic-design.show',
        'admingraphicdesignedit' => 'admin-graphic-design.edit',
        'admingraphicdesignupdate' => 'admin-graphic-design.update',
        'admingraphicdesigndestroy' => 'admin-graphic-design.destroy',
    ])->middleware(['auth', 'verified']);


Route::resource('admin-video-reels', VideoReelsController::class)
    ->names([
        'adminvideoreelsindex' => 'admin-video-reels.index',
        'adminvideoreelscreate' => 'admin-video-reels.create',
        'adminvideoreelsstore' => 'admin-video-reels.store',
        'adminvideoreelsshow' => 'admin-video-reels.show',
        'adminvideoreelsedit' => 'admin-video-reels.edit',
        'adminvideoreelsupdate' => 'admin-video-reels.update',
        'adminvideoreelsdestroy' => 'admin-video-reels.destroy',
    ])->middleware(['auth', 'verified']);
    

require __DIR__ . '/auth.php';