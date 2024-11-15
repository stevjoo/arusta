<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BehindTheLenseController;
use App\Http\Controllers\PhotographyController;
use App\Http\Controllers\GraphicDesignController;
use App\Http\Controllers\VideoReelsController;
use App\Models\GraphicDesign;
use App\Models\VideoReels;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/contact',[ContactFormController::class, 'form_view']);
Route::post('/post-message',[ContactFormController::class,'post_message']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('admin-behind-the-lense', BehindTheLenseController::class)
    ->names([
        'adminbtlindex' => 'admin-behind-the-lense.index',
        'adminbtlcreate' => 'admin-behind-the-lense.create',
        'adminbtlstore' => 'admin-behind-the-lense.store',
        'adminbtlshow' => 'admin-behind-the-lense.show',
        'adminbtledit' => 'admin-behind-the-lense.edit',
        'adminbtlupdate' => 'admin-behind-the-lense.update',
        'adminbtldestroy' => 'admin-behind-the-lense.destroy',
    ]);


Route::resource('admin-photography', PhotographyController::class)
    ->names([
        'adminphotographyindex' => 'admin-photography.index',
        'adminphotographycreate' => 'admin-photography.create',
        'adminphotographystore' => 'admin-photography.store',
        'adminphotographyshow' => 'admin-photography.show',
        'adminphotographyedit' => 'admin-photography.edit',
        'adminphotographyupdate' => 'admin-photography.update',
        'adminphotographydestroy' => 'admin-photography.destroy',
    ]);


Route::resource('admin-graphic-design', GraphicDesignController::class)
    ->names([
        'admingraphicdesignindex' => 'admin-graphic-design.index',
        'admingraphicdesigncreate' => 'admin-graphic-design.create',
        'admingraphicdesignstore' => 'admin-graphic-design.store',
        'admingraphicdesignshow' => 'admin-graphic-design.show',
        'admingraphicdesignedit' => 'admin-graphic-design.edit',
        'admingraphicdesignupdate' => 'admin-graphic-design.update',
        'admingraphicdesigndestroy' => 'admin-graphic-design.destroy',
    ]);


Route::resource('admin-video-reels', VideoReelsController::class)
    ->names([
        'adminvideoreelsindex' => 'admin-video-reels.index',
        'adminvideoreelscreate' => 'admin-video-reels.create',
        'adminvideoreelsstore' => 'admin-video-reels.store',
        'adminvideoreelsshow' => 'admin-video-reels.show',
        'adminvideoreelsedit' => 'admin-video-reels.edit',
        'adminvideoreelsupdate' => 'admin-video-reels.update',
        'adminvideoreelsdestroy' => 'admin-video-reels.destroy',
    ]);

require __DIR__ . '/auth.php';