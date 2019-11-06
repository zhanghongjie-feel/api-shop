<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
{
    public function apiTest(Request $request)
    {
        $name=$request->input('name');
        $sign=$request->input('sign');
        if(empty($name)){
            return json_encode(['ret'=>201,'msg'=>'name没传'],JSON_UNESCAPED_UNICODE);
        }
        if(empty($sign)){
            return json_encode(['ret'=>202,'msg'=>'sign没传'],JSON_UNESCAPED_UNICODE);
        }

        $mysign=md5('zhang'.$name);
        if($sign!=$mysign){
            return json_encode(['ret'=>203,'msg'=>'sign不对，你个逗逼'],JSON_UNESCAPED_UNICODE);
        }

        return json_encode(['ret'=>1,'msg'=>'好的，你的请求我接到了'],JSON_UNESCAPED_UNICODE);

    }





}
