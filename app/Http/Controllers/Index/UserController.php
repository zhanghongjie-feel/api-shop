<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Login;
use App\model\Product;
use App\model\Cart;
/**
 * 登录接口
 */
class UserController extends Controller
{
    public function login(Request $request)
    {
        $user_name=$request->input('name');
        $user_pwd=$request->input('pwd');
        $data=Login::where(['user_name'=>$user_name,'user_pwd'=>$user_pwd])->first();
        if($data){
            $uid=$data->user_id;
            $token=md5($uid.time());
            $data->token=$token;
            $data->expire_time=time()+7200;

            $data->save();
            
            return json_encode(['ret'=>1,'msg'=>'登陆成功','token'=>$token]);
        }else{
            return json_encode(['ret'=>0,'msg'=>'登陆失败']);
        }
    }

    /**
     * 测试token
     */
    public function getUser(Request $request)
    {
        $token=$request->input('token');
        if(empty($token)){
            return json_encode(['ret'=>201,'msg'=>'请先登录']);
        }

        $userInfo=Login::where(['token'=>$token])->first();
        // dd($userInfo);
        if(empty($userInfo)){
            return json_encode(['ret'=>201,'msg'=>'请先登录']);
        }

        if(time() > $userInfo->expire_time){
            return json_encode(['ret'=>201,'msg'=>'请先登录']);
        }

        $userInfo->expire_time=time()+7200;
        $userInfo->save();

        return json_encode(['ret'=>200,'msg'=>'查询成功']);
    }

    public function cartAdd(Request $request)
    {

        $userInfo = $request->get('userInfo');//中间件产生的参数
        // dd($mid_params);
        //接收值
        $goods_id=$request->input('goods_id');
        $user_id=$userInfo->user_id;
        // dd($user_id);
        $goods_attr_id_list=implode(',',$request->input('goods_attr_id'));
        // dd($goods_attr_id_list);
        $buy_num=$request->input('buy_num');
        //根据goods_id  goods_attr_id_list查询product 库存
        $productData=Product::where(['goods_id'=>$goods_id,'value_list'=>$goods_attr_id_list])->first();//18 
        // dd($productData);
        $product_num=$productData->product_num;
        //通过购买的数量与货品表库存的对比  是否有货
        if($buy_num>$product_num){
            //没货
            $is_have=0;
        }else{
            //有货
            $is_have=1;
        }

        //入库部分
        //是否已经有这条数据 
        $cateData=Cart::where(['user_id'=>$user_id,'goods_id'=>$goods_id,'goods_attr_id_list'=>$goods_attr_id_list])->first();

        if(!empty($cateData)){
            //当修改购物车字段buy-number  再判断是否有货
        //有，修改buy_number
            $cateData->buy_number=$cateData->buy_number;
            $cateData->save();
        }

        
        //没有，添加
        Cart::create([
            'user_id'=>$user_id,
            'goods_id'=>$goods_id,
            'goods_attr_id_list'=>$goods_attr_id_list,
            'buy_number'=>$buy_num,
            'product_id'=>$productData->product_id,
            'is_have'=>$is_have
        ]);
    }




}
