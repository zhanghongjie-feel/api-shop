@extends('layouts.admin')

@section('title', 'category_index ADMIN')

@section('content')
    <div class="" align="center">
        <h1>Category  Index</h1>
    </div>
    <table class="table" border="1" style="margin-left:50px;margin-top:50px;">
        <tr>
            <td>cate_id</td>
            <td>catename</td>
            <td>pid</td>
        </tr>

        @foreach($data as $k=>$v)
            <tr>
                <td>{{$v['cate_id']}}</td>
                <td>{{$v['cate_name']}}</td>
                <td>{{$v['pid']}}</td>
            </tr>
        @endforeach
    </table>

@endsection