
@extends('layouts.style')
@section('title', '微信登录')
@section('content')


<form class="form-horizontal" action="">
	
  <div class="form-group">

    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="请输入名字">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd" id="inputPassword3" placeholder="输入密码">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
       
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-default">登录</button>
    </div>
  </div>
</form>


<script type="text/javascript">
    $('.btn').on('click',function(){
        var name=$('[name="name"]').val();
        var pwd=$('[name="pwd"]').val();
        var urll='http://www.lonely.com/wechat/do_login';
        $.ajax({
            url:urll,
            dataType:"json",
            data:{name:name,pwd:pwd},
            success:function(res){
              alert(res.msg);
              if(res.ret==1){
                location.href="http://www.lonely.com/wechat/index?name="+name+'&pwd='+pwd
              }
            }


        });

    });
</script>


	@endsection