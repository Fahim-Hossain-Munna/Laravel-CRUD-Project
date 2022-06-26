<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
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


Route::get("/", [FrontendController::class , "welcome"]);

Route::get("about", [FrontendController::class , "about"]);

Route::get("contact", [FrontendController::class , "contact"]);

Route::post("contact/insert", [FrontendController::class , "contactinsert"]);

Route::get("contact/delete/{id}", [FrontendController::class , "contactdelete"]);

Route::post("contact/edit/post/{id}", [FrontendController::class , "contacteditpost"]);

Route::get("contact/restore/{id}", [FrontendController::class , "contactrestore"]);

Route::get("contact/delete_all/{id}", [FrontendController::class , "contactdelete_all"]);
