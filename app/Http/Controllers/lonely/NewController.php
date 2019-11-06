<?php

namespace App\Http\Controllers\lonely;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Curl;
use App\model\Newes;
use App\model\Login;
use App\model\Register;
use Illuminate\Support\Facades\Cache;
class NewController extends Controller
{

	public function show(Request $Request)

	{


		  //根据ip做防刷
        $ip = $_SERVER['REMOTE_ADDR']; //获取到ip
        //缓存操作
        //1.定义键
        $cache_name='new_visit_num'.$ip;
        
        //2.从缓存获取他
        $num=Cache::get($cache_name);
        if(!$num){
            $num=1;
        }
        if($num>=100){
            echo json_encode([
                'ret'=>201,
                'msg'=>'接口调用频繁，请稍后再试',
            ],
                JSON_UNESCAPED_UNICODE
        );die;
        }
        $num+=1;
        Cache::put($cache_name,$num,60);

  



		//先判断是否有缓存
		$page=$Request->input('page');

		$cache_name='new_info'.$page;
		$newData=Cache::get($cache_name);
		// dd($newData);
		// $value = Cache::pull($cache_name);die;
		if(empty($newData)){
			$newData=Newes::orderBy('id','desc')->paginate(3);
			Cache::put($cache_name,$newData,86400);

		}

		// $NewData=Newes::paginate(4);
		// dd($NewData);
		return view('New_test.show',['NewData'=>$newData]);
	}

	public function login_do(Request $request)
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



	public function login()
	{
		return view('New_test.login');
	}

	public function register(Request $Request)
	{
		return view('New_test.register');
	}

	public function do_register(Request $Request)
	{
		$name=$Request->input('name');
		$pwd=$Request->input('pwd');

		if(isset($name) && isset($pwd)){
			$res=Register::create([
				'name'=>$name,
				'pwd'=>$pwd
			]);
		}
		
		
	}
	//通过接口获取数据
    public function use_api()
    {
    	
    	//思路
    		//1.通过for循环拿到关键字
    		//2.将关键字放入要查询的新闻
    	set_time_limit(100);//设置访问时间为100
    	$url='http://api.avatardata.cn/ActNews/LookUp?key=b80a655d2cd440b2bea7ef1579a0f1f9';
    	$hotData=Curl::get($url);
    	$hotData=json_decode($hotData,1);
    	// dd($hotData);
    	$keywordArr=[];

    	for ($i=0; $i < 9; $i++) { 
    		$keywordArr[]=$hotData['result'][$i];
    	}

    	// dd($keywordArr);

    	foreach ($keywordArr as $key => $value) {
    		$url='http://api.avatardata.cn/ActNews/Query?key=b80a655d2cd440b2bea7ef1579a0f1f9&keyword='.$value;
    	 	$data=Curl::get($url);
    		$res=json_decode($data,1);
    		// var_dump($res['result']);

    		if(!empty($res['result'])){

    			foreach ($res['result'] as $k => $v) {
    				//重复的新闻不入库
    				$newData=Newes::where(['title'=>$v['title']])->first();
	    			if(!$newData){
	    				Newes::create([
	    					'title'=>$v['title'],
	    					'content'=>$v ['content'],
	    					'pdate'=>$v['pdate'],
	    					'img'=>$v['img'],
	    					'src'=>$v['src'],
	    					'pdate_src'=>$v['pdate_src']
	    				]);
	    			}
    			}
    			
    		}

    	}

    	

    }
}


