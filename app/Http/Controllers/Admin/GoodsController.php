<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\Attr;
use App\model\CategoryModel;
use App\model\Type;
use Illuminate\Http\Request;
use App\model\Goods;
use App\model\GoodsAttr;
use App\model\product;
class GoodsController extends Controller
{
    /*
    *         商品添加的执行
    */
    public function goods_add_do(Request $request)
    {
        $postData=$request->all();
//        dd($postData);
        //  商品基本信息入库
        if(isset($postData['image'])){
            $path=request()->file('image')->store('goods');
            //        dd('/storage/'.$path);
            $goods_id=Goods::insertGetId([
                'goods_name'=>$postData['goods_name'],
                'goods_price'=>$postData['goods_price'],
                'goods_img'=>'/storage/'.$path,
                'cate_id'=>$postData['cat_id'],
                'is_up'=>$postData['is_up']
            ]);
        }else{
            $goods_id=Goods::insertGetId([
                'goods_name'=>$postData['goods_name'],
                'goods_price'=>$postData['goods_price'],
                'cate_id'=>$postData['cat_id'],
                'is_up'=>$postData['is_up']
            ]);
        }

//        dd($goods_id);
        $g_id=$goods_id; //拿到商品的id
//dd($g_id);
        //  商品——属性 信息入库
        $insertData=[]; //定义要添加的数据
        foreach ($postData['attr_value_list'] as $k=>$v){
            $insertData[]=[
                'goods_id'=>$g_id,
                'attr_id'=>$postData['attr_id_list'][$k],
                'attr_value'=>$v,
                'attr_price'=>$postData['attr_price_list'][$k]
            ];
//            var_dump($postData['attr_id_list']);
//            var_dump($postData['attr_id_list'][$k]);
            //$v=$postData['attr_value_list'][$k]
        }
//        print_r($insertData);

        //批量入库
        $res=GoodsAttr::insert($insertData);
//        var_dump($res);
        if($res){
            return redirect('admin/product/add?goods_id='.$g_id);
        }
    }

    public function product_add()
    {
        $g_id=request('goods_id');
        //查询商品信息
        $goodsData=Goods::where(['goods_id'=>$g_id])->get()->toArray();
        // dd($goodsData);
        //查询商品-属性信息
        $goodsAttrData=GoodsAttr::join("attribute","goods_attr.attr_id","=","attribute.attr_id")->where(['goods_id'=>$g_id])->get()->toArray();
//        echo "<pre>";
//        var_dump($goodsAttrData);
        //数据处理\
        $newArr=[];
        foreach ($goodsAttrData as $k=>$v){
            $status=$v['attr_name'];
            $newArr[$status][]=$v;

        }
//        var_dump($newArr);
        return view('Admin.Goods.goodss_add',['attrData'=>$newArr,'goodsData'=>$goodsData,'goods_id'=>$g_id]);
    }

    public function product_add_do(Request $request)
    {
        $data=$request->input();
        $size=count($data['attr']) / count($data['product_number']);//判断要入sql的product表的value_list字段有几个goods_attr_id
        $goodsAttr=array_chunk($data['attr'],$size);//分割成多个数组，每个数组有$size个单元
        foreach ($goodsAttr as $key => $value) {  //之所以循环他是因为他的数值就是数据库入几条
          $res=Product::create([
            'goods_id'=>$data['goods_id'],
            'value_list'=>implode(',',$value),
            'product_num'=>$data['product_number'][$key] //因为num按顺序排列，所以直接循环$key;
          ]);
        }
        if($res){
          return redirect('admin/product/show');
        }

    }

    public function goods_show(Request $request)
    {
      $cate_name=CategoryModel::get('cate_name')->toArray();//搜索input框的cate所需数值
      $goods=Goods::join('category','category.cate_id','=','goods.cate_id')->get()->toArray();//循环所需数据
      // dd($goods);
      $where=[];

      $search_goods=$request->input('search_goods');
      $search_cate=$request->input('search_cate');
        if(isset($search_goods)){
          // $where[]=['goods_name',"like","%$search_goods%"];
          // $goods=Goods::where($where)->join('category','category.cate_id','=','goods.cate_id')->get()->toArray();//循环所需数据
        }
        if(isset($search_cate)){
            // $where[]=['cate_name'=>$search_cate];
            // dd($where);
            $goods=CategoryModel::where(['cate_id'=>6])->get();//循环所需数据
            dd($goods);
        }
        return view('Admin.Goods.goods_show',['goods'=>$goods,'cate_name'=>$cate_name,'search_goods'=>$search_goods]);
    }


    public function goods_add()
    {
        $cate_info=CategoryModel::get()->toArray();
        $type_info=Type::get()->toArray();
        return view('Admin.Goods.goods_add',['cate_info'=>$cate_info,'type_info'=>$type_info]);
    }

    public function goods_getAttr()
    {
        $type_id=request('type_id');
        $attr_info=Attr::where(['type_id'=>$type_id])->get()->toArray();
        return json_encode($attr_info);
    }


    public function upload(Request $request)
    {
        return view('Admin.Goods.upload');
    }
    public function do_upload(Request $request)
    {
        dd($request->all());
    }
}
