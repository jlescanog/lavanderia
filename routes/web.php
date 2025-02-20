<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/app');
});

Route::get('home', function () {
    return view('pages.app');
});
