
	@extends('layouts.admin')

@section('title', '注册')
@section('content')
	
	<table class="table">
		<tr>
			<td>名字</td>
			<td><input id='name' type="text" name=""></td>
		</tr>
		<tr>
			<td>密码</td>
			<td><input id="pwd" type="password" name=""></td>
		</tr>
		<tr>
			<td><button id='register'>注册</button></td>
		</tr>
	</table>
	<script type="text/javascript">
		$('#register').on('click',function(){
		var name=$('#name').val();
		var pwd=$('#pwd').val();
			$.ajax({
				url:"{{url('new/do_register')}}",
				data:{name:name,pwd:pwd},
				dataType:"json",
				success:function(res){
					
				}
			});
		});
	</script>

@endsection