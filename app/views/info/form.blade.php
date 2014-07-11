@section('dialog')
@parent
<!-- 添加问题窗口 -->
	<div class="modal fade" id="addproblemform" tabindex="-1" role="dialog" aria-labelledby="addproblemtitle" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="addproblemtitle">添加问题</h4>
	      </div>
		      <div class="modal-body">       
				{{ Form::open(array('route' => 'addproblem', 'method' => 'post')) }}
				{{ Form::token()}}
				{{ Form::label('problem','问题')}}
				{{ Form::textarea('problem','',array("placeholder"=>"请描述问题","required"=>"required"))}}
		      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">提交问题</button>
	      </div>
	      {{ Form::close() }}
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop

