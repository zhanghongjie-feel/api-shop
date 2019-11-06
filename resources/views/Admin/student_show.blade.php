@extends('layouts.admin')

@section('title', '班级+学生信息列表')

@section('content')
	<center><h1>班级+学生信息展示</h1></center>
	<table class='table table-bordered table-hover table-striped'>
		<tr>
			<td>班级id</td>
			<td>班级名称</td>
			<td>学生信息</td>
		</tr>

		@foreach($classData as $k=> $v)
			<tr>
				<td>{{$v['class_id']}}</td>
				<td>{{$v['class_name']}}</td>
				<td>
					<table class='table table-bordered table-hover table-striped'>
					<tr>
						<td>学生id</td>
						<td>学生名</td>
						<td>年龄</td>

						@foreach($classData[$k]['studentData'] as $key => $value)
				
							<tr>
								<td>{{$value['id']}}</td>
								<td>{{$value['name']}}</td>
								<td>{{$value['age']}}</td>
							</tr>
									
						@endforeach



					</tr>
					</table>	

				</td>
				
			



			</tr>
		@endforeach
	</table>
@endsection