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

class CeController extends HomeBaseController
{
    //十进制
  public function index(){
//      echo bindec('110011') . "<br/>";
//      echo bindec('000110011'). "<br/>";
//      echo "110011=1+2+0+0+16+32=51". "<br/>";
//      echo "51/2=25...1". "<br/>";
//      echo "25/2=12...1". "<br/>";
//      echo "12/2=6...0". "<br/>";
//      echo "6/2=3...0". "<br/>";
//      echo "3/2=1...1". "<br/>";
//
//      echo bindec('100011') . "<br/>";
//      echo "100011=1+2+0+0+0+32=35". "<br/>";
//      echo "35/2=17...1". "<br/>";
//      echo "17/2=8...1". "<br/>";
//      echo "8/2=4...0". "<br/>";
//      echo "4/2=2...0". "<br/>";
//      echo "2/2=1...0". "<br/>";
//---------------------------2个三维数组差集-----------------------------
//      $arr1 = array(
//          array('appid'=>'1111','sku'=>'aaaa'),
//          array('appid'=>'222','sku'=>'bbbb'),
//          array('appid'=>'333','sku'=>'cccc'),
//          array('appid'=>'444','sku'=>'ddd')
//      );
//      $arr2 = array(
//          array('appid'=>'1111','sku'=>'aaaa'),
//          array('appid'=>'222','sku'=>'bbbb'),
//          array('appid'=>'555','sku'=>'ee')
//      );
      //三维数组差集
     //方法一，用闭包
//      $r = array_filter($arr1, function($v) use ($arr2) { return ! in_array($v, $arr2);});
//      dump($r)."<br/>";
//      //方法二
//      foreach($arr1 as $k=>$v) if(in_array($v, $arr2)) unset($arr1[$k]);
//      dump($arr1)."<br/>";

      //三维数组交集
      //方法一，用闭包
//      foreach($arr1 as $k=>$v){
//          if(!in_array($v, $arr2)){
//              unset($arr1[$k]);
//          }
//      }
//      dump($arr1)."<br/>";

//---------------------------多维数组的差集-----------------------------
//      $array1=array(1,2,3,array(1,2,array(1)));
//      $array2=array(1,2,4,array(1,2,3));
//      $data=$this->array_diff_assoc_recursive($array1,$array2);
//      dump($data);



//    $data[] = array('volume' => 67, 'edition' => 2);
//    $data[] = array('volume' => 86, 'edition' => 1);
//    $data[] = array('volume' => 85, 'edition' => 6);
//    $data[] = array('volume' => 98, 'edition' => 2);
//    $data[] = array('volume' => 86, 'edition' => 6);
//    $data[] = array('volume' => 67, 'edition' => 7);
//
//    // 取得列的列表
//    foreach($data as $key => $row){
//        $volume[$key]  = $row['volume'];
//        $edition[$key] = $row['edition'];
//    }
//    // 将数据根据 volume 降序排列，根据 edition 升序排列
//    // 把 $data 作为最后一个参数，以通用键排序
//    array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $data);
//    dump($data);

//      --------------------打印三维数组数值-----------------------------
//      $cars = array
//      (
//          array("Volvo",33,20),
//          array("BMW",17,15),
//          array("Saab",5,2),
//          array("Land Rover",15,11)
//      );
//
//
//      for ($row=0; $row<count($cars);$row++){
//          echo "<p><b>行数 $row</b></p>";
//          echo "<ul>";
//          for ($col = 0; $col<count($cars[$row]); $col++){
//              echo "<li>".$cars[$row][$col]."</li>";
//          }
//          echo "</ul>";
//      }

//--------------------拿取数组中一列的值------------------------
//      $arr = array(
//            '0' => array('id' => 1, 'name' => 'name1','sex'=>'男'),
//            '1' => array('id' => 2, 'name' => 'name2','sex'=>'女'),
//            '2' => array('id' => 3, 'name' => 'name3','sex'=>'中'),
//            '3' => array('id' => 4, 'name' => 'name4','sex'=>'弯'),
//            '4' => array('id' => 5, 'name' => 'name5','sex'=>'直'),
//      );
      //获取选择列
//       $name_list = array_column($arr, 'name');
      //获取第一列
//      $name_list = array_map('reset', $arr);
      //获取最后一列
//      $name_list = array_map('end', $arr);
//      dump($name_list);

//-------------------一个数组，获取这个数组的所有子数组集合-------------------------
//      $arr = [1,2,3];
//      $len = count($arr);
//      $subsets = pow(2, $len);
//      $result = [];
//      for($i=0;$i<$subsets;$i++) {
//          $bits = sprintf("%0".$len."b", $i);
//          $item = [];
//          for ($j=0;$j<$len;$j++) {
//              if ($bits[$j] == '1') {
//                  $item[] = $arr[$j];
//              }
//          }
//          if (!empty($item))
//              $result[] = $item;
//      }
//      dump($result);
      // 11101001  =1+0+0+8+0+32+64+128=41+64+108=105+128=233
//      echo bindec('11101001') . "<br/>";
//      echo bindec('11101.111') . "<br/>";
      // 1+0+4+8+16=29+0.5+0.25+0.125=29.875



  }


    //多维数组的差集
    function array_diff_assoc_recursive($array1,$array2){
        $diffarray=array();
        foreach ($array1 as $key=>$value){
            //判断数组每个元素是否是数组
            if(is_array($value)){
                //判断第二个数组是否存在key
                if(!isset($array2[$key])){
                    $diffarray[$key]=$value;
                    //判断第二个数组key是否是一个数组
                }elseif(!is_array($array2[$key])){
                    $diffarray[$key]=$value;
                }else{
                    $diff=$this->array_diff_assoc_recursive($value, $array2[$key]);
                    if($diff!=false){
                        $diffarray[$key]=$diff;
                    }
                }
            }elseif(!array_key_exists($key, $array2) || $value!==$array2[$key]){
                $diffarray[$key]=$value;
            }
        }
        return $diffarray;
    }



}