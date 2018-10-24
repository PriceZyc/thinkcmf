<?php
namespace app\user\controller;
use app\user\model\PacClassModel;
use app\user\model\PacImageModel;
use app\user\model\NoticeModel;
use app\user\model\WxuserinfoModel;
use cmf\controller\HomeBaseController;
use think\Db;
class ImageController extends HomeBaseController
{

    //获取用户openid
    function reg(){
        $js_code= $this->request->param("code");
        if(empty($js_code)) return json('缺少js_code');

        $appid = 'wx777a3755f34414eb';
        $appsecret = '5f5ff8d85f6f16267e394b8c1e385e7d';
        $curl = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'%s&secret='.$appsecret.'%s&js_code='.$js_code.'%s&grant_type=authorization_code';
        $result = $this->http_curl($curl);
        return json($result);
    }
    /*
    * curl
    */
    public function http_curl($url, $data = array(), $method = "get", $returnType = "json")
    {
        //1.开启会话
        $ch = curl_init();
        //2.设置参数

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($method != "get") {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        //执行会话
        $json = curl_exec($ch);
        curl_close($ch);
        if ($returnType == "json") {
            return json_decode($json, true);
        }
        return $json;
    }

   //更新用户
    public function set_userinfo(){
        $param = $this->request->param(); //获取所有
        $WxuserinfModel = new WxuserinfoModel();
        $openid= $this->request->param("openid");
        if (!$openid){
            return ' ';
        }
        $data = $WxuserinfModel->add($param,$openid);
        if ($data) {
            return json($data);
        }else{
            return ' ';
        }
    }


   //图片分类
    public function classlist()
    {
        $userModel = new PacClassModel();
        $data = $userModel->classList();
        if ($data) {
            return json($data);
        }else{
            return ' ';
        }
    }

    //图片展示
    public function getclassimg(){
        $class_id= $this->request->param("class_id", 0, "intval");
        $limit= $this->request->param("limit", 0, "intval");
        $page= $this->request->param("page", 0, "intval");
        $PacImageModel = new PacImageModel();
        $data = $PacImageModel->imageList($class_id,$limit,$page);
        if ($data) {
            return json($data);
        }else{
            return ' ';
        }

    }

    //公告
    public function get_notice(){
        $NoticeModel = new NoticeModel();
        $data = $NoticeModel->get_data();
        if ($data) {
            return json($data);
        }else{
            return ' ';
        }
    }

    //图片详情
    public function imgage_details(){
        $id= $this->request->param("id", 0, "intval");
        $PacImageModel = new PacImageModel();
        $data = $PacImageModel->get_image($id);
        if ($data) {
            return json($data);
        }else{
            return ' ';
        }
    }

}