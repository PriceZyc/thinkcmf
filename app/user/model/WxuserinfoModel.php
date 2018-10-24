<?php
namespace app\user\model;
use think\Db;
use think\Model;

class WxuserinfoModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];
    public function classList(){
        $where['status'] = 2;
        $res = $this->field('id,name')->where($where)->order('id', 'DESC')->select();
        return $res;
    }
    public function getUser($openid){
        $where['openid'] = $openid;
        $res = $this->where($where)->find();
        return $res;
    }
    public function add($param,$openid){
        $where['openid'] = $openid;
        $res = $this->where($where)->find();
        if ($res){
            $data['nickname'] = $param['nickname'];
            $data['city'] = $param['city'];
            $data['province'] = $param['province'];
            $data['avatarurl'] = $param['avatarurl'];
            $data['last_time'] = date('Y-m-d H:i:s',time());
            $this->where('openid', $openid)->update($data);
        }else{
            $param['add_time'] = date('Y-m-d H:i:s',time());
            $param['last_time'] = date('Y-m-d H:i:s',time());
            $this->allowField(true)->data($param, true)->save();
        }
        return $this;
    }


}