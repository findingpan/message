@extends('index')

@section('body')
<ol class="breadcrumb">
  <li>{{HTML::linkRoute('info','问题登记')}}</li>
  <li class="active">添加反馈</li>
</ol>
	<div class="bs-example">
		<p>
			<strong><font color='navy'>问题描述：</font></strong>
		</p><small>{{$info}}</small>
	</div>
	{{ Form::open(array('url' => 'addsolve', 'method' => 'post')) }}
	{{ Form::token()}}
	{{ Form::hidden('id', $id)}}
	<p>
		{{ Form::label('solve','反馈')}}	
		{{ Form::textarea('solve','',array("placeholder"=>"请添加反馈","required"=>"required"))}}
	</p>
	{{ Form::submit('确定', ['class'=>"btn btn-primary"])}}	
	{{ Form::close() }}
@stop