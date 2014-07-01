@extends('index')
@section('title')
@parent
短信
@stop

@section('d')
	      <li class="active">{{HTML::link('message','短信发送')}}</li>
@stop

@section('body')
	<div style="margin:20px 0;">
		{{ Form::button('获取联系人',['class'=>'easyui-linkbutton','onclick'=>'getSelections()']) }}
		{{ Form::button('添加联系人',['class'=>'easyui-linkbutton','onclick'=>'addSelections()']) }}
		{{ Form::button('查询余额',['class'=>'easyui-linkbutton','onclick'=>'showSurplus()']) }}
		{{ Form::open(array('url' => 'messageToMany','id'=>'form1')) }}
  		{{ Form::token() }}
  		<table width="500" height="150">
  		<tr>
    	<td width="100">{{ Form::label('content','联系人') }}</td>
   		<td width="400">{{ Form::textarea('content','',['class'=>'input-block-level',"cols"=>"50","rows"=>"4"]) }}</td>
  		</tr>
  		<tr>
    	<td>{{ Form::label('text','内容') }}</td>
    	<td>{{ Form::textarea('text','',['class'=>'input-block-level',"cols"=>"50","rows"=>"4"]) }}</td>
  		</tr>
		</table>		
  		{{ Form::submit('确认发送',['class'=>'easyui-linkbutton','onclick'=>'submitForm()']) }}
  		{{ Form::submit('清空',['class'=>'easyui-linkbutton','onclick'=>'clearForm()']) }}
  		{{ Form::close() }}
	</div>
	<table id="dg" class="easyui-datagrid" title="DataGrid Selection" style="width:640px;height:300px"
			data-options="singleSelect:false,pagination:true,pageSize:10,pageNumber:1,url:'list',method:'get'">
		<thead>
			<tr>
				<th data-options="field:'ck',checkbox:true"></th>
				<th data-options="field:'id',width:100">ID</th>
				<th data-options="field:'name',width:100">姓名</th>
				<th data-options="field:'number',width:100,align:'right'">电话号码</th>
				<th data-options="field:'kind',width:100,align:'right'">移/联/电</th>
				<th data-options="field:'info1',width:100">信息1</th>
				<th data-options="field:'info2',width:100,align:'center'">信息2</th>
			</tr>
		</thead>
	</table>
	<!-- 提交表单，返回结果 -->
	<script type="text/javascript">
		var con = '';
		function clearForm(){
			$('#form1').form('clear');
		}
		function addSelections(){
			$('#form1').form('load',{
				content:con
			});
		}
		function submitForm(){
				$('#form1').form('submit', {  
					success:function(data){ 
						con = '';
						$('#form1').form('load',{
							content:'',
							text:''
						});
						$.messager.show({
							title:'查询余额',
							msg:data,
							timeout:5000,
							showType:'slide'
						});	

					} 
				}); 
				
		}
		/**
		   * 
		   *获取多选数据
	   **/
		function getSelections(){
			var ss = [];
			var rows = $('#dg').datagrid('getSelections');
			for(var i=0; i<rows.length; i++){
				var row = rows[i];
				ss.push('<span>'+row.id+":"+row.name+":"+row.number+'</span>');
				con += row.number+';';
			}
			$.messager.show({
				title:'消息',
				msg:'联系人已获取',
				showType:'show',
				style:{
					left:'',
					right:0,
					top:document.body.scrollTop+document.documentElement.scrollTop,
					bottom:''
				}
			});


		};
		function showSurplus(){
			$.ajax({
			        url: "surplus",  
			        success: function(data){
							$.messager.show({
								title:'查询余额',
								msg:data,
								timeout:5000,
								showType:'slide'
							});		            
			        }
			    });



			
		}
	</script>	 
@stop

