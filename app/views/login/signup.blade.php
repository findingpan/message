@extends('login.base')
@section('title') 用户注册 @parent @stop
@section('style')
    @parent
{{HTML::style('css/register.css')}}
    @stop
@section('body')
<div class='signup_container'>


 	<h1 class='signup_title'>用户注册</h1>
    {{HTML::image('images/people.png')}}
    <div id="signup_forms" class="signup_forms clearfix">
            {{ Form::open(array('route'=>'sign','id'=>'user_signup')) }}
            {{ Form::token() }}
            <div class="form_row first_row">
                        {{Form::label('name','用户名') }}
                        {{Form::text('name','',array("placeholder"=>"请输入用户名","required"=>"required"))}}
             </div>
            <div class="form_row">
				{{Form::password('password',array("placeholder"=>"请输入密码","required"=>"required"))}}
        	</div>
        	<div class="form_row">{{Form::password('password_confirmation',array("placeholder"=>"确认密码","required"=>"required"))}}</div>
        {{ Form::submit('注册       ') }}
            {{ Form::close() }}
    </div>
     <div class="alert alert-warning alert-dismissable {{ $errors->first('name')?'':'hidden'; }}{{ $errors->first('password')?'':'hidden'; }}">
            <font color="red"><strong>
            {{ $errors->first('name', '<strong class="error">:message</strong>') }}
            {{ $errors->first('password', '<strong class="error">:message</strong>') }}
        </strong></font>
      </div>
      <div class="alert alert-warning alert-dismissable {{ $errors->first('attempt')?'':'hidden'; }}">
            <font color="red"><strong>{{ $errors->first('attempt') }}</strong></font>
        </div>
         {{ link_to_route('getsignin', '返回登录页面')}}
    
    <strong><p class='copyright'>天津新世纪儿童医院</p></strong>
</div>
@stop


