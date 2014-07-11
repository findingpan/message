@extends('index')

@section('title') 问题登记 @parent @stop

@section('w')
	      <li class="active">{{HTML::link('info','问题列表')}}</li>
@stop

@section('body')
<div class="alert alert-warning alert-dismissable {{ $errors->first('attempt')?'':'hidden'; }}">
            <font color="red"><strong>{{ $errors->first('attempt') }}</strong></font>
        </div>
<div align='right'> 
  <p> 	
  	<span class="label label-warning">未完成：<span class="badge">{{$now}}</span></span>
  	<span class="label label-success">累计完成：<span class="badge">{{$finish}}</span></span>
  </p>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addproblemform">添加问题</button>
  <button type="button" class="btn btn-info">Info</button>
  </div>
	<br>
	<div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width='20%' style="vertical-align:middle;">问题</th>
                    <th width='20%' style="vertical-align:middle;">反馈</th>
                    <th style="vertical-align:middle;">获取任务人</th>
                    <th width='13%' style="vertical-align:middle;">获取任务时间</th>
                    <th style="vertical-align:middle;">完成任务人</th>
                    <th width='13%' style="vertical-align:middle;">最后更新时间</th>
                    <th style="vertical-align:middle;">状态</th>
                    <th width='10%' style="width:15%;vertical-align:middle;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td style="vertical-align:middle;">{{ $data->problem }}</td>
                    <td style="vertical-align:middle;">{{ $data->solve }}</td>
                    <td style="vertical-align:middle;">{{ $data->getjobuser }}</td>
                    <td style="vertical-align:middle;">{{ $data->getjobtime }}</td>
                    <td style="vertical-align:middle;">{{ $data->finishjobuser }}</td>
                    <td style="vertical-align:middle;">{{ $data->updated_at }}</td>
                    @if ($data->state==2)
                    	<td style="vertical-align:middle;"><span class="label label-success">完成</span></td>
                    @elseif ($data->state==1)
                    	<td style="vertical-align:middle;"><span class="label label-primary">进行中</span></td>
                    @elseif ($data->state==0)
                    	<td style="vertical-align:middle;"><span class="label label-warning">提交</span></td>
                    @elseif ($data->state==3)
                    	<td style="vertical-align:middle;"><span class="label label-danger">关闭</span></td>
                    @endif                    
                    <td  style="vertical-align:middle;">
						<div class="btn-group" style="text-align:center;">
							<button type="button" class="btn btn-danger dropdown-toggle btn-xs" data-toggle="dropdown">
							操作 <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
							<li>{{HTML::linkRoute('updatestate','接受',['id'=>$data->id,'state'=>'1'])}}</li>
							<li>{{HTML::linkRoute('editsolve','编辑',['id'=>$data->id])}}</li>
							<li>{{HTML::linkRoute('updatestate','完成',['id'=>$data->id,'state'=>'2'])}}</li>
							<li class="divider"></li>
							<li>{{HTML::linkRoute('updatestate','拒绝',['id'=>$data->id,'state'=>'3'])}}</li>
							</ul>
						</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div align='right'>{{ $datas->links();}}</div>         
    </div>
    @include('info.form')
@stop