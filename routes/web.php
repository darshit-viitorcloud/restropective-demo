<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[DemoController::class,'index'])->name('home');
Route::get('page-1',[DemoController::class,'page1'])->name('page-1');
//Route::any('openAi',[DemoController::class,'view'])->name('openAi');
Route::post('text-moderation',[DemoController::class,'textModeration'])->name('text-moderation');
Route::post('spell-check',[DemoController::class,'spellCheck'])->name('spell-check');
Route::post('text-completion',[DemoController::class,'textCompletion'])->name('text-completion');
Route::post('image-generation',[DemoController::class,'imageGeneration'])->name('image-generation');
Route::post('image-variation',[DemoController::class,'imageVariation'])->name('image-variation');
