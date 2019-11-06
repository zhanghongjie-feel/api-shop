<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\model\CategoryModel;
use App\model\Goods;
use App\model\GoodsAttr;
use App\model\Cart;
use App\model\Student;
use App\model\Classes;
use App\model\Aes;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function dudu()
	{
		$data=['ret'=>1,'msg'=>'xxxxx'];
		$data=json_encode($data);

		$functionname=$_GET['jsoncallback'];
		echo $functionname."($data)";die;
//        return json_encode(['ret'=>1,'msg'=>'xxx']);
	}

	public function goodsinfo(){
		$data=Goods::orderBy("goods_id","DESC")->limit(4)->get();
		$base_path=env('URL_DOMAIN').'/storage/goods/OiwwKHzNqlpMn2kQValwnjCsLv9VhB3aKOTlUQ0l.jpeg';
		foreach($data as $k => $v){
			// var_dump($v['goods_img']);
			if(!empty($v['goods_img'])){
				$data[$k]['goods_img']=env('URL_DOMAIN').$v['goods_img'];                
			}else{
				$data[$k]['goods_img']=$base_path;
			}
		}
		return json_encode(['ret'=>1,'data'=>$data]);
	}

	public function cateinfo()
	{
		$data=CategoryModel::orderBy("cate_id",'DESC')->limit(4)->get();
		return json_encode(['data'=>$data]);
	}

	public function detail(Request $request){



		//返回三种数据
		//1.商品数据。2.商品可选规格属性 3.商品的普通属性介绍
		$goods_id=$request->input('goods_id');

		//记录商品访问量
		$res=Goods::where(['goods_id'=>$goods_id])->first();
		// dd($res);
		$res->visit_num=$res->visit_num+1;
		// dd($num);
		$res->save();

		// $ip = $_SERVER['REMOTE_ADDR'];
		// $cache_name='visit_num'.$ip;
		// $num = $request->get('num');
		



		//查询商品表
		$goodsinfo=Goods::where(['goods_id'=>$goods_id])->first()->toArray();
		// dd($goodsinfo);
		//判断有无图片，有就展示，。没有展示默认图片
		$base_path=env('URL_DOMAIN').'/storage/goods/OiwwKHzNqlpMn2kQValwnjCsLv9VhB3aKOTlUQ0l.jpeg';
		if(!empty($goodsinfo['goods_img'])){
			$goodsinfo['goods_img']=env('URL_DOMAIN').$goodsinfo['goods_img'];  
		}else{
			$goodsinfo['goods_img']=$base_path;
		}
		// dd($goodsinfo);

		//查询商品属性表
		$goodsAttr=GoodsAttr::join('attribute','goods_attr.attr_id','=','attribute.attr_id')->where(['goods_id'=>$goods_id])->get()->toArray();
		// var_dump($goodsAttr);die;
		$specData=[];//可选规格属性
		$argsData=[];//普通展示属性

		//将不同的可选属性放入不同的数组
		foreach($goodsAttr as $k => $v){
			if($v['optional']==2){
				//可选规格
				$status=$v['attr_name'];
				$specData[$status][]=$v;

			}else{
				$argsData[]=$v;
			}

		}
		// var_dump($specData);
		return json_encode([
			'goodsinfo'=>$goodsinfo,
			'specData'=>$specData,
			'argsData'=>$argsData
		]);
	   
	}

	public function cartShow(Request $request)
	{   
        //虽然cart表里有user_id  然而你并不知道要查出那个  所以只好从中间件里 通过token判断user_id要拿出那个
        $userData=$request->get('userInfo');
        $user_id=$userData->user_id;

        //根据user_id拿出他的购物车数据
		$cartData=Cart::join('goods','cart.goods_id','=','goods.goods_id')->where(['user_id'=>$user_id])->get()->toArray();

        //默认图片
		$base_path=env('URL_DOMAIN').'/storage/goods/OiwwKHzNqlpMn2kQValwnjCsLv9VhB3aKOTlUQ0l.jpeg';
        //将图片补充完整放进去
		foreach($cartData as $k => $v){
			// var_dump($v['goods_img']);
			if(!empty($v['goods_img'])){
				$cartData[$k]['goods_img']=env('URL_DOMAIN').$v['goods_img'];                
			}else{
				$cartData[$k]['goods_img']=$base_path;
			}
		}



        //商品的属性值组合   颜色：xxx 属性：xxx
        foreach($cartData as $k => $v){
            $goods_attr_list = explode(",",$v['goods_attr_id_list']);
            //根据goods_attr_id查询所有相关属性值、
            $goodsAttrData=GoodsAttr::join('attribute','goods_attr.attr_id','=','attribute.attr_id')->whereIn('goods_attr_id',$goods_attr_list)->get()->toArray();

                //组装字符串
                $attr_show_list=''; //颜色：xxx 内存：xxx
                //再goods基础上+attr附上新的price
                $price_count = $v['goods_price'];

                //最终的价格+属性组合
                foreach ($goodsAttrData as $key => $value) {
                    $attr_show_list .= $value['attr_name'].":".$value['attr_value'].",";
                    $price_count += $value['attr_price'];
                }

            //重新对数组元素赋值
                $cartData[$k]['attr_show_list'] = rtrim($attr_show_list,',');
                $cartData[$k]['goods_price'] = $price_count;
        }
        // dd($cartData);
        



		return json_encode($cartData);
	}                              




    public function class_show()
    {
        $classData=Classes::get()->toArray();
        // dd($classData);
        foreach ($classData as $key => $value) {

            $student_count=Student::where(['class_id'=>$value['class_id']])->count();

            
                $classData[$key]['student_count']=$student_count;
        
            
        }
        // dd($classData);

        return view('Admin.class_show',['classData'=>$classData]);
    }


    public function  student_show()
    {
         $classData=Classes::get()->toArray();

         foreach ($classData as $key => $value) {

             $studentData=Student::where(['class_id'=>$value['class_id']])->get()->toArray();
                foreach ($studentData as $k => $v) {
                    $classData[$key]['studentData']=$studentData;
                }

         }
         // dd($classData);

         return view('Admin.student_show',['classData'=>$classData]);
         
    }




    //解密
    public function aes_decrypt()
    {
        $key='110';//密钥
        $obj= new Aes($key);
        $string='lNzbH7ecdj4c9yEcQl156WwOxpJ7L2wY+QsNObELKEjUZEvokxQOLzx+WAQSdUq2A/c5HgWlviRDtG3Nan7gFA==';//要解开的密文
        $data=$obj->decrypt($string);

        echo $data;
    }

    //加密
    public function aes_encrypt()
    {
        $key='111';
        $obj=new Aes($key);
        $data='l love you';
        echo $eStr = $obj->encrypt($data);
    }

}
