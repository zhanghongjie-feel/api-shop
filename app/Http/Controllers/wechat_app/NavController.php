<?php

namespace App\Http\Controllers\wechat_app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Nav;
class NavController extends Controller
{
    public function lists()
    {
    	$navData=Nav::get()->toArray();
    	$result=[
    		'code'=>200,
    		'msg'=>"查询成功",
    		'data'=>$navData
    	];
    	echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    public function search(Request $Request)
    {
    	$content=$Request->input('data');
        $where=[];
        if($content){
            $where[]=['title','like',"%$content%"];
        }
    	$data = Nav::where($where)->select('title')->get();
    	echo json_encode($data);
    }
}
