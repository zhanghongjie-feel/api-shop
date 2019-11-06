<?php

namespace App\Http\Controllers\Key;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\RsaModel;
class Rsa extends Controller
{
    public function rsa()
    {
    	
    	$Rsa = new RsaModel();
		// phpinfo();die;

		// $keys = $Rsa->new_rsa_key(); //生成key
		// p($keys);die;

		// $privkey = file_get_contents("cert_private.pem");//$keys['privkey'];//拿密钥
		// $pubkey  = file_get_contents("cert_public.pem");//$keys['pubkey'];//拿公钥
    	$privkey = config('Key.Privatekey');
    	// dd($privkey);
    	$pubkey= config('Key.PublicKey');
		// echo $privkey;die;
		//初始化rsaobject
		$Rsa->init($privkey, $pubkey,TRUE);
		 
		//原文
		$data = '学习PHP太开心了';
		 
		//私钥加密示例
		$encode = $Rsa->priv_encode($data);
		RsaModel::p($encode);
		$ret = $Rsa->pub_decode($encode);//转明文
		$Rsa->p($ret);
			 
		//公钥加密示例
		$encode = $Rsa->pub_encode($data);
		// p($encode);
		$ret = $Rsa->priv_decode($encode);
		// p($ret);

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
