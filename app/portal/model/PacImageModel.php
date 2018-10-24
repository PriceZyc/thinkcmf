<?php
namespace app\portal\model;
use think\Model;
class PacImageModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];

    /**
     * 关联分类表
     */
    public function aboutUser()
    {
        return $this->belongsToMany('PacClassModel', 'pac_class', 'class', 'id');
    }


    public function dataList($param)
    {
        $where = [];
        if ($param) {
            $where['class'] = $param;
        }
        $res = $this->where($where)->order('id', 'DESC')->paginate(10);
         foreach ($res as $key=>$value){
             $class = $this->aboutUser()->where('id',$value['class'])->column('name');
             $res[$key]['class']=$class[0];
         }
        return $res;
    }

    /**
     * 后台管理添加页面
     * @param array $data 页面数据
     * @return $this
     */
    public function add($url,$class)
    {
        $data['class'] = $class;
        $data['url'] = $url;
        $data['status'] = 2;
        $data['author'] = cmf_get_current_admin_id();
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $this->allowField(true)->data($data, true)->save();
        return $this;
    }

}