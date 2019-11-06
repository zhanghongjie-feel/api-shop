<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';//设置表名
    protected $primaryKey="id";//主键id
    public $timestamps = false;//关闭自动时间戳
    protected $guarded = [];//不能被批量赋值的属性
}
