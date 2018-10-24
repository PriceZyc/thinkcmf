<?php
namespace app\portal\controller;

use cmf\controller\AdminBaseController;
use app\portal\model\AboutModel;
use think\Db;

class AdminAboutController extends AdminBaseController
{
    function _initialize()
    {
        header("Content-type:text/html;charset=utf-8");
        parent::_initialize();
    }
    private function _xss_check() {
        $temp = strtoupper(urldecode(urldecode($_SERVER['REQUEST_URI'])));
        if(strpos($temp, '<') !== false || strpos($temp, '"') !== false || strpos($temp, 'CONTENT-TRANSFER-ENCODING') !== false) {
            die('您当前的访问请求当中含有非法字符,已经被系统拒绝');
        }
        return true;
    }
    function dump_r($data){
        $data =  is_array($data)?$data:json_decode(json_encode($data),true);
        echo "<pre>".print_r($data,true);die;
    }


   public function test(){
       $this->_xss_check();
       $keyword = trim($this->request->param('keyword'));
//       $list = Db::query("select title,excerpt from cmf_about where instr(title,'$keyword') > 0"); //模糊查询
       $About = new AboutModel();
       $data= $About->aboutList($keyword);
       $data_ls= Db::name('about')->where('status',2)->select();
        dump_r($data_ls);
//        $this->dump_r($data);
       echo "6*10=70B";

//       $array=array(
//           '0'=>array(
//               'id'=>1,
//               'name'=>'张飒',
//               'bt'=>array(
//                   '0'=>array(
//                       'id'=>4,
//                       'name'=>'防晒衣',
//                   ),
//                   '2'=>array(
//                       'id'=>6,
//                       'name'=>'尬物',
//                   )
//               ),
//           ),
//           '1'=>array(
//               'id'=>2,
//               'name'=>'王五',
//           )
//       );
//
//       dump($array);
//
//       print_r($array);

       // 显式指定更新数据操作
//       $user->isUpdate(true)->save(['id' => 1, 'title' => 'thinkphp']);
//       $user->isUpdate(true)->update(['id' => 1, 'title' => '测试表态']);
//       $user->where('id', 2)->update(['title' => 'thinkcmf']);

//       $list = [
//           ['id'=>1, 'title'=>'thinkphp', 'status'=>1],
//           ['id'=>2, 'title'=>'onethink', 'status'=>3]
//       ];
//       $user->saveAll($list);
//       $data=$About->where('status',2)->column('title'); // 返回数组
//       $data=$About->where('status',2)->column('title','id'); // 指定索引

       // 集体修改
//       $About->where('status','>',1)->chunk(2, function($users) {
//           foreach ($users as $user) {
//               $dapa = new AboutModel();
//               $dapa->update(['id' => $user['id'], 'title' => '测试表态']);
//           }
//       });


//       $data = [
//           ['title' => 'bar','excerpt'=>'痛呀', 'status' => 2],
//           ['title' => 'bar1','excerpt'=>'浪费掉', 'status' => 2],
//           ['title' => 'bar2','excerpt'=>'POS人', 'status' => 2]
//       ];
//       $About->insertAll($data);

//       $About->where('id', 1)->setInc('status',2,10); //增加积分
//       $About->where('id', 1)->setDec('status',1);   //减少积分
           //删除
//       db('about')->delete(5); //单个删除
//       db('about')->delete([6,7]); //多个删除
//        $About->where('id',8)->delete();
//        $About->where('id',8)->delete();
//       getLastsql// sql
//       dump($data);

   }

    public function index()
    {
        $param = $this->request->param(); //获取所有
        $keyword = trim($this->request->param('keyword')); //获取单个
        $About = new AboutModel();
        $data= $About->aboutList($keyword);
        $this->assign('keyword', $keyword);
        $this->assign('data', $data);
        $this->assign('page', $data->render());
        return $this->fetch();
    }

    public function add(){
        return $this->fetch();
    }

    public function add_post(){
        $param = $this->request->param();
        if (!empty($param['img'])) {
            $param['post']['img']=json_encode($param['img']);
        }
        if (!empty($param['image_list'])) {
            $param['post']['image_list'] = json_encode($param['image_list']);
        }
        $About = new AboutModel();
        $data= $About->add($param['post']);
        if ($data){
            $this->success('添加成功', url('AdminAbout/index'));
        }else{
            $this->error('添加失败');
        }
    }
    public function edit(){
        if ($this->request->isPost()){
            $param   = $this->request->param();
            $id= $this->request->param('id', 0, 'intval');
            if (!empty($param['img'])) {
                $param['post']['img']=json_encode($param['img']);
            }
            if (!empty($param['image_list'])) {
                $param['post']['image_list'] = json_encode($param['image_list']);
            }
            $About = new AboutModel();
            $data= $About->edit($param['post'],$id);
            if ($data){
                $this->success('修改成功', url('AdminAbout/index'));
            }else{
                $this->error('修改失败');
            }

        }else{
            $id = $this->request->param('id', 0, 'intval');
            $About = new AboutModel();
            $data= $About->where(array('id'=>$id))->find();
            $data['img']=json_decode($data['img'],true);
            $data['image_list']=json_decode($data['image_list'],true);
            $data['content']=$About->getPostContentAttr($data['content']);
            $this->assign('data', $data);
            return $this->fetch();
        }
    }



    public function publish()
    {
        $param           = $this->request->param();
        $About = new AboutModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');
            $About->where(['id' => ['in', $ids]])->update(['status' => 2]);
            $this->success("发布成功！", '');
        }

        if (isset($param['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');
            $About->where(['id' => ['in', $ids]])->update(['status' => 1]);
            $this->success("取消发布成功！", '');
        }

    }

    public function delete()
    {
        $param           = $this->request->param();
        $About = new AboutModel();
        if (isset($param['id'])) {
            $id= $this->request->param('id', 0, 'intval');
            $About->where(['id' => $id])->delete();
            $this->success("删除成功！", '');
        }
        if (isset($param['ids'])) {
            $ids= $this->request->param('ids/a');
            $About->where(['id' => ['in', $ids]])->delete();
            $this->success("删除成功！", '');
        }
    }
}