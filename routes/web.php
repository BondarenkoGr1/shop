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

Route::group([
    'middleware' => 'admin'
],function (){

});

Route::post('checkout','cartController@checkout');

Route::get('/', 'HomeController@index');

Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');


Route::group(['middleware' => 'auth'],function (){
    Route::get('/logout','AuthController@logout');
    Route::get('/profile','ProfileController@index');
    Route::post('/profile','ProfileController@store');
    Route::post('/comment','CommentsController@store');
    Route::get('/story','StoryController@index');
    Route::get('/cart','CartController@index');
    Route::get('/cart/addItem/{id}','CartController@addItem');
    Route::get('/cart/remove/{id}','CartController@destroy');
    Route::get('/cart/update/{id}','CartController@update');


});

Route::group(['middleware' => 'guest'],function (){
    Route::get('/register','AuthController@registerForm');
    Route::post('/register','AuthController@register');
    Route::get('/verify/{token}','SubsController@verify');
    Route::get('/login','AuthController@loginForm')->name('login');
    Route::post('/login','AuthController@login');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware' => 'admin'],function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/categories','CategoriesController');
    Route::resource('/product','ProductsController');
    Route::resource('/users','UsersController');
    Route::resource('/payments','PaymentsController');
    Route::resource('/orders','OrdersController');
    Route::get('/comments','CommentsController@index');
    Route::get('/comments/toggle/{id}','CommentsController@toggle');
    Route::delete('/comments/{id}/destroy','CommentsController@destroy')->name('comments.destroy');

});