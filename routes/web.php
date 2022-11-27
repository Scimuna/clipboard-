<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClipboardController;

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



Route::get("/", [ClipboardController::class, 'index'])->name("index");
Route::post("/submitcontent", [ClipboardController::class, 'submitcontent'])->name('upload');
Route::post("/getcontent", [ClipboardController::class, 'getContent'])->name('getcontent');
Route::post("/download", [ClipboardController::class, 'download'])->name('download');
