
@extends('layouts.admin')

@section('title', '登录')
@section('content')
	
		
		<table class='table table-bordered table-hover table-striped'>
			<tr>
				<td>名字</td>
				<td>
					<input type="text" id="name" name="user_name">
				</td>
			</tr>
			<tr>
				<td>密码</td>
				<td>
					<input type="password" id="password" name="user_pwd">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="button" id="login" value="登录"><br><br>
					<button id="register">注册</button>

				</td>
			</tr>
		</table>
	

	<script src="/js/public.js"></script>
	<script type="text/javascript">
		$('#login').on('click',function(){

				var name=$('#name').val();
				var pwd=$('#password').val();
				$.ajax({
					url:"{{'new/login_do'}}",
					dataType:"json",
					data:{name:name,pwd:pwd},
					success:function(res){
						console.log(res);
						if(res.ret==1){
							//存储token
							var token=res.token;
							setCookie('token',token,120);
							
							location.href="{{'new/show'}}"
						}
					}
				});
				return false;
			});

		$('#register').on('click',function(){

			location.href="{{'new/register'}}"


		});
	</script>

@endsection