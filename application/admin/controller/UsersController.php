<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\User;

class UsersController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $condition=[];
        if(!empty($_GET['sex'])){
            $condition[] = ['sex','=',$_GET['sex']];
        }
        if(!empty($_GET['uname'])){
            $condition[] = ['uname','like',"%{$_GET['uname']}%" ];
        }

        $users = User::where($condition)->paginate(4)->appends($_GET);
        return view('user/index',['users'=>$users]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('user/create');

    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->post();
        // print_r($data);
        if(empty($data['upwd'] ) || empty($data['reupwd'])){
            return $this->error('密码不能为空');
        }
        if($data['upwd'] !== $data['reupwd']){
            return $this->error('两次密码不一致');
        }

        $data['upwd'] = md5($data['upwd']);
        $data['regtime'] = time();

        try{
            User::create($data,true);
        }catch(\Exception $e){
            return $this->error('添加用户失败');
        }
        return $this->success('添加成功','/admin/user/create');
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
        // 获取指定ID原有的信息
        $user = User::get($id);

        // 显示到页面表单
        return view('/user/edit',['user'=>$user]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $req, $id)
    {
        // 接收数据
        $data = $req->post();
        // 更新到数据库
        try{
            User::update($data,['uid'=>$id]);   
        }catch(\Exception $e){
            return $this->error('修改失败','/admin/user/'.$id.'/edit');
        }
        return $this->success('修改成功','/admin/user/index');
        
    }
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $row = User::destroy($id);

        if($row){
            return $this->success('删除用户成功','/admin/user/index');
        }else{
            return $this->error('删除用户失败');
        }
    }
}
