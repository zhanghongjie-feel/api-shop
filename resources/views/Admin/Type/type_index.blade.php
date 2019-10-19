@extends('layouts.admin')

@section('title', 'category_index ADMIN')

@section('content')
    <div class="" align="center">
        <h1>Type  Index</h1>
    </div>
    <table class="table" border="1" style="margin-left:50px;margin-top:50px;">
        <tr>
            <td><b>type_id</b></td>
            <td><b>type_name</b></td>
            <td><b>属性个数</b></td>
            <td><b>操作</b></td>
        </tr>
        @foreach($type as $k=>$v)
        <tr>
            <td>{{$v['type_id']}}</td>
            <td>{{$v['type_name']}}</td>
            <td>{{$v['attr_num']}}</td>
            <td><a href="{{url('admin/attr/show')}}?id={{$v['type_id']}}">属性列表</a></td>
        </tr>
            @endforeach
    </table>

@endsection