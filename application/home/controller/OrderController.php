<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Details;
use app\common\model\Orders;

class OrderController extends Controller
{

    public function getinfo()
    {
        return view('orders/getinfo');
    }

    public function commit(Request $req)
    {
        session('orders.rec',$req->post('rec'));
        session('orders.tel',$req->post('tel'));
        session('orders.addr',$req->post('addr'));
        session('orders.umsg',$req->post('umsg'));
        // halt(session('cart'));
        return view('orders/commit');
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
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
        
        $oid = date('YmdHis').mt_rand(1000,9999);
        session('orders.oid',$oid);
        session('orders.user_id',session('homeUserInfo.uid'));
        session('orders.status',1);
        session('orders.create_at',time());
           
        
        try{
            $orders = Orders::create(session('orders'),true);
            $orders -> details() -> saveAll(session('cart'));
        }catch(\Exception $e){
            return $this->error('提交失败','/');
        }
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
        //
    }
}
