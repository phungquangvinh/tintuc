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

Route::get('/', 'MyController@index')->name('/');

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('contact', ['as' => 'contact', 'uses' => 'MyController@contact']);

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'], function(){

	Route::get('/','MyController@admin');

	Route::group(['prefix'=>'/loai-tin'], function(){
	    Route::get('/add', [
			'as' => 'loai-tin/add',
			'uses' => 'LoaiTinController@getAdd'
		]);
	    Route::post('/add', 'LoaiTinController@postAdd');

	    Route::get('/edit/{id}', [
			'as' => 'loai-tin/edit',
			'uses' => 'LoaiTinController@getEdit'
		]);
		Route::post('/edit/{id}', 'LoaiTinController@postEdit');

		Route::get('/delete/{id}', 'LoaiTinController@getDelete');

		Route::get('/list', [
			'as' => 'loai-tin/list',
			'uses' => 'LoaiTinController@list'
		]);
	});

	Route::group(['prefix'=>'/slide'], function(){
	    Route::get('/add', [
			'as' => 'slide/add',
			'uses' => 'SlideController@getAdd'
		]);
		Route::post('/add', 'SlideController@postAdd');

	    Route::get('/edit/{id}', [
			'as' => 'slide/edit',
			'uses' => 'SlideController@getEdit'
		]);
		Route::post('/edit/{id}', 'SlideController@postEdit');
		
		Route::get('/list', [
			'as' => 'slide/list',
			'uses' => 'SlideController@list'
		]);

		Route::get('/delete/{id}', 'SlideController@getDelete');
	});

	Route::group(['prefix'=>'/the-loai'], function(){
	    Route::get('/add', [
			'as' => 'the-loai/add',
			'uses' => 'TheLoaiController@getAdd'
		]);
	    Route::post('/add', 'TheLoaiController@postAdd');

	    Route::get('/edit/{id}', [
			'as' => 'the-loai/edit',
			'uses' => 'TheLoaiController@getEdit'
		]);
		Route::post('/edit/{id}', 'TheLoaiController@postEdit');

		Route::get('/delete/{id}', 'TheLoaiController@getDelete');

		Route::get('/list', [
			'as' => 'the-loai/list',
			'uses' => 'TheLoaiController@list'
		]);
	});

	Route::group(['prefix'=>'/tin-tuc'], function(){
	    Route::get('/add', [
			'as' => 'tin-tuc/add',
			'uses' => 'TinTucController@getAdd'
		]);
	    Route::post('/add', 'TinTucController@postAdd');

	    Route::get('/edit/{id}', [
			'as' => 'tin-tuc/edit',
			'uses' => 'TinTucController@getEdit'
		]);
		Route::post('/edit/{id}', 'TinTucController@postEdit');

		Route::get('/delete/{id}', 'TinTucController@getDelete');

		Route::get('/list', [
			'as' => 'tin-tuc/list',
			'uses' => 'TinTucController@list'
		]);
	});

	Route::group(['prefix'=>'/comment'], function(){
		Route::get('/delete/{id}/{idTinTuc}', 'CommentController@getDelete');
	});

	Route::group(['prefix'=>'/user'], function(){
	    Route::get('/edit/{id}', [
			'as' => 'user/edit',
			'uses' => 'UserController@getEdit'
		]);
		Route::post('/edit/{id}', 'UserController@postEdit');

		Route::get('/delete/{id}', 'UserController@getDelete');

		Route::get('/list', [
			'as' => 'user/list',
			'uses' => 'UserController@list'
		]);
	});

	Route::group(['prefix' => 'ajax'], function()
	{
		Route::get('loai-tin/{idTheLoai}', 'AjaxController@getLoaiTin');
	});
});

Route::get('dangki', ['as' => 'dangki', 'uses' => 'RegisterController@getRegister']);
Route::post('dangki', ['as' => 'dangki', 'uses' => 'RegisterController@postRegister']);

Route::get('dangnhap', [ 'as' => 'dangnhap', 'uses' => 'LoginController@getLogin']);
Route::post('dangnhap', [ 'as' => 'dangnhap', 'uses' => 'LoginController@postLogin']);

Route::get('logout', [ 'as' => 'logout', 'uses' => 'Auth\LogoutController@getLogout']);

Route::get('forgot', [ 'as' => 'forgot', 'uses' => 'Auth\ForgotPasswordController@getForgotPassword']);
Route::post('forgot', [ 'as' => 'forgot', 'uses' => 'Auth\ForgotPasswordController@postForgotPassword']);

Route::get('category/{id}/{TenKhongDau}.html', 'MyController@category')->name('category');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html', 'MyController@tintuc')->name('tintuc');

Route::post('comment/{id}', 'CommentController@postComment');

Route::get('search', 'MyController@search');

Route::get('user', 'UserController@getUser')->name('user');
Route::post('user', 'UserController@postUser')->name('user');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
