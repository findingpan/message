<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>
            @section('title')
            @show{{-- 页面标题 --}}
</title>
{{HTML::script('js/jquery-1.8.0.min.js')}}

    @section('style')
    @show{{-- 累加的页面内联样式 --}}

</head>
<body>
    @yield('body')
</body>
</html>