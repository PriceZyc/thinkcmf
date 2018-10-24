<?php
namespace app\portal\controller;

use cmf\controller\AdminBaseController;
use app\portal\model\PacClassModel;
use think\Db;

class AdminPacClassController extends AdminBaseController
{
    function _initialize()
    {
        header("Content-type:text/html;charset=utf-8");
        parent::_initialize();
    }

    public function index(){

        $param = $this->request->param(); //获取所有
        $keyword = trim($this->request->param('keyword')); //获取单个
        $model = new PacClassModel();
        $data= $model->dataList($keyword);

        $this->assign('keyword', $keyword);
        $this->assign('data', $data);
        $this->assign('page', $data->render());
        return $this->fetch();
    }

    public function add(){
        if ($this->request->isPost()){
            $param = $this->request->param();
            $model = new PacClassModel();
            $data= $model->add($param['post']);
            if ($data){
                $this->success('添加成功', url('index'));
            }else{
                $this->error('添加失败');
            }
        }else{
            return $this->fetch();
        }
    }

    public function edit(){
        if ($this->request->isPost()){
            $param   = $this->request->param();
            $id= $this->request->param('id', 0, 'intval');
            $model = new PacClassModel();
            $data= $model->edit($param['post'],$id);
            if ($data){
                $this->success('修改成功', url('index'));
            }else{
                $this->error('修改失败');
            }

        }else{
            $id = $this->request->param('id', 0, 'intval');
            $model = new PacClassModel();
            $data= $model->where(array('id'=>$id))->find();
            $this->assign('data', $data);
            return $this->fetch();
        }
    }


    public function publish()
    {
        $param           = $this->request->param();
        $model = new PacClassModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');
            $model->where(['id' => ['in', $ids]])->update(['status' => 2]);
            $this->success("发布成功！", '');
        }

        if (isset($param['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');
            $model->where(['id' => ['in', $ids]])->update(['status' => 1]);
            $this->success("取消发布成功！", '');
        }

    }

    public function delete()
    {
        $param           = $this->request->param();
        $model = new PacClassModel();
        if (isset($param['id'])) {
            $id= $this->request->param('id', 0, 'intval');
            $model->where(['id' => $id])->delete();
            $this->success("删除成功！", '');
        }
        if (isset($param['ids'])) {
            $ids= $this->request->param('ids/a');
            $model->where(['id' => ['in', $ids]])->delete();
            $this->success("删除成功！", '');
        }
    }
}