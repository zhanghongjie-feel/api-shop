<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\Attr;
use App\model\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\model\CategoryModel;
class AdminController extends Controller
{
    public function wechat_login()
    {
        //二维码识别后访问的地址
        $id=time().rand(1000,9999);
        $redirect_url="http://api.distantplace.vip/admin/wechat/login_do?id=".$id;
        //生成一个二维码
        return view('Admin.wechat_login',[
            'redirect_url'=>$redirect_url,
            'id'=>$id
        ]);
    }
    public function wechat_login_do()
    {
        //接受二维码
        $id=request('id');
        //通过网页授权获取openid
    }
    public function category_blur(Request $request)
    {
        $cate_name=request('cate_name');
        $cate_info=CategoryModel::where('cate_name',$cate_name)->count();
        if($cate_info>0){
            return json_encode(['ret'=>0,'msg'=>'数据不可以用']);
        }else{

        }
    }
    public function attr_add()
    {
        $type_info=Type::get()->toArray();
        return view('Admin.Attribute.attr_add',['type_info'=>$type_info]);
    }
    public function attr_add_do(Request $request)
    {
        $req=$request->all();
        $attr_name=$req['attr_name'];
        $attr_pid=$req['attr_pid'];
        $optional=$req['optional'];
        $res=Attr::create([
           'attr_name'=>$attr_name,
            'type_id'=>$attr_pid,
            'optional'=>$optional
        ]);
        if($res){
            return redirect('admin/type/index');
        }
    }

    public function attr_show(Request $request)
    {
        $id=$request->input('id');//type表带过id
        $type_data=Type::get()->toArray();//支持搜索操作select狂->type
        $type_id=$request->input('type_name');//接受的select value
        if(isset($type_id)){
            $data=Attr::where(['type_id'=>$type_id])->get()->toArray();
        }else{
            $data=Attr::where(['type_id'=>$id])->get()->toArray();
        }

        return view('Admin.Attribute.attr_index',['type'=>$type_data,'attr'=>$data]);
    }

    public function attr_delAll(Request $request)
    {
        $req=$request->all()['attr_id'];
        $req=explode(',',$req);
        $data=Attr::whereIn('attr_id',$req)->delete();
        dd($data);
    }
    public function type_add()
    {
        return view('Admin.Type.type_add');
    }

    public function type_add_do(Request $request)
    {
        $req=$request->all();
        $type_name=$req['type_name'];
        $res=Type::create([
           'type_name'=>$type_name
        ]);
        if($res){
            return redirect('admin/type/index');
        }
    }

    public function type_index()
    {
        $type=Type::get()->toArray();
        foreach ($type as $k=>$v){
            $attr_num=Attr::where(['type_id'=>$v['type_id']])->count();
            $type[$k]['attr_num']=$attr_num;
        }


        return view('Admin.Type.type_index',['type'=>$type]);
    }
    public function category_add()
    {
        $info=CategoryModel::get()->toArray();
        return view('Admin.Category.category_add',['cate'=>$info]);
    }

    public function category_add_do(Request $request)
    {
        $data=$request->all();
        $cate_name=$request->all()['cate_name'];
        $pid=$request->all()['pid'];
        $res=CategoryModel::create([
            'cate_name'=>$cate_name,
            'pid'=>$pid
        ]);
        if($res){
            return json_encode(['ret'=>1,'msg'=>'添加成功']);
        }
    }

    public function category_index()
    {
        $info=CategoryModel::get()->toArray();
        return view('Admin.Category.category_index',['data'=>$info]);
    }
}
