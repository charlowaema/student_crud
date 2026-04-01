<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
<<<<<<< HEAD


Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
=======
>>>>>>> 4df599e9ccbbfb1db9bb0e33394e5c3460ce7a2c
