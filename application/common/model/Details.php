<?php

namespace app\common\model;

use think\Model;

class Details extends Model
{
    protected $table = 'shop_details';
    protected $pk    = 'did';

    public function orders()
    {
    	return $this->belongsTo('Orders','orders_id','oid');
    }

    static public function init()
    {
    	self::event('after_insert',function($details){
    		Goods::get($details->gid)->setDec('stock',$details->cnt);
    		Goods::get($details->gid)->setInc('salecnt',$details->cnt);
    	});
    }
}
