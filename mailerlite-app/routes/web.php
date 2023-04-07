<?php

use App\Http\Controllers\checkSubscriberExists;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fetchSubscriberList;
use App\Http\Controllers\fetchKeyFromDatabase;
use App\Http\Controllers\fetchUpdateSubscribers;
use App\Http\Controllers\fetchDeleteSubscribers;
use App\Http\Controllers\fetchCreateSubscribers;


use App\Http\Controllers\homePage;

//homePage
Route::get('/', [homePage::class, 'validateAndSaveApiKey']);
Route::get('/subscribers', [homePage::class, 'showSubscribersPage']);

Route::get('/subscribersList', [fetchSubscriberList::class, 'showSubscribersList']);
Route::get('/createSubscriberModal', [fetchCreateSubscribers::class, 'createSubscriberModal']);

Route::post('/createSubscribers', [fetchCreateSubscribers::class, 'fetchCreateSubscriber']);

Route::get('/fetchKey', [fetchKeyFromDatabase::class, 'fetchKeyFromDatabase']);
Route::post('/fetchUpdateSubscribers', [fetchUpdateSubscribers::class, 'fetchUpdateSubscriber']);
Route::delete('/fetchDeleteSubscribers', [fetchDeleteSubscribers::class, 'fetchDeleteSubscriber']);
