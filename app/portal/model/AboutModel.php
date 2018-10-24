<?php
namespace app\portal\model;
use think\Model;
class AboutModel extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
//    protected $connection = array(
//        // 数据库类型
//        'type'     => 'mysql',
//        // 服务器地址
//        'hostname' => '127.0.0.1',
//        // 数据库名
//        'database' => 'thinkcmf1',
//        // 用户名
//        'username' => 'root',
//        // 密码
//        'password' => 'root',
//        // 端口
//        'hostport' => '3306',
//        // 数据库编码默认采用utf8
//        'charset'  => 'utf8mb4',
//        // 数据库表前缀
//        'prefix'   => 'thinkcmf1_',
//        "authcode" => 'ImNpgL4jMsdqGPdITS',
//    );

    /**
     * 关联分类表
     */
    public function aboutUser()
    {
        return $this->belongsToMany('AboutUserModel', 'about_user', 'adout_id', 'id');
    }



    public function aboutList($param){
        $data['user_id'] = cmf_get_current_admin_id(); //获取管理员id
        $where = [];
        if ($param){
            $where['title'] = ['like', "%$param%"];
        }
        $res = $this->where($where)->order('id', 'DESC')->paginate(10);
        foreach ($res as $key=>$value){
            $res[$key]['img']=json_decode($value['img'],true);
        }
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
        $data['create_time'] = time();
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
        $data['update_time'] = time();
        $this->where('id', $id)->update($data);
        return $this;
    }
}