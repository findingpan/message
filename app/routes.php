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
	Route::get('message', function(){
		return View::make('message.users');
	});
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

	# 问题列表
	Route::get( 'info', array('uses' => 'InfoResource@index'));
	#添加问题
	Route::post('addproblem', array('as' => 'addproblem' ,'uses' =>'InfoController@addproblem'));
	#添加反馈
	Route::get('editsolve/{id}', array('as' => 'editsolve' ,'uses' =>'InfoController@editsolve'));
	#更新问题状态
	Route::get('updatestate/{id}/{state}', array('as' => 'updatestate' ,'uses' =>'InfoController@updatestate'));