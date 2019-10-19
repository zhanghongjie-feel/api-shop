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
               $('[name="cate_name"]').blur(function(){
                    var cate_name=$('[name="cate_name"]').val();
                    $.ajax({
                        url:"{{url('admin/cate/blur')}}",
                        type:"GET",
                        data:{cate_name:cate_name},
                        dataType:"json",
                        success:function(res){
//                            alert(res.msg);
                            if(res.ret==0){
                                $('[name="cate_name"]').val('');
                                $('.btn').attr('disabled',true);
                            }
                        }
                    });
                    $('.btn').on('click',function(){
                        var cate_name=$('[name="cate_name"]').val();
                        var pid=$('[name="pid"]').val();
//                        alert(cate_name);
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
                    })
               })
           </script>
@endsection