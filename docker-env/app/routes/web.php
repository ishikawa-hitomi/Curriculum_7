<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrantionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\StepController;

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
Route::prefix('password_reset')->name('password_reset.')->group(function(){
    Route::prefix('email')->name('email.')->group(function(){
        Route::get('/',[PasswordController::class,'emailFormResetPassword'])->name('form');
        Route::post('/',[PasswordController::class,'sendEmailResetPassword'])->name('send');
        Route::get('/send_complete',[PasswordController::class,'sendComplete'])->name('send_complete');
    });
    Route::get('/edit',[PasswordController::class,'edit'])->name('edit');
    Route::post('/update',[PasswordController::class,'update'])->name('update');
    Route::get('/edited',[PasswordController::class,'edited'])->name('edited');
});

Auth::routes();
Route::middleware(['auth'])->group(function(){

    Route::resource('user',UserController::class)->only(['show','edit','update','destroy']);
    Route::get('user/{user}/delete', [UserController::class,'delete_show'])->name('user.delete_show');
    Route::get('user/{user}/profile', [UserController::class,'profile_edit'])->name('user.profile_edit');
    Route::post('user/{user}/profile', [UserController::class,'profile_update'])->name('user.profile_update');
    Route::get('user/{user}/pass', [UserController::class,'pass_edit'])->name('user.pass_edit');
    Route::post('user/{user}/pass', [UserController::class,'pass_update'])->name('user.pass_update');

    Route::resource('recipe',RecipeController::class);
    Route::get('recipe/{recipe}/delete', [RecipeController::class,'delete_show'])->name('recipe.delete_show');

    Route::resource('ingredient',IngredientController::class)->only(['create','store','edit','update'])->parameters(['ingredient' => 'recipe']);

    Route::resource('step',StepController::class)->only(['create','store','edit','update'])->parameters(['step' => 'recipe']);

    Route::get('/add_like/{recipe}',[DisplayController::class,'add_like'])->name('add_like');
    Route::get('/remove_like/{recipe}',[DisplayController::class,'remove_like'])->name('remove_like');

    Route::get('/add_follow/{user}',[DisplayController::class,'add_follow'])->name('add_follow');
    Route::get('/remove_follow/{user}',[DisplayController::class,'remove_follow'])->name('remove_follow');

    Route::get('/follow_view/{user}',[DisplayController::class,'follow_view'])->name('follow_view');
    Route::get('/follower_view/{user}',[DisplayController::class,'follower_view'])->name('follower_view');

    Route::get('/tag_create',[RegistrantionController::class,'tag_create_form'])->name('tag_create');
    Route::post('/tag_create',[RegistrantionController::class,'tag_create']);

    Route::get('/comment_create/{recipe}',[RegistrantionController::class,'comment_create_form'])->name('comment_create');
    Route::post('/comment_create/{recipe}',[RegistrantionController::class,'comment_create']);

    Route::middleware(['can:admin'])->prefix('admin')->name('admin.')->group(function(){
        Route::get('/user_index',[AdminController::class,'user_index'])->name('user_index');
        Route::get('/del_user_index',[AdminController::class,'del_user_index'])->name('del_user_index');
        Route::get('/recipe_index',[AdminController::class,'recipe_index'])->name('recipe_index');
        Route::get('/del_recipe_index',[AdminController::class,'del_recipe_index'])->name('del_recipe_index');
        Route::post('/user_delete/{user}',[AdminController::class,'user_delete'])->name('user_delete');
    });
});