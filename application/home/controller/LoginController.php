<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\User;

class LoginController extends Controller
{
    public function login()
    {
        
        return view('login/login');
    }

    public function dologin(Request $req)
    {   
        // halt($req->post());
        $uname = $req->post('uname');
        $upwd = $req->post('upwd',NULL,'md5');
        $user = User::where('uname','=',$uname)->where('upwd','=',$upwd)->find();
        // halt($user);
        if($user){
            session('homeFlag',true);
            session('homeUserInfo',$user);
            $uri = empty(session('back')) ? '/' : session('back');
            session('back',NULL);
            return $this->success('登录成功',$uri);
        }else{
            return $this->error('登录失败','/login');
        }
    }

    public function logout()
    {
        session ('homeFlag',NULL);
        return $this->success('正在退出...','/');
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
        
    }
}
