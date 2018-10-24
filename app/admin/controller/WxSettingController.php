<?php
namespace app\admin\controller;

use app\admin\model\RouteModel;
use cmf\controller\AdminBaseController;

use think\Db;

/**
 * Class SettingController
 * @package app\admin\controller
 * @adminMenuRoot(
 *     'name'   =>'微信设置',
 *     'action' =>'default',
 *     'parent' =>'',
 *     'display'=> true,
 *     'order'  => 0,
 *     'icon'   =>'cogs',
 *     'remark' =>'微信api设置入口'
 * )
 */
class WxSettingController extends AdminBaseController
{

    public function upload()
    {
        $uploadSetting = cmf_get_wx_setting();
        $this->assign('upload_setting',$uploadSetting);
        return $this->fetch();
    }

    public function uploadPost()
    {
        if ($this->request->isPost()) {
            //TODO 非空验证
            $uploadSetting = $this->request->post();
            cmf_set_option('upload_wx_setting', $uploadSetting);
            $this->success('保存成功！');
        }

    }

}