@extends('layouts.admin')

@section('title', 'category_add ADMIN')

@section('content')
           <div class="" align="center">
               <h1>Category  Create</h1>
           </div>
           <form class="form-horizontal">
               @csrf
               <div class="form-group" style="margin-top:30px;">
                   <label for="inputEmail3" class="col-sm-2 control-label">category-name</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="cate_name" id="inputEmail3" placeholder="">
                   </div>
               </div>
               <div class="form-group">
                   <label for="inputEmail3" class="col-sm-2 control-label">parent</label>
                   <div class="col-sm-10">
                       <select name="pid" class="form-control">

                           <option value="0">--请选择--</option>
                            @foreach($cate as $k=>$v)
                               <option value="{{$v['cate_id']}}">{{$v['cate_name']}}</option>
                            @endforeach
                       </select>
                   </div>
               </div>
               <div class="form-group">
                   <div class="col-sm-offset-2 col-sm-10">
                       <input type="button" class="btn btn-default" value="CREATE">
                   </div>
               </div>
           </form>

           <script>
                   $(function(){
                       $.ajaxSetup({
                           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                       });
                   });

                    //校验名字是否重复
                    $('[name="cate_name"]').blur(function(){
                        var cate_name=$('[name="cate_name"]').val();
                        // alert(cate_name);return;
                        $.ajax({
                            url:"{{url('admin/cate/blur')}}",
                            type:"GET",
                            data:{cate_name:cate_name},
                            dataType:"json",
                            success:function(res){
                            //    alert(res.msg);
                                    console.log(res);
                                if(res.ret==0){
                                    flag = false;
                                    alert('数据重复');return false;
                                    //$('[name="cate_name"]').val('');
                                   
                                }else{
                                 
                                }
                                // alert(flag);return;
                            }
                        });
                            
                    });
                           
               $('.btn').on('click',function(){
                var cate_name=$('[name="cate_name"]').val();
                        // alert(cate_name);return;
                        $.ajax({
                            url:"{{url('admin/cate/blur')}}",
                            type:"GET",
                            data:{cate_name:cate_name},
                            dataType:"json",
                            success:function(res){
                            //    alert(res.msg);
                                    console.log(res);
                                if(res.ret==0){
                                 
                                    // alert('数据重复');return false;
                                    //$('[name="cate_name"]').val('');
                                    return false;
                                }else{
                                  
                                            // alert("走添加了");
                                    var cate_name=$('[name="cate_name"]').val();
                                    var pid=$('[name="pid"]').val();
                                    $.ajax({
                                        url:"{{url('admin/cate/add_do')}}",
                                        type:"post",
                                        data:{cate_name:cate_name,pid:pid},
                                        dataType:"json",
                                        success:function (res) {
                                            alert(res.msg);
                                            if(res.ret==1){
                                                location.href="{{'admin/cate/index'}}"
                                            }
                                        }
                                    });
                                    return false;   
                                    //alert(flag);

                                }
                                // alert(flag);return;
                            }
                        });



                         
                   
                       
                    });
                    //调用
                    function checkName(){
                        var cate_name=$('[name="cate_name"]').val();
                        // alert(cate_name);return;
                        $.ajax({
                            url:"{{url('admin/cate/blur')}}",
                            type:"GET",
                            data:{cate_name:cate_name},
                            dataType:"json",
                            success:function(res){
                            //    alert(res.msg);
                                    console.log(res);
                                if(res.ret==0){
                                    flag = false;
                                    alert('数据重复');return false;
                                    //$('[name="cate_name"]').val('');
                                    return false;
                                }else{
                                    flag = true;
                                    
                                    //alert(flag);

                                }
                                // alert(flag);return;
                            }
                        });
                    }
           </script>
@endsection