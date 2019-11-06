<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    protected $table = 'nav';//设置表名
    protected $primaryKey="nav_id";//主键id
    public $timestamps = false;//关闭自动时间戳
    protected $guarded = [];//不能被批量赋值的属性
}
