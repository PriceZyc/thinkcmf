<?php
namespace app\user\model;
use think\Db;
use think\Model;

class PacImageModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];


    public function imageList($class_id,$limit,$page){
        $where['class'] = $class_id;
        $where['status'] = 2;
        $res = $this->field('id,class,title,url')->where($where)->limit(($page-1)*$limit,$limit)->order('id', 'DESC')->select();
        foreach ($res as $key=>$value){
            $res[$key]['url']=cmf_get_image_preview_url($value['url']);
        }
        return $res;
    }

    public function get_image($id){
        $where['id'] = $id;
        $where['status'] = 2;
        $res = $this->field('id,class,title,url')->where($where)->find();
        return $res;
    }

}