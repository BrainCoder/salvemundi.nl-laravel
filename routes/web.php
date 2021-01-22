<?php

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

use App\Http\Controllers\HomeController;

use App\Http\Resources\User as UserResource;
use App\Models\User;

//Auth::routes();

// Main page.

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('home');

// Microsoft Authentication

Route::get('/signin', [App\Http\Controllers\AuthController::class, 'signin']);
Route::get('/callback', [App\Http\Controllers\AuthController::class, 'callback']);
Route::get('/signout', [App\Http\Controllers\AuthController::class, 'signout']);

// Commission page.

Route::get('/commissies', [App\Http\Controllers\GetUsersController::class, 'run']);

// Signup for Introduction

Route::get('/intro', [App\Http\Controllers\IntroController::class, 'index'])->name('intro');
Route::post('/intro/store', [App\Http\Controllers\IntroController::class, 'store']);

// Signup for SalveMundi page

Route::get('/inschrijven', [App\Http\Controllers\InschrijfController::class, 'index'])->name('inschrijven');
Route::post('/inschrijven/store', [App\Http\Controllers\InschrijfController::class, 'signupprocess'])->name('signupprocess');

// Mollie

Route::post('webhooks/mollie', [App\Http\Controllers\MollieWebhookController::class, 'handle'])->name('webhooks.mollie');

// MyAccount page

Route::get('/mijnAccount', [App\Http\Controllers\myAccountController::class, 'index'])->middleware('azure.auth');
Route::post('/mijnAccount/store',[App\Http\Controllers\myAccountController::class, 'savePreferences'])->middleware('azure.auth');
Route::post('/mijnAccount/pay', [App\Http\Controllers\MolliePaymentController::class,'handleContributionPaymentFirstTime'])->middleware('azure.auth');;

// Activiteiten page

Route::get('/activiteiten',[App\Http\Controllers\ActivitiesController::class, 'run'] );

// News page

Route::get('/nieuws',[App\Http\Controllers\NewsController::class, 'index'] );

// Admin Panel

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->middleware('admin.auth');
Route::get('/admin/leden', [App\Http\Controllers\AdminController::class, 'getUsers'])->middleware('admin.auth');
Route::get('/admin/intro', [App\Http\Controllers\AdminController::class, 'getIntro'])->middleware('admin.auth');
Route::get('/admin/sponsors', [App\Http\Controllers\AdminController::class, 'getSponsors'])->middleware('admin.auth')->name('admin.sponsors');
Route::post('/admin/sponsors/delete', [App\Http\Controllers\SponsorController::class, 'deleteSponsor'])->middleware('admin.auth');
Route::get('/admin/sponsors/add', function() {return view('admin/sponsorsAdd');})->middleware('admin.auth');
Route::post('/admin/sponsors/add/store', [App\Http\Controllers\SponsorController::class, 'addSponsor'])->middleware('admin.auth');
Route::get('/admin/activiteiten', [App\Http\Controllers\ActivitiesController::class, 'index'])->name('Activities')->middleware('admin.auth');
Route::post('/admin/activities/store', [App\Http\Controllers\ActivitiesController::class, 'store'])->middleware('admin.auth');
Route::post('/admin/activities/delete', [App\Http\Controllers\ActivitiesController::class, 'deleteActivity'])->middleware('admin.auth');
Route::get('/admin/nieuws', [App\Http\Controllers\NewsController::class, 'indexAdmin'])->name('News')->middleware('admin.auth');
Route::post('/admin/news/store', [App\Http\Controllers\NewsController::class, 'store'])->middleware('admin.auth');
Route::post('/admin/news/delete', [App\Http\Controllers\NewsController::class, 'deleteNews'])->middleware('admin.auth');
Route::get('/admin/nieuws', [App\Http\Controllers\NewsController::class, 'indexAdmin'])->name('News')->middleware('admin.auth');
Route::post('/admin/whatsappLinks/store', [App\Http\Controllers\AdminController::class, 'addWhatsappLinks'])->name('WhatsappLinks')->middleware('admin.auth');
Route::post('/admin/whatsappLinks/delete', [App\Http\Controllers\AdminController::class, 'deleteWhatsappLinks'])->middleware('admin.auth');
Route::post('/admin/intro/store', [App\Http\Controllers\AdminController::class, 'storeIntro'])->middleware('admin.auth');
