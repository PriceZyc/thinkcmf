<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use app\user\model\UserModel;
use think\Db;
use cmf\controller\HomeBaseController;
use think\cache\driver\Redis;
use think\cache\driver\Memcache;

class RedisController extends HomeBaseController
{
    public function index()
    {
        $redis =new Redis();   //实例化
//        $redis->set('dede','ok is good','60');
        if($redis->has('dede')){
            echo $redis->get('dede');
        }else{
            echo '缓存时间到,已失效';
        }
    }

    public function Memcache(){
        $mem =new Memcache();
        $mem->set('dede','this is good ided','60');
        if($mem->has('dede')){
            echo $mem->get('dede');
        }else{
            echo '缓存时间到,已失效';
        }
    }


}