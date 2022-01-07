<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarpenterController;
use App\Http\Controllers\LineMessengerController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', [MessageController::class,"index"])->middleware(['auth']);

Route::get('/messages/new', [MessageController::class,"new"])->middleware(['auth'])->middleware(['auth']);

Route::post('/messages/create', [MessageController::class,"create"])->name('message.create');

Route::post('/messages/importcsv', [MessageController::class,"importcsv"])->name('message.importCSV')->middleware(['auth']);

Route::get('/messages/{message}', [MessageController::class,"show"])->middleware(['auth']);

Route::patch('/messages/{message}/update', [MessageController::class,"update"])->name('message.update')->middleware(['auth']);

Route::delete('/messages/{message}/destroy', [MessageController::class,"destroy"])->name('message.destroy')->middleware(['auth']);

Route::get('/clients', [ClientController::class,"index"])->middleware(['auth']);

Route::get('/clients/new', [ClientController::class,"new"])->middleware(['auth']);

Route::get('/clients/{client}', [ClientController::class,"show"])->middleware(['auth']);

Route::post('/clients/create', [ClientController::class,"create"])->name('client.create')->middleware(['auth']);

Route::patch('/clients/{client}/update', [ClientController::class,"update"])->name('client.update')->middleware(['auth']);

Route::delete('/clients/{client}/destroy', [ClientController::class,"destroy"])->name('client.destroy')->middleware(['auth']);

Route::get('/carpenters', [CarpenterController::class,"index"])->middleware(['auth']);

Route::get('/carpenters/new', [CarpenterController::class,"new"])->middleware(['auth']);

Route::get('/carpenters/{carpenter}', [CarpenterController::class,"show"])->middleware(['auth']);

Route::post('/carpenters/create', [CarpenterController::class,"create"])->name('carpenter.create')->middleware(['auth']);

Route::patch('/carpenters/{carpenter}/update', [CarpenterController::class,"update"])->name('carpenter.update')->middleware(['auth']);

Route::delete('/carpenters/{carpenter}/destroy', [CarpenterController::class,"destroy"])->name('carpenter.destroy')->middleware(['auth']);

Route::get('/templates', [TemplateController::class,"index"])->middleware(['auth']);

Route::get('/templates/new', [TemplateController::class,"new"])->middleware(['auth']);

Route::post('/templates/create', [TemplateController::class,"create"])->name('template.create')->middleware(['auth']);

Route::get('/templates/{template}', [TemplateController::class,"show"])->middleware(['auth']);

Route::patch('/templates/{template}/update', [TemplateController::class,"update"])->name('template.update')->middleware(['auth']);

Route::delete('/templates/{template}/destroy', [TemplateController::class,"destroy"])->name('template.destroy')->middleware(['auth']);

Route::post('/line/webhook', [LineMessengerController::class,"webhook"])->name('line.webhook');

Route::get('/line/message', [LineMessengerController::class,"message"]);

require __DIR__.'/auth.php';
