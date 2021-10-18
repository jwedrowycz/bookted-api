<?php

use App\Http\Resources\UserResource;
use App\Models\User;
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

Route::get('/', function () {
    UserResource::collection(
        User::with('auctions', 'auctions.book', 'auctions.images', 'auctions.book.category', 'auctions.book.bookCondition')->latest()->paginate(50)
    );
    return view('welcome');
});
