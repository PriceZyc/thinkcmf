<?php
namespace app\portal\controller;
use cmf\controller\AdminBaseController;
use app\portal\model\NewsModel;
use app\portal\model\NewsClassModel;
use think\Db;
class AdminNewsController extends AdminBaseController
{
    function _initialize()
    {
        header("Content-type:text/html;charset=utf-8");
        parent::_initialize();
    }

    public function index(){
        $param = $this->request->param(); //获取所有
        $new_class = trim($this->request->param('class')); //获取单个
        $keyword = trim($this->request->param('keyword')); //获取单个
        $model = new NewsModel();
        $data= $model->dataList($new_class,$keyword);
        //分类
        $class = new NewsClassModel();
        $news_class= $class->dataList();

        $this->assign('new_class', $new_class);
        $this->assign('keyword', $keyword);
        $this->assign('data', $data);
        $this->assign('news_class', $news_class);
        $this->assign('page', $data->render());
        return $this->fetch();
    }

    public function publish()
    {
        $param           = $this->request->param();
        $model = new NewsModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');
            $model->where(['id' => ['in', $ids]])->update(['status' => 1]);
            $this->success("发布成功！", '');
        }

        if (isset($param['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');
            $model->where(['id' => ['in', $ids]])->update(['status' => 0]);
            $this->success("取消发布成功！", '');
        }

    }
}