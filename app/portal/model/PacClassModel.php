<?php
namespace app\portal\model;
use think\Model;
class PacClassModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];

    public function dataList($param){
        $where = [];
        if ($param){
            $where['status'] = 2;
        }
        $res = $this->where($where)->order('id', 'DESC')->paginate(10);
        return $res;
    }


    public function classList(){
        $where['status'] = 2;
        $res = $this->where($where)->order('id', 'DESC')->select();
        return $res;
    }

    /**
     * 后台管理添加页面
     * @param array $data 页面数据
     * @return $this
     */
    public function add($data)
    {
        $data['author'] = cmf_get_current_admin_id();
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $this->allowField(true)->data($data, true)->save();
        return $this;
    }

    /**
     * 后台管理修改页面
     * @param array $data 页面数据
     * @return $this
     */
    public function edit($data,$id)
    {

        $data['author'] = cmf_get_current_admin_id();
        $data['update_time'] = date('Y-m-d H:i:s',time());
        $this->where('id', $id)->update($data);
        return $this;
    }
}