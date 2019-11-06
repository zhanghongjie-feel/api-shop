

@extends('layouts.admin')

@section('title', '班级列表')
@section('content')
		<center><h1>班级展示</h1><br></center>

	<div style="margin-top: 5%">
		<table class='table table-bordered table-hover table-striped'>
			<tr class="success">
				<td>班级id</td>
				<td>班级名称</td>
				<td class="info">班级学生数量</td>
			</tr>

			@foreach($classData as $k => $v)
			<tr>
				<td>{{$v['class_id']}}</td>
				@if($v['class_name']=='A')
				<td>骚气的A班</td>
				@else
				<td>羞羞的B班</td>
				@endif
				<td>{{$v['student_count']}}</td>
			</tr>
			@endforeach

			
		</table>
	</div>
	
@endsection