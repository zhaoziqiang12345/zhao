<?php

namespace app\common\model;

use think\Model;

class Goods extends Model
{
    protected $table = 'shop_goods';
    protected $pk = 'gid';

    public function cate()
    {
    	return $this->belongsTo('Cate','cate_cid','cid')->bind('cname');
    }

    public function getSmgpicAttr()
    {
    	return str_replace('\\', '/sm_', $this->gpic);
    }
}
