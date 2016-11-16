<?php

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

Route::get('/', ['as' => 'index', function () {
    $users = [
        [
            'name' => 'John',
            'email' => 'john@example.com',
        ],
        [
            'name' => 'Jenny',
            'email' => 'jenny@example.com',
        ],
    ];

    $contacts = [
        [
            'name' => 'Peter',
            'phone' => '826-898-0812',
        ],
        [
            'name' => 'Chris',
            'phone' => '996-575-3925',
        ],
    ];

    return view('index', compact('users', 'contacts'));
}]);
