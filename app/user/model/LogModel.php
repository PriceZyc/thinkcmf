<?php
namespace app\user\model;
use think\Db;
use think\Model;

class LogModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];
    public function add($conent)
    {
        $data['conent'] = $conent;
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $this->allowField(true)->data($data, true)->save();
        return $this;
    }


}