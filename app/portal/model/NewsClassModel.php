<?php
namespace app\portal\model;
use think\Model;
class NewsClassModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];
    public function dataList()
    {
        $where = [];
        $where['status'] =1;
        $res = $this->where($where)->order('id', 'DESC')->select();
        return $res;
    }
}