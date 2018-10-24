<?php
namespace app\user\model;
use think\Db;
use think\Model;

class PacClassModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];
    public function classList(){
        $where['status'] = 2;
        $res = $this->field('id,name')->where($where)->order('id', 'DESC')->select();
        return $res;
    }


}