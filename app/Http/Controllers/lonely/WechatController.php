<?php

namespace App\Http\Controllers\lonely;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Curl;

class WechatController extends Controller
{
	
	public function get_token()
	{
		// echo 1;die;

		$appid='php1002';
		$appsecret='18fb83f6d946dbdddb87c14589d234ae';
		$url="http://www.lonely.com/wechat/createToken?appid={$appid}&appsecret={$appsecret}";
		// dd($url);
		$res=Curl::get($url);

		$res=json_decode($res,1);
		$token=$res['token'];
		dd($token);
		// echo '<pre>';
		// var_dump($res);
		// echo 'token';

	}



    public function login()
    {
    	return view('lonely.login');
    }
}
