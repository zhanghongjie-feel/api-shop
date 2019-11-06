<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
class Apiheader
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
        header("Access-Control-Allow-Origin: *");   //全域名
        header("Access-Control-Allow-Credentials: true");   //是否可以携带cookie

        header("Access-Control-Allow-Methods: POST,GET,PUT,OPTIONS,DELETE");   //允许请求方式
        header("Access-Control-Allow-Headers: X-Custom-Header");   //允许请求字段，由客户端决定
        header("Content-Type: text/html; charset=utf-8"); //返回数据类型（ text/html; charset=utf-8、 application/json; charset=utf-8 )




//         //根据ip做防刷
//         $ip = $_SERVER['REMOTE_ADDR']; //获取到ip

//         //缓存操作
//         //1.定义键
//         $cache_name='visit_num'.$ip;
        
//         //2.从缓存获取他
//         $num=Cache::get($cache_name);
//         if(!$num){
//             $num=1;
//         }
//         if($num>=1000){
//             echo json_encode([
//                 'ret'=>201,
//                 'msg'=>'接口调用频繁，请稍后再试'
//             ]);die;
//         }
//         $num+=1;
//         Cache::put($cache_name,$num,60);

//         // echo $num;
// // var_dump($num);

//         $mid_params = ['num'=>$num];
//         $request->attributes->add($mid_params);//添加参数
        return $next($request);


    }
}
