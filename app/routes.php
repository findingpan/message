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
	Route::get('upload',function(){
		//微信多媒体获取ID
		// $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxe3b7e54fe14e212f&secret=0e0d0b26aaf41618e6841b0105b1b58c';
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// $output = curl_exec($ch);
		// curl_close($ch);
		// $jsoninfo = json_decode($output, true);
		// $access_token = $jsoninfo["access_token"];
		// echo $access_token;
		$url = 'http://loveunicki.sinaapp.com/index2.php';
		$data = array (
			    "action" => "select",
			    "tb" => "test",
			    "fields" => "*",
			    "arr" => array('name'=>'gggggggggg','text'=>'ghjhjjjjjjjjj'),
			    "terms" => ""
			);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //获取数据返回
		curl_setopt($ch, CURLOPT_POST, 1); //设置为POST传输
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); //post数据
		//select 解析json
		$output = json_decode(curl_exec($ch),true);
		// $output = curl_exec($ch);
		if($output === false){  //判断错误
		 echo curl_error($ch);
		}
		$info = curl_getinfo($ch);  //能够在cURL执行后获取这一请求的有关信息
		curl_close($ch);
		//select
		foreach ($output as $a) {
			echo $a['name'].'<br/>';
		};
		// echo $output;

	});
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

	if (Auth::check()) {
		#短信界面
	Route::get('surplus','MessageController@showSurplus');

	Route::get('list','MessageController@contentList');

	Route::post('messageToMany','MessageController@messageTo');

	# 问题列表
	Route::get( 'info', array('as' => 'info' ,'uses' => 'InfoResource@index'));
	#添加问题
	Route::post('addproblem', array('as' => 'addproblem' ,'uses' =>'InfoController@addproblem'));
	#添加反馈页面
	Route::get('editsolve/{id}', array('as' => 'editsolve' ,'uses' =>'InfoController@editsolve'));
	#添加反馈
	Route::post('addsolve', array('as' => 'addsolve' ,'uses' =>'InfoController@addsolve'));
	#更新问题状态
	Route::get('updatestate/{id}/{state}', array('as' => 'updatestate' ,'uses' =>'InfoController@updatestate'));
	} else {
		Redirect::route('getsignin');
	}
	
	