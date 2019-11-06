
<script src="{{asset('js/jquery.min.js?v=2.1.4')}}"></script>
<center>
    <img src="http://qr.liantu.com/api.php?text={{$redirect_url}}"/>
</center>

<script>

    $(function(){
        //每隔几秒
        var t=setInterval("check();",2000);

        var id= {{$id}};
        function check(){
            //js轮询、
            $.ajax({
                url:"{{url('admin/wechat_login/checkWechatLogin')}}",
                dataType:"json",
                data:{id:id},
                sucess:function (res) {
                    alert(res.msg);
                    if(res.ret==1){
                        //关闭定时器
                        clearInterval(t);
                        //扫码登录成功
                        location.href="{{url('admin/goods/show')}}"
                    }
                }

            });
        }
    });

</script>