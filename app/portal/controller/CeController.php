<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;

class CeController extends HomeBaseController
{
    protected $token;
    function _initialize()
    {
        header("Content-type:text/html;charset=utf-8");
        parent::_initialize();
        $this->token = 'sb250';
    }


    public function index()
    {
        //验证手机号是否 正确
//       dump(cmf_check_mobile(14781876236));
//
//        $phone='14781876236';
    /*   dump(cmf_str_encode($phone));
       dump(cmf_get_domain());
       dump(cmf_password('123456'));
       dump(cmf_compare_password('123456',cmf_password('123456')));
       */
//        var_dump(cmf_random_string());
//        $message="123456@jb51.net";
//        $checkmail="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
//        if(preg_match($checkmail,$message)){ //匹配
//            echo 'error';die;
//        }
//        return $this->roll(100);
    }

    //冒泡排序
    function bubbleSort($arr)
    {
        $len=count($arr);
        //该层循环控制 需要冒泡的轮数
        for($i=1;$i<$len;$i++)
        { //该层循环用来控制每轮 冒出一个数 需要比较的次数
            for($k=0;$k<$len-$i;$k++)
            {
                if($arr[$k]>$arr[$k+1])
                {
                    $tmp=$arr[$k+1];
                    $arr[$k+1]=$arr[$k];
                    $arr[$k]=$tmp;
                }
            }
        }
        return $arr;
    }
    //选择排序
    function selectSort($arr) {
   //双重循环完成，外层控制轮数，内层控制比较次数
        $len=count($arr);
        for($i=0; $i<$len-1; $i++) {
            //先假设最小的值的位置
            $p = $i;
            for($j=$i+1; $j<$len; $j++) {
                //$arr[$p] 是当前已知的最小值
                if($arr[$p] > $arr[$j]) {
                    //比较，发现更小的,记录下最小值的位置；并且在下次比较时采用已知的最小值进行比较。
                    $p = $j;
                }
            }
            //已经确定了当前的最小值的位置，保存到$p中。如果发现最小值的位置与当前假设的位置$i不同，则位置互换即可。
            if($p != $i) {
                $tmp = $arr[$p];
                $arr[$p] = $arr[$i];
                $arr[$i] = $tmp;
            }
        }
        //返回最终结果
        return $arr;
    }
    //插入排序
    function insertSort($arr) {
        $len=count($arr);
        for($i=1;$i<$len; $i++){
            $tmp = $arr[$i];
            //内层循环控制，比较并插入
            for($j=$i-1;$j>=0;$j--) {
                if($tmp < $arr[$j]) {
                    //发现插入的元素要小，交换位置，将后边的元素与前面的元素互换
                    $arr[$j+1] = $arr[$j];
                    $arr[$j] = $tmp;
                } else {
                    //如果碰到不需要移动的元素，由于是已经排序好是数组，则前面的就不需要再次比较了。
                    break;
                }
            }
        }
        return $arr;
    }

    //顺序查找
    function seqSearch($arr,$toSearch)
    {
        $nCount = count($arr);
        for ($i=0; $i < $nCount; $i++) {
            if ($arr[$i] == $toSearch) {
                return $i;
            }
        }
        return -1;
    }


    public function getPhone()
    {
        $i=0;
        $deng=6;
        $zhi=($deng-1)*2-1;
        for ($m=1;$m<10;$m++){
            if ($m<$deng){
                if($m>1){
                   $i=$i+2;
                    $kong=$deng-($m+1);
                    for ($k=0;$k<$kong;$k++){
                        echo '*';
                    }
                   for ($s=0;$s<$i;$s++){
                       echo '-';
                   }
//                   echo $i;
                }else{
                    $i=1;
                    $kong=$deng-($m+1);
                    for ($k=0;$k<$kong;$k++){
                        echo '*';
                    }
                    echo '-';
//                    echo $i;
                }
            }else{
                $zhi=$zhi-2;
                $kong=($m+1)-$deng;
                for ($k=0;$k<$kong;$k++){
                    echo '*';
                }
                for ($s=0;$s<$zhi;$s++){
                    echo '-';
                }
//                echo $zhi;
            }
            echo  "<br/>";
        }



//        //接口验证时间
//      $api_time = $this->request->param('api_time', 0, 'intval');
//      $token = $this->request->param('token', 0, 'intval');
//      $date=time()-$api_time;
//      $sy=round($date/60);
//      if ($sy>5||$this->token!=$token){
//          return  json(array('status' => 1, 'msg' => '数据传输错误'));
//      }else{
//          return  json(array('status' => 1,'data'=>$token, 'msg' => '数据传输错误'));
//      }

//        $arr=array(1,43,54,62,21,66,32,78,36,76,39);
//        $data=$this->seqSearch($arr,62);
//        dump($data);
        //玲珑塔
//        $i=0;
//        for ($a=1;$a<10;$a++){
//            if($a>1){
//                $i=$i+2;
//                echo $i;
//            }else{
//                $i=1;
//                echo $i;
//            }
//            echo  "<br/>";
//        }

        //九九乘法表
//        for ($a=1;$a<10;$a++){
//            for($b=1;$b<=$a;$b++){
//                echo $a.'*'.$b.'='.$a*$b." ";
//            }
//            echo  "<br/>";
//        }
       //5人分桃多一
//        for ($i = 1; ; $i++){
//            if ($i%5 == 1) {
//                //第一个人取五分之一，还剩$t
//                $t = $i - round($i/5) - 1;
//                if($t % 5 == 1){
//                    //第二个人取五分之一，还剩$r
//                    $r = $t - round($t/5) - 1;
//                    if($r % 5 == 1){
//                        //第三个人取五分之一，还剩$s
//                        $s = $r - round($r/5) - 1;
//                        if($s % 5 == 1){
//                            //第四个人取五分之一，还剩$x
//                            $x = $s - round($s/5) - 1;
//                            if($x % 5 == 1){
//                                //第五个人取五分之一，还剩$y
//                                $y = $x - round($x/5) - 1;
//                                if ($y % 5 == 1) {
//                                    echo $i;
//                                    break;
//                                }
//                            }
//                        }
//                    }
//                }
//            }
//        }
    }

}