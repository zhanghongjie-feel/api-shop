<?php

namespace App\Http\Controllers\lonely;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Curl;
use App\model\Newes;
use Illuminate\Support\Facades\Cache;
class Exam extends Controller
{
    public function use_api()
    {
    	$new_title='http://api.avatardata.cn/ActNews/LookUp?key=b80a655d2cd440b2bea7ef1579a0f1f9';
    	$title_data=Curl::get($new_title);
    	$title_res=json_decode($title_data,1);
    	$title_array=[];
    	for ($i=0; $i <2 ; $i++) { 
    		$title_array[]=$title_res['result'][$i];
    	}

    	foreach ($title_array as $key => $value) {
    		$new_url='http://api.avatardata.cn/ActNews/Query?key=b80a655d2cd440b2bea7ef1579a0f1f9&keyword='.$value;
    		$data=Curl::get($new_url);
    		$result=json_decode($data,1);

    		foreach ($result['result'] as $k => $v) {
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

		

    	// dd($new_res);
		
    }


    public function new_show(Request $Request)
    {
    	//接口防刷
    	 $ip = $_SERVER['REMOTE_ADDR']; //获取到ip
    	 // dd($ip);
        
        $cache_name='new_data'.$ip;
        
        //2.从缓存获取他
        $num=Cache::get($cache_name);
        if(!$num){
            $num=1;
        }
        if($num>=5){
            echo json_encode([
                'ret'=>201,
                'msg'=>'接口调用频繁，请稍后再试',
            ],
                JSON_UNESCAPED_UNICODE
        );die;
        }
        $num+=1;
        Cache::put($cache_name,$num,86400);

// dd($num);




        //列表展示
    	$mysql=Newes::limit(10)->get();
    	$mysql=json_encode($mysql);

    	// dd($mysql);
    	$this->redis=new \Redis();
        $this->redis->connect('127.0.0.1','6379');
        $redis_key='new_data';
        $newData=$this->redis->get($redis_key);
       

        if(!$newData){
			$newData=$this->redis->set($redis_key,$mysql);

        }
		// dd($newData);
		// $value = Cache::pull($cache_name);die;
		$newData=json_decode($newData,1);
		// dd($newData);
		return view('new',['newData'=>$newData]);
    }
}
