<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\captcha\Captcha;
use app\common\model\User;

class LoginController extends Controller
{
    public function login()
    {
        return view('login/login');
    }

    public function verify()
    {
        $config = [
            'fontSize' => 18,
            'length' =>2,
            'useNoise' =>false,
            'useCurve' =>false,
            'imageH' =>40,
        ];
        $obj = new Captcha($config);
        return $obj->entry();
    }

    public function dologin(Request $req)
    {
        $data = $req->post();
        $obj = new Captcha;
        // halt($obj);
        if( !$obj->check($data['code']) ){
            return $this->error('验证错误');
        }
        // halt($data);
        $user = User::where('uname','=',$data['uname'])->where('upwd','=',md5($data['upwd']))->find();

        if($user){
            session('adminFlag',true);
            session('adminUserInfo', $user);
            return $this->success('登录成功','/admin/user/index');
        }else{
            return $this->error('登录失败','/admin/login');
        }
    }
}
