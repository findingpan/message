<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

	# 登录
	Route::get( '/', array('as' => 'getsignin' , 'uses' => 'AuthorityController@getSignin'));
	Route::post( '/', array('as' => 'postsignin' ,'uses' =>'AuthorityController@postSignin'));
	#注册页面
	Route::get( 'signup', array('as' => 'getsign' , 'uses' => 'AuthorityController@getSignup'));
	#注册
	Route::post( 'sign', array('as' => 'sign' , 'uses' => 'AuthorityController@postSignup'));
	#登出
	Route::get( 'logout', array('as' => 'logout' , 'uses' => 'AuthorityController@getLogout'));

	#短信界面
	Route::get('surplus','MessageController@showSurplus');

	Route::get('list','MessageController@contentList');

	Route::post('messageToMany','MessageController@messageTo');