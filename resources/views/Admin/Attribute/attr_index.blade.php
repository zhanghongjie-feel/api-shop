<script src="{{asset('js/jquery.min.js?v=2.1.4')}}"></script>
@extends('layouts.admin')

@section('title', 'type_add ADMIN')


    {{--<input type="hidden" name="" value="{{$id}}">--}}
    <div class="" align="center" style="margin-top: 40px;">
        <h1>Attr  Index</h1>
    </div>
<center>
    <form action="{{url('admin/attr/show')}}">

        <select name="type_name" id="">
            @foreach($type as $k=>$v)
                <option value="{{$v['type_id']}}">{{$v['type_name']}}</option>
            @endforeach
        </select>

        <button class="search">按照商品类型展示</button>
    </form>

</center>

    <table class="table" border="1" style="margin-left:50px;margin-top:50px;">
        <tr>
            <td style="width:200px;">
                <button id="all">全选</button>
                <button id="back">反选</button>
                <button id="delAll">批删</button>
            </td>
            <td><b>attr_id</b></td>
            <td><b>attr_name</b></td>
            <td><b>optional</b></td>
        </tr>

        @foreach($attr as $k=>$v)
            <tr>
                <td attr_id="{{$v['attr_id']}}">
                    <input type="checkbox" class="CheckAll" name='CheckAll'>
                </td>
                <td>{{$v['attr_id']}}</td>
                <td>{{$v['attr_name']}}</td>
                    @if($v['optional']==1)
                    <td>可选属性</td>
                    @elseif($v['optional']==2)
                    <td>属性不可选</td>
                        @endif
            </tr>
        @endforeach
    </table>
    <script>

//        function getQueryString(name){
//            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
//            var r = window.location.search.substr(1).match(reg);
//            if(r!=null)return  unescape(r[2]); return null;
//        }
//        var id=getQueryString("id");
//全选/全不选
 $("#all").click("click",function(){
     var tt = $('[name="CheckAll"]').prop('checked');
            if(tt === false){
                $('[name="CheckAll"]').prop('checked',true);
                $(this).html('全不选');
            }else{
                $('[name="CheckAll"]').prop('checked',false);
                $(this).html('全选');
            }
     });
$('#back').click(function(){
    $('.CheckAll').each(function()
    {
        $(this).prop('checked',!$(this).prop('checked'));
    });
});
    $('#delAll').click(function(){
        var attr_id='';
        $('.CheckAll:checked').each(function(){
            attr_id += $(this).parent().attr('attr_id') + ',';
        });
        attr_id=attr_id.substr(0,attr_id.length-1);
//        console.log(attr_id);
        location.href="{{url('admin/attr/delAll')}}?attr_id="+attr_id;
    })
    </script>
