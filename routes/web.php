<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\TranslateController;

Route::get('/', [TranslateController::class, 'index'])->name('translate.view');
Route::post('/translate', [TranslateController::class, 'translate'])->name('translate.run');
Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::get('/generate-pdf', [PdfController::class, 'downloadReceivable'])->name('pdf.generate');
