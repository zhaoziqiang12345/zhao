<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Cate;

class CartController extends Controller
{
    public function add(Request $req,$id)
    {
        
        $goods = Goods::get($id);
        $goods->cnt = $req->post('cnt');

        session("cart.$id",$goods);

        return view('cart/add',['goods'=>$goods]);
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $carts = session('cart');

        $sum = 0;
        $cnt = 0;
        foreach ($carts as $k => $v) {
            $sum += $v->price*$v->cnt;
            $cnt += $v->cnt;
        }

        session('orders.sum',$sum);
        session('orders.cnt',$cnt);

        return view('cart/index',['carts'=>$carts,'sum'=>$sum,'cnt'=>$cnt]);
    }

    public function inc($id)
    {
        session("cart.$id")->cnt++;
        return redirect('/cart/index');
    }
    public function dec($id)
    {
        if( --session("cart.$id")->cnt<1){
             session("cart.$id")->cnt=1;
        }
        return redirect('/cart/index');
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
        //
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
        session("cart.$id",NULL);
        return redirect('/cart/index');
    }
}
