<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'register';//设置表名
    protected $primaryKey="register_id";//主键id
    public $timestamps = false;//关闭自动时间戳
    protected $guarded = [];//不能被批量赋值的属性
}