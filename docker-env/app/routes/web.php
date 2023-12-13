<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrantionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\Auth\LoginController;

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

    Route::resource('user',UserController::class)->only(['show', 'edit','update','destroy']);
    Route::get('user/{user}/delete', [UserController::class,'delete_show'])->name('user.delete_show');
    Route::get('user/{user}/profile', [UserController::class,'profile_edit'])->name('user.profile_edit');
    Route::post('user/{user}/profile', [UserController::class,'profile_update'])->name('user.profile_update');

    Route::resource('recipe',RecipeController::class);
    Route::get('recipe/{recipe}/delete', [RecipeController::class,'delete_show'])->name('recipe.delete_show');

    Route::get('/add_like/{recipe}',[DisplayController::class,'add_like'])->name('add_like');
    Route::get('/remove_like/{recipe}',[DisplayController::class,'remove_like'])->name('remove_like');

    Route::get('/add_follow/{user}',[DisplayController::class,'add_follow'])->name('add_follow');
    Route::get('/remove_follow/{user}',[DisplayController::class,'remove_follow'])->name('remove_follow');

    Route::get('/follow_view/{user}',[DisplayController::class,'follow_view'])->name('follow_view');
    Route::get('/follower_view/{user}',[DisplayController::class,'follower_view'])->name('follower_view');

    Route::get('/tag_create',[RegistrantionController::class,'tag_create_form'])->name('tag_create');
    Route::post('/tag_create',[RegistrantionController::class,'tag_create']);

    Route::get('/ingredient_create/{recipe}',[RegistrantionController::class,'ingredient_create_form'])->name('ingredient_create');
    Route::post('/ingredient_create/{recipe}',[RegistrantionController::class,'ingredient_create']);

    Route::get('/step_create/{recipe}',[RegistrantionController::class,'step_create_form'])->name('step_create');
    Route::post('/step_create/{recipe}',[RegistrantionController::class,'step_create']);

    Route::get('/ingredient_edit/{recipe}',[RegistrantionController::class,'ingredient_edit_form'])->name('ingredient_edit');
    Route::post('/ingredient_edit/{recipe}',[RegistrantionController::class,'ingredient_edit']);

    Route::get('/step_edit/{recipe}',[RegistrantionController::class,'step_edit_form'])->name('step_edit');
    Route::post('/step_edit/{recipe}',[RegistrantionController::class,'step_edit']);

    Route::get('/comment_create/{recipe}',[RegistrantionController::class,'comment_create_form'])->name('comment_create');
    Route::post('/comment_create/{recipe}',[RegistrantionController::class,'comment_create']);
});