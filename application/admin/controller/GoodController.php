<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Cate;
use think\Image;

class GoodController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $goods = Goods::with('cate')->paginate(6)->appends($_GET);

        return view('goods/index',['goods'=>$goods]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $cates = Cate::orderRaw("concat(path,cid,',')")->select();
        return view('goods/create',['cates'=>$cates]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $req)
    {
        // 接收数据
        $data = $req->post();

        // 接收上传图片，返回对象
        $file = $req->file('smallimg');
        // halt($file);
        // 把上传文件移动到指定位置  返回上传文件信息
        $info = $file->move( config('save_path') );
        // halt($info);
        // 获取上传移动后的文件名
        $fileName = $info->getSaveName();

        // 把文件名保存到$data中
        $data['gpic'] = $fileName;

        // 生成缩略图名称
        $thum_name = str_replace('\\', '/sm_', $fileName);     
        Image::open($file)->thumb(150,150)->save(config('save_path').$thum_name);

        // 添加创建时间
        $data['create_at'] = time();

        // 保存到数据库
        try{
            Goods::create($data,true);
        }catch(\Exception $e){
            return $this->error('添加失败');
        }
        return $this->success('添加成功');
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
        $goods = Goods::get($id);
        $cates = Cate::orderRaw("concat(path,cid,',')")->select();
        return view('goods/edit',['goods'=>$goods,'cates'=>$cates]);
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
        $file = $req->file('smallimg');
        if($file){
            $info = $file->move(config('save_path'));
            // halt($info);
            $fileName = $info->getSaveName();
            // halt($fileName);
            $data['gpic'] = $fileName;
            $thumb_name = str_replace('\\', '/sm_', $fileName);
            Image::open($file)->thumb(150,150)->save(config('save_path').$thumb_name);
        }
        try{
            Goods::update($data,['gid'=>$id],true);
        }catch(\Exception $e){
            return $this->error('修改失败');
        }
        return $this->success('修改成功','/admin/goods/index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        try{
            Goods::destroy($id);
        }catch(\Exception $e){
            return $this->error('删除失败');
        }
        return $this->success('删除成功','/admin/goods/index');
    }

    public function up($id,$status=1)
    {
        $data['status'] = $status;
        try{
           Goods::update($data,['gid'=>$id],true);
        }catch(\Exception $e){
            return $this->error('更改失败');
        }
        return redirect('/admin/goods/index');
            // if($row){
            //     return redirect('/admin/goods/index');
            // }else{
            //     return $this->error('失败');
            // }
    }
    public function down($id)
    {
        return $this->up($id,2);
    }
}
