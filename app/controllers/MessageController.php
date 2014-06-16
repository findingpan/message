<?php

class MessageController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	/**
	   * 返回Grid的List
	   *
	   * @return $json
	   * @author pan
	   **/
	  public function contentList()
	  {
	  	$page = $_GET['page'];

		$rows = $_GET['rows'];

		$start = (intval($page)-1)*intval($rows);

	  	$users =  DB::table('persons')->skip($start)->take($rows)->get();

	  	$count =  Person::get()->count();


	  	$jsons = "{\"total\":".$count.",\"rows\":[ ";

	  	foreach ($users as $user)
		{
		    $jsons .= "{\"id\":\"".$user->id."\",\"name\":\"".$user->name."\",\"number\":\"".$user->number."\",\"kind\":\"".$user->kind."\",\"info1\":\"测试信息111\",\"info2\":\"".$user->info2."\"},";
		}

		 $jsons = substr($jsons, 0, -1);  

		 $jsons .= "]}";

	  	return $jsons;
	  }

	/**
   * 查询余额
   *
   * @return xml
   * @author pan
   **/

	public function showSurplus()
  	{	
	$data="<?xml version='1.0' encoding='utf-8'?>
			<Body>
			<user>272001</user>
			<password>272002</password>
			<version>1.2</version>
			</Body>";


	$url = "http://211.137.171.46:9191/adc_posthandler_new";
	$ch = curl_init();
	$header[] = "POST /url HTTP/1.1";
	$header[] = "Host: 211.137.171.46";
	$header[] = "Content-Type: text/xml; charset=utf-8";
	$header[] = "Action: \"checkbalances\"";
	curl_setopt($ch, CURLOPT_URL, $url); //定义表单提交地址
	curl_setopt($ch, CURLOPT_POST, 1);   //定义提交类型 1：POST ；0：GET
	curl_setopt($ch, CURLOPT_HEADER, 0); //定义是否显示状态头 1：显示 ； 0：不显示
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//定义请求类型
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//定义是否直接输出返回流
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //定义提交的数据，这里是XML文件
	$output= curl_exec($ch);
	curl_close($ch);//关闭
	return '当前余额为:'.$output;
  }

/**
   * 下发短信
   *
   * @return xml
   * @author pan
   **/
  public function messageTo()
  {
	
  	$text = Input::get('text')."【新世纪儿童医院】";

  	$text = base64_encode($text);
	
	$content = substr(Input::get('content'), 0, -1); 

	$var=explode(';', $content);

	$real_content = '';

	$data="<?xml version='1.0' encoding='utf-8'?>
			<Body>
			<user>272001</user>
			<password>272002</password>
			<version>1.2</version>";


	foreach ($var as $vars) {
		$data .= "<submit>
			<usermsgid>".$vars."x</usermsgid>
			<desttermid>".$vars."</desttermid>
			<srctermid></srctermid>
			<msgcontent>".$text."</msgcontent>
			<signid></signid>";
			if (preg_match('/^1(3[4-9]|5[012789]|8[78])\d{8}$/',$vars)) {
				$data .="<desttype>1</desttype>";
			} elseif(preg_match('/^1(3[0-2]|5[56]|8[56])\d{8}$/',$vars)){
				$data .="<desttype>2</desttype>";
			} elseif (preg_match('/^18[09]\d{8}$/',$vars)) {
				$data .="<desttype>3</desttype>";
			}
			
			$data .="<needreply>1</needreply>
		</submit>";
	}

	$data .= "</Body>";

	$url = "http://211.137.171.46:9191/adc_posthandler_new";
	$ch = curl_init();
	$header[] = "POST /url HTTP/1.1";
	$header[] = "Host: 211.137.171.46";
	$header[] = "Content-Type: text/xml; charset=utf-8";
	$header[] = "Action: \"submitreq\"";
	curl_setopt($ch, CURLOPT_URL, $url); //定义表单提交地址
	curl_setopt($ch, CURLOPT_POST, 1);   //定义提交类型 1：POST ；0：GET
	curl_setopt($ch, CURLOPT_HEADER, 0); //定义是否显示状态头 1：显示 ； 0：不显示
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//定义请求类型
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//定义是否直接输出返回流
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //定义提交的数据，这里是XML文件

	$output= curl_exec($ch);
	curl_close($ch);//关闭
	return $output;
  }
  /**
   * 群发短信
   *
   * @return xml
   * @author pan
   **/
  public function messageToMany()
  {
	
  	$text = Input::get('text');

  	$text = base64_encode(iconv('GB18030','UTF-8',$text));
	
	$content = substr(Input::get('content'), 0, -1); 

	$var=explode(';', $content);

	$real_content = '';

	foreach ($var as $vars) {
		$real_content .= $vars.'x:'.$vars.',';
	}


	$real_content = substr($real_content, 0, -1); 

	$reg='/^0{0,1}(13[4-9]|147|15[0-2]|15[7-9]|182|18[7-8])[0-9]{8}$/'; //判断手机号码是否为移动号码段
    $reglt='/^0{0,1}(13[0-2]|15[5-6]|18[5-6])[0-9]{8}$/';  //判断手机号码是否为联通号码段
    $regdx='/^0{0,1}(133|153|180|189)[0-9]{8}$/'; //判断手机号码是否为电信号码段

	$data="<?xml version='1.0' encoding='utf-8'?>
			<Body>
			<user>272001</user>
			<password>272002</password>
			<version>1.2</version>
			<desttermid>".$real_content."</desttermid>
			<srctermid></srctermid>
			<msgcontent>".$text."</msgcontent>
			<signid>0</signid>
			<desttype>1</desttype>
			<needreply>1</needreply>
			</Body>";


	$url = "http://211.137.171.46:9191/adc_posthandler_new";
	$ch = curl_init();
	$header[] = "POST /url HTTP/1.1";
	$header[] = "Host: 211.137.171.46";
	$header[] = "Content-Type: text/xml; charset=utf-8";
	$header[] = "Action: \"batchsubmit\"";
	curl_setopt($ch, CURLOPT_URL, $url); //定义表单提交地址
	curl_setopt($ch, CURLOPT_POST, 1);   //定义提交类型 1：POST ；0：GET
	curl_setopt($ch, CURLOPT_HEADER, 0); //定义是否显示状态头 1：显示 ； 0：不显示
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//定义请求类型
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//定义是否直接输出返回流
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //定义提交的数据，这里是XML文件
	$output= curl_exec($ch);
	curl_close($ch);//关闭
	return $output;
  }


}