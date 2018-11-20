<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Cate;
use app\common\model\Goods;

class GoodsController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($id='')
    {
        if(!empty($id)){
            $arr_cid = Cate::where('path','like',"%,$id,%")->column('cid');
            $arr_cid[]=$id;
            // halt($arr_cid);
            $condition[]=['cate_cid','in',$arr_cid];
        }

        if(!empty($_GET['gname'])){
            $condition[] = ['gname','like',"%{$_GET['gname']}%"];
        }

        $goods = Goods::where($condition)->select();
        // halt($goods);

        return view('goods/index',['goods'=>$goods]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $goods = Goods::get($id);

        return view('goods/read',['goods'=>$goods]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
