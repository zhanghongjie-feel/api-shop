<?php

namespace App\Http\Middleware;

use Closure;
use App\model\Login;
class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //接token
        $token=$request->input('token');
        // dd($token);
        //为了好看，把代码拆了
        $userInfo=$this->checkToken($token);
        //把数据传入接口
        $mid_params = ['userInfo'=>$userInfo];
        $request->attributes->add($mid_params);//添加参数

        return $next($request);
    }

    public function checkToken($token)
    {
        if(empty($token)){
            echo json_encode(['ret'=>201,'msg'=>'1']);
        }

        $userInfo=Login::where(['token'=>$token])->first();
        // dd($userInfo);
        if(empty($userInfo)){
            echo json_encode(['ret'=>201,'msg'=>'2']);
        }

        if(time() > $userInfo->expire_time){
            echo json_encode(['ret'=>201,'msg'=>'3']);
        }

        $userInfo->expire_time=time()+7200;
        $userInfo->save();
        return $userInfo;
    }
}
