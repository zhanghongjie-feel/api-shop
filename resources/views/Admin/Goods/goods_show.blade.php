@extends('layouts.admin')
@section('title', '货品添加')
@section('content')
    <h3>货品展示</h3><br>
    <form class="" action="{{url('admin/goods/show')}}" method="post">
      @csrf
      商品名
      <input type="text" name="search_goods" value="{{$search_goods}}">
      </select>
      分类 <select class="" name="search_cate">
        <option value="">——请选择——</option>
        @foreach($cate_name as $k=>$v)
        <option value="{{$v['cate_name']}}">{{$v['cate_name']}}</option>
        @endforeach
      </select>
      <input type="submit" name="" value="搜索">
    </form>

    <table class="table" border="1">
        <tr>
          <td>goods_id</td>
          <td>商品名称</td>
          <td>商品分类</td>
          <td>价格</td>
          <td>是否上架</td>
        </tr>
        @foreach($goods as $k=>$v)
        <tbody>
          <td>{{$v['goods_id']}}</td>
          <td>{{$v['goods_name']}}</td>
          <td>{{$v['cate_name']}}</td>
          <td>{{$v['goods_price']}}</td>
          @if($v['is_up']==1)
          <td>上架</td>
          @elseif($v['is_up']==2)
          <td>下架</td>
          @endif
        </tbody>
        @endforeach
    </table>
@endsection
