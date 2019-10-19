<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{

    protected $table = 'category';//设置表名
    protected $primaryKey="cate_id";//主键id
    public $timestamps = false;//关闭自动时间戳
    protected $guarded = [];//不能被批量赋值的属性

}
