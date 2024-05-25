<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sample;

Route::get('/', [Sample::class, 'show']);

Route::get('/sample', [Sample::class, 'show']);