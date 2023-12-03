<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrantionController;

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
Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', [DisplayController::class,'index'])->name('index');
    Route::get('/recipe/{recipe}/post', [DisplayController::class,'post'])->name('post');
    Route::get('/recipe_create',[RegistrantionController::class,'recipe_create_form'])->name('recipe_create');
    Route::post('/recipe_create',[RegistrantionController::class,'recipe_create']);
    Route::get('/tag_create',[RegistrantionController::class,'tag_create_form'])->name('tag_create');
    Route::post('/tag_create',[RegistrantionController::class,'tag_create']);
    Route::get('/recipe_edit/{recipe}',[RegistrantionController::class,'recipe_edit_form'])->name('recipe_edit');
    Route::post('/recipe_edit/{recipe}',[RegistrantionController::class,'recipe_edit']);
    Route::get('/recipe_delete/{recipe}',[RegistrantionController::class,'recipe_delete_form'])->name('recipe_delete');
    Route::post('/recipe_delete/{recipe}',[RegistrantionController::class,'recipe_delete']);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
