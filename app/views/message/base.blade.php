<html>
<title>
  @section('title')
  @show{{-- 页面标题 --}}  
</title>
	<head>
    	<meta charset="UTF-8">
        {{HTML::style('js/easyui/themes/default/easyui.css')}}
        {{HTML::style('js/easyui/themes/icon.css')}}
        {{HTML::script('js/easyui/jquery.min.js')}}
        {{HTML::script('js/easyui/jquery.easyui.min.js')}}
	</head>
    <body>
        @section('user')
        @show{{-- 页面标题 --}}
    	
       	@yield('grid')


    </body>
</html>