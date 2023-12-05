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
    Route::get('/my_page/{user}', [DisplayController::class,'my_page'])->name('my_page');
    Route::get('/others_page/{user}', [DisplayController::class,'others_page'])->name('others_page');

    Route::get('/recipe/{recipe}/my_post', [DisplayController::class,'my_post'])->name('my_post');
    Route::get('/recipe/{recipe}/others_post', [DisplayController::class,'others_post'])->name('others_post');

    Route::get('/recipe_create',[RegistrantionController::class,'recipe_create_form'])->name('recipe_create');
    Route::post('/recipe_create',[RegistrantionController::class,'recipe_create']);

    Route::get('/tag_create',[RegistrantionController::class,'tag_create_form'])->name('tag_create');
    Route::post('/tag_create',[RegistrantionController::class,'tag_create']);

    Route::get('/recipe_edit/{recipe}',[RegistrantionController::class,'recipe_edit_form'])->name('recipe_edit');
    Route::post('/recipe_edit/{recipe}',[RegistrantionController::class,'recipe_edit']);

    Route::get('/recipe_delete/{recipe}',[RegistrantionController::class,'recipe_delete_form'])->name('recipe_delete');
    Route::post('/recipe_delete/{recipe}',[RegistrantionController::class,'recipe_delete']);

    Route::get('/profile_edit/{user}',[RegistrantionController::class,'profile_edit_form'])->name('profile_edit');
    Route::post('/profile_edit/{user}',[RegistrantionController::class,'profile_edit']);

    Route::get('/user_edit/{user}',[RegistrantionController::class,'user_edit_form'])->name('user_edit');
    Route::post('/user_edit/{user}',[RegistrantionController::class,'user_edit']);

    Route::get('/user_delete/{user}',[RegistrantionController::class,'user_delete_form'])->name('user_delete');
    Route::post('/user_delete/{user}',[RegistrantionController::class,'user_delete']);

    Route::get('/ingredient_create/{recipe}',[RegistrantionController::class,'ingredient_create_form'])->name('ingredient_create');
    Route::post('/ingredient_create/{recipe}',[RegistrantionController::class,'ingredient_create']);

    Route::get('/step_create/{recipe}',[RegistrantionController::class,'step_create_form'])->name('step_create');
    Route::post('/step_create/{recipe}',[RegistrantionController::class,'step_create']);

    Route::get('/ingredient_edit/{recipe}',[RegistrantionController::class,'ingredient_edit_form'])->name('ingredient_edit');
    Route::post('/ingredient_edit/{recipe}',[RegistrantionController::class,'ingredient_edit']);

    Route::get('/step_edit/{recipe}',[RegistrantionController::class,'step_edit_form'])->name('step_edit');
    Route::post('/step_edit/{recipe}',[RegistrantionController::class,'step_edit']);
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
