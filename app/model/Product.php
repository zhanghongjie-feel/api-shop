<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'product';//设置表名
  protected $primaryKey="product_id";//主键id
  public $timestamps = false;//关闭自动时间戳
  protected $guarded = [];//不能被批量赋值的属性
}
