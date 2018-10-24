<?php
namespace app\user\model;
use think\Db;
use think\Model;

class NoticeModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];
    public function get_data(){
        $where['status'] = 2;
        $res = $this->field('id,content')->where($where)->find();
        return $res;
    }


}