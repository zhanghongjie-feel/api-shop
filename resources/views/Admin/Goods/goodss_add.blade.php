@extends('layouts.admin')
@section('title', '货品添加')
@section('content')
    <h3>货品添加</h3>
    <form class="" action="{{url('admin/product/add_do')}}" method="post">
      @csrf
      <input type="hidden" name="goods_id" value="{{$goods_id}}">
      <table width="100%" id="table_list" class='table table-bordered'>
          <tbody>
          <tr>
              <th colspan="20" scope="col">商品名称：{{$goodsData[0]['goods_name']}} &nbsp;&nbsp;&nbsp;&nbsp;货号：ECS000075</th>
          </tr>

          <tr>
              <!-- start for specifications -->
              @foreach($attrData as $k=>$v)
                  <td scope="col"><div align="center"><strong>{{$k}}</strong></div></td>
              @endforeach
              <!-- end for specifications -->
              <td class="label_2">货号</td>
              <td class="label_2">库存</td>
              <td class="label_2">&nbsp;</td>
          </tr>

          <tr id="attr_row">
              <!-- start for specifications_value -->
             @foreach($attrData as $k=>$v)
              <td align="center" style="background-color: rgb(255, 255, 255);">
                  <select name="attr[]">
                      <option value="" selected="">请选择...</option>
                      @foreach($v as $k=>$vv)
                          <option value="{{$vv['goods_attr_id']}}">{{$vv['attr_value']}}</option>
                      @endforeach
                  </select>
              </td>
              @endforeach
              <!-- end for specifications_value -->
              <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" value="" size="20"></td>
              <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
              <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button" value="+" ></td>
          </tr>

          <tr>
              <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
                  <input type="submit" class="create" value=" 保存 ">
              </td>
          </tr>
          </tbody>
      </table>
    </form>


    <script type="text/javascript">

    //+ -效果
       $(document).on('click','.button',function () {
            var val=$(this).val();
            if(val=='+'){
                $(this).val('-');

                var clone_tr=$(this).parents('tr').clone();
                $(this).parents('tr').after(clone_tr);
                $(this).val('+');
            }else{
                $(this).parents('tr').remove();
            }
       });
    </script>
@endsection
