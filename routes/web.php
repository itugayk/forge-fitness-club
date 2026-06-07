<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/ders-programi', [PageController::class, 'timetable'])->name('timetable');
Route::get('/hizmetler', [PageController::class, 'services'])->name('services');
Route::get('/egitmenler', [PageController::class, 'trainers'])->name('trainers');
Route::get('/egitmenler/{trainer:slug}', [PageController::class, 'trainerShow'])->name('trainer.show');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{post:slug}', [PageController::class, 'blogShow'])->name('blog.show');
Route::get('/uye-ol', [PageController::class, 'join'])->name('join');
Route::get('/iletisim', [PageController::class, 'contact'])->name('contact');
