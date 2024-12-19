<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FaqController;


Route::get('/', [ChatController::class, 'index']);
Route::post('/submit-input', [ChatController::class, 'handleInput']);
Route::post('/chat-with-bot', [ChatController::class, 'chatWithBot']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/faq/form', [FaqController::class, 'showForm'])->name('faq.form');
Route::post('/faq/save', [FaqController::class, 'saveFaq'])->name('faq.save');
Route::get('/get-faqs', [ChatController::class, 'getFaqs']);
Route::get('/clear-session', function () {
    Session::forget('used_questions');
    return 'Session cleared!';
});
Route::get('/get-all-faqs', [FaqController::class, 'getAllFaqs']);
