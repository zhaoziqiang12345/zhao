<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Cate;

class CateController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // 获取数据
        $cates = Cate::orderRaw("concat(path,cid,',')")->paginate(10)->appends($_GET);
        // 遍历显示到页面
        return view('cate/index',['cates'=>$cates]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create($id=0)
    {
        // 获取类别
        $cates = Cate::orderRaw("concat(path,pid,',')")->select();


        // 显示表单
        return view('cate/create',['cates'=>$cates,'id'=>$id]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $req)
    {
        $data = $req->post();
        // dump($data);
        $pid = $data['pid'];

        if($pid==0){
            $data['path']='0,';
        }else{
            $data['path']=Cate::get($pid)->path.$pid.',';
        }

        try{
            Cate::create($data,true);
        }catch(\Exception $e){
            return $this->error('添加失败');
        }
        return $this->success('添加成功','/admin/cate/index');
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
        $cate=Cate::get($id);
        return view('cate/edit',['cate'=>$cate]);
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
        $data = $req->post();

        try{
            Cate::update($data,['cid'=>$id]);
        }catch(\Exception $e){
            return $this->error('修改失败');
        }
        return $this->success('修改成功','/admin/cate/index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $cate = Cate::where('pid','=',$id)->find();
       
        if($cate){
            return $this->error('有子类,不能删');
        }
        try{
            Cate::destroy($id);
        }catch(\Exception $e){
            return $this->error('删除失败');
        }
        return $this->success('删除成功','/admin/cate/index');
    }
}
