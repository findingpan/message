<!DOCTYPE html>
<html lang="">
	<head>
		<title>
			@section('title')
			@show
		</title>
		<meta charset="UTF-8">
		<meta name=description content="">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		{{HTML::style("css/bootstrap.css")}}
	    <!-- Bootstrap JS -->
	    {{HTML::script("js/jquery-1.8.0.min.js")}}
	    {{HTML::script("js/bootstrap.js")}}
		{{HTML::style('js/easyui/themes/default/easyui.css')}}
        {{HTML::style('js/easyui/themes/icon.css')}}
        {{HTML::script('js/easyui/jquery.easyui.min.js')}}
	   
	</head>
	<body>
	<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
 		@section('nav')
		    <ul class="nav nav-pills nav-justified">
		      @section('d')
		      <li>{{HTML::link('message','短信发送')}}</li>
		      @show
		      @section('w')
		      <li>{{HTML::link('info','问题列表')}}</li>
		      @show
		      <li>{{HTML::link('/','首页')}}</li>
		    </ul>
		    <div class="alert alert-success" align='right'>
		    	你好!{{Auth::user()->name}},{{HTML::linkRoute('logout', '登出',['class'=>'alert alert-success'])}}
		    </div>
		    <hr>
	    @show
			<div class="row-fluid">
				<div class="span2">
				</div>
					@if(Auth::check())
						<div class="span6">

							@section('body')
							@show
						</div>
					@else
						{{Redirect::home()}}
					@endif 
				<div class="span4">
				</div>
			</div>
		</div>
	</div>
</div>
	</body>
</html>