<?php
namespace app\portal\controller;

use cmf\controller\AdminBaseController;
use app\portal\model\PacImageModel;
use app\portal\model\PacClassModel;
use Symfony\Component\Yaml\Dumper;
use think\Db;

class AdminPacController extends AdminBaseController
{
    function _initialize()
    {
        header("Content-type:text/html;charset=utf-8");
        parent::_initialize();
    }

    public function index(){
        $a1=array(1,2,3,4,5,6,7,10);
        $a2=array(4,5,6,7,8,9);
        $a3=array(4,5,6,7,11);
        $result=array_diff($a1,$a2,$a3);//取没有的集
//          print_r($result);
        $result1=array_intersect($a1,$a2,$a3);//取交集
//        print_r($result1);

        $param = $this->request->param(); //获取所有
        $keyword = trim($this->request->param('keyword')); //获取单个
        $class = trim($this->request->param('class')); //获取单个
        if ($keyword){
            $this->pac_url($keyword,$class);
            $this->assign('keyword', $keyword);
        }
        $model = new PacImageModel();
        $data= $model->dataList($class);
        $class_ls = new PacClassModel();
        $pac_class= $class_ls->classList();

        $this->assign('pac_class', $pac_class);
        $this->assign('data', $data);
        $this->assign('page', $data->render());
        return $this->fetch();
    }

    public function publish()
    {
        $param           = $this->request->param();
        $model = new PacImageModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');
            $model->where(['id' => ['in', $ids]])->update(['status' => 2]);
            $this->success("发布成功！", '');
        }

        if (isset($param['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');
            $model->where(['id' => ['in', $ids]])->update(['status' => 1]);
            $this->success("取消发布成功！", '');
        }

    }

    public function delete()
    {
        $param           = $this->request->param();
        $model = new PacImageModel();
        if (isset($param['id'])) {
            $id= $this->request->param('id', 0, 'intval');
            $model->where(['id' => $id])->delete();
            $this->success("删除成功！", '');
        }
        if (isset($param['ids'])) {
            $ids= $this->request->param('ids/a');
            $model->where(['id' => ['in', $ids]])->delete();
            $this->success("删除成功！", '');
        }
    }

    public function test(){
        $class=1;
        set_time_limit(0);
        /* 待抓取图片的网页地址 */
        $site_name = "https://www.baidu.com";
        $img_url = $this->get_img_url($site_name);
        $img_url_revised = $this->revise_site($site_name,$img_url);
        foreach ($img_url_revised as $key=>$value){
            $add=$this->curlDownFile($value,$key+1);
            if ($add){
                $model = new PacImageModel();
                $model->add($add,$class);
            }
        }

    }

    /*完成网页内容捕获功能*/
    function get_img_url($site_name){
        $site_fd = fopen($site_name, "r");
        $site_content = "";
        while (!feof($site_fd)) {
            $site_content .= fread($site_fd, 1024);
        }
        /*利用正则表达式得到图片链接*/
        $reg_tag = '/<img.*?\"([^\"]*(jpg|bmp|jpeg|gif)).*?>/';
        $ret = preg_match_all($reg_tag, $site_content, $match_result);
        fclose($site_fd);
        return $match_result[1];
    }

    /* 对图片链接进行修正 */
    function revise_site($site_name,$site_list){
        $base_site=explode(':',$site_name)[0];
        foreach($site_list as $site_item) {
            if (preg_match('/^http/', $site_item)) {
                $return_list[] = $site_item;
            }elseif(preg_match('/^https/', $site_item)){
                $return_list[] = $site_item;
            }else{
                $return_list[] = $base_site.':'.$site_item;
            }
        }
        return $return_list;
    }




    public function pac_url($keyword,$class){
        set_time_limit(0);
        $string=file_get_contents($keyword);
        $length=strlen($string);
        $this->searchImg($string,$length,$class);
    }





    function searchImg($string,$length,$class){
        for ($i=0; $i <$length ; $i++) {
            if(($string[$i]=='s')&&($string[$i+1]=='r')&&($string[$i+2]=='c')){
                $index=$i;
                $scr='';
                $scr=$this->searchScr($index,$length,$string);//为“http://.......***”的格式
                $type=$this->judgeType($scr);
                if($type!="error"){
//                    echo '下载中。。。。。'.$scr.'</br>';
//                    $add=$this->savePicToServer($scr,$i);
                    $add=$this->curlDownFile($scr,$i);
                    if ($add){
                        $model = new PacImageModel();
                        $model->add($add,$class);
                    }
                }

            }

        }
    }

    function judgeType($scr){
        $length=strlen($scr);
        if((($scr[$length-1]=='f'||$scr[$length-1]=='F'))&&(($scr[$length-2]=='i')||($scr[$length-2]=='I'))){
            return "gif";
        } else if ((($scr[$length-1]=='g'||$scr[$length-1]=='G'))&&(($scr[$length-2]=='P')||($scr[$length-2]=='p'))) {
            return "jpg";
        }else if((($scr[$length-1]=='g'||$scr[$length-1]=='G'))&&(($scr[$length-2]=='n')||($scr[$length-2]=='N'))){
            return "png";
        }else if((($scr[$length-1]=='g'||$scr[$length-1]=='G'))&&(($scr[$length-2]=='E')||($scr[$length-2]=='e'))){
            return "jpeg";
        }else{
            return  "error";
        }
    }

    function searchScr($index,$length,$string){
        if($string[$index+5]==="h"){
            $scr='';
        }else{
            $scr='http:';
        }
        for ($i=$index+5; $i<$length ; $i++) {
            if($string[$i]==='"'){
                break;
            }
            else{
                $scr=$scr.$string[$i];
            }
        }
        return $scr;
    }

    //远程图片下载到本地
    function curlDownFile($img_url,$i) {

        if (trim($img_url) == '') {
            return false;
        }
        $time =  date('Ymd',time());
        $image_file = "upload/pac/".$time.'/'.time() .$i. '.jpg';
        $mkdir_file = "upload/pac/".$time;
        $file="pac/".$time.'/'.time().$i . '.jpg';
        if (!file_exists($mkdir_file)){
            mkdir ($mkdir_file);
        }
        // curl下载文件
        $ch = curl_init();
        $timeout = 15;
        curl_setopt($ch, CURLOPT_URL, $img_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $img = curl_exec($ch);
        curl_close($ch);
        // 保存文件到制定路径
        file_put_contents($image_file, $img);
        unset($img, $url);
        $data=file_get_contents($image_file);
        if ($data){
            return $file;
        }else{
            unlink($image_file );
            return '';
        }

    }


    public static function savePicToServer($url,$i)
    {
        // 要存在你服务器哪个位置？
        $time =  date('Ymd',time());
        $image_file = "upload/pac/".$time.'/'.time().$i . '.jpg';
        $mkdir_file = "upload/pac/".$time;
        $file="pac/".$time.'/'.time() .$i. '.jpg';
        if (!file_exists($mkdir_file)){
            mkdir ($mkdir_file);
        }

        $targetName = $image_file;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $fp = fopen($targetName, 'wb');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        $data=file_get_contents($image_file);
        if ($data){
            return $file;
        }else{
            unlink($image_file );
            return '';
        }
    }

}