<?php
use App\Post;
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

Route::get('/','PostController@listAllPosts');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

Route::get('/post/{slug}','PostController@getSpecificPost')->name('details');

Route::get('/post/author/{name}','PostController@getPostByAuthors')->name('authorPost');
Route::get('posts/','PostController@oldPost')->name('oldPost');

Route::group(['prefix' => 'account','middleware'=>'auth'], function() {
    Route::resource('/post', 'PostController')->except('show','index');
    Route::get('/','PostController@getPostByID')->name('manage');
    Route::get('/poll','PollsController@getIndex')->name('pollIndex');
    Route::resource('/photos','PhotosController')->except('edit','show','update');
});

Route::get('email',function(){
	return view('subscribe_form');
});

Route::get('subscribe','PostController@subscribe')->name('subscribe');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');


Route::resource('comment','CommentsController');

Route::group(['prefix' => 'polls'], function() {
    Route::get('/create','PollsController@create')->name('pollCreate');
    Route::post('/create','PollsController@store')->name('pollStore');
    Route::post('/vote/{id}','PollsController@vote')->name('pollVote');
    Route::get('/{id}','PollsController@getSpecificPoll')->name('viewPoll');
    Route::get('','PollsController@getIndex');
    Route::get('/lock/{id}','PollsController@lock')->name('lockPoll');
    Route::get('/unlock/{id}','PollsController@unlock')->name('unlockPoll');
    Route::delete('/delete/{id}','PollsController@delete')->name('deletePoll');
});