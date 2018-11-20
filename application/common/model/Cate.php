<?php

namespace app\common\model;

use think\Model;


class Cate extends Model
{
    protected $table = 'shop_cate';
    protected $pk = 'cid';

    static public function getSubCates($cates=[],$pid=0)
    {
    	if(empty($cates)){
    		$cates = self::select();
    	}
    	// halt($cates);
    	$arr = [];
    	foreach ($cates as $k=>$v){
    		if($v->pid == $pid){
    			$v->sub = self::getSubCates($cates,$v->cid);
    			$arr[]=$v;
    		}
    	}
    	return $arr;
    }
}
