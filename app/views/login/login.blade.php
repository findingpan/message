@extends('login.base')
@section('title') 用户登录 @parent @stop
@section('style')
    @parent
{{HTML::style('css/register.css')}}
    @stop
@section('body')
<div class='signup_container'>
    <h1 class='signup_title'>用户登陆</h1>
    {{HTML::image('images/people.png')}}
    <div id="signup_forms" class="signup_forms clearfix">
            {{ Form::open(array('route'=>'postsignin','id'=>'user_login')) }}
            {{ Form::token() }}
            <div class="form_row first_row">
                        {{ Form::label('user','用户名') }}
                        {{Form::text('user','',array("placeholder"=>"请输入用户名","required"=>"required"))}}
                    </div>
                    <div class="form_row">
                        {{ Form::label('password','登录密码') }}
                        {{Form::password('password',array("placeholder"=>"请输入密码"))}}
                    </div>
           {{ Form::submit('登录       ') }}
            {{ Form::close() }}
    </div>
    {{ link_to_route('getsign', '点击注册')}}
     <div class="alert alert-warning alert-dismissable {{ $errors->first('attempt')?'':'hidden'; }}">
            <font color="red"><strong>{{ $errors->first('attempt') }}</strong></font>
        </div>
    
    <p class='copyright'>天津新世纪儿童医院</p>
</div>
@stop