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

class TestController extends HomeBaseController
{

    // okamigo  621226 36020 91 48 66 54
    /**
     * 前台用户首页(公开)
     */
    public function index()
    {
        $keywordComplex=[];
        if (!empty($request['keyword'])) {
            $keyword = $request['keyword'];
            $keywordComplex['title|excerpt']    = ['like', "%$keyword%"];
        }
        $id   = $this->request->param("id", 0, "intval");
        $where['id']=$id;
        //查询 单条数据中的一个字段
        $about = Db::name('about')->where($where)->value('id');
        //查询 单条数据
        $about1 = Db::name('about')->whereOr($keywordComplex)->where('id', $id)->find();
        //多数据查询
        $comments =Db::name('about')->where(['author' => cmf_get_current_user_id(), 'id' => 3])->order('id desc')->find();
       // 表内查询
        $lists = Db::name('third_party_user')->field('a.*,u.user_nickname,u.sex,u.avatar')->alias('a')->join('__USER__ u', 'a.user_id = u.id')->where("status", 1)->order("create_time DESC")->select();
         //in 方法的使用
        $in=Db::name('about')->where(['id' => ['in', $id]])->select();
        dump($in);
        // 114
    }

    public function pay(){
        $info = Db::name('news')->field('title')->limit(10)->select();
        dump($info);
    }

    /**
     * 获取搜索关键字
     */
    function key_world(){
        $data = Db::name('keyword')->field('name,cid')->select();
        return $data;
    }
    function _curl($type){
        $_api_key = 'BAgDRd6xzP7RD3pUjRKnfNSRczko16e7tLoWHHk226gXoKY5AVG1ONCSQGrmizsw';
        $url = [
            '360'=>'http://api01.bitspaceman.com:8000/news/qihoo?apikey=',//360新闻
        ];
        return $url[$type].$_api_key.'&';
    }
    public function test(){
        set_time_limit(0);
        $t1=time();
        $key_world = $this->key_world();
        foreach ($key_world as $key=>$val){
            $kw = $val['name'];
            $url = $this->_curl('360')."&kw={$kw}&pageToken=";
            //获取页码
            $is_page= Db::name('news_log')->field('page')->where(['class'=>$val['cid']])->order('id desc')->find();
            if (!$is_page){
                $is_page['page']=1;
            }
            $this->http_curl($url,$is_page['page'],$val['cid']);
        }
        echo '获取新闻成功==总耗时:'.(time()-$t1)."\r\n";
    }

    /**
     * @param $old_id
     * @param $from_id
     * @return array|false|null|\PDOStatement|string|\think\Model
     * 查询新闻是否存在
     */
    function if_his($old_id,$from_id){
        $info = Db::name('news')->where(['old_id'=>$old_id,'from_id'=>$from_id])->find();
        return $info;
    }
    /**
     * @param $data
     * @param int $from_id 1头条  2、360新闻
     * 添加数据
     */
    function add_news($data,$from_id=1,$page,$class){
        //判断页码
        $is_page= Db::name('news_log')->where(['page'=>$page,'class'=>$class])->find();
       if ($is_page){
           return true;
       }else{
           foreach ($data as $key=>$val){
               $his = $this->if_his($val['old_id'],$from_id);
               if($his) unset($data[$key]);
           }
           $insert = Db::name('news')->insertAll($data);
           if ($insert){
               $array['class']=$class;
               $array['page']=$page;
               Db::name('news_log')->insert($array);
           }
       }
        return true;
    }



    /**
     * 请求
     */
    function http_curl($url,$page,$cid){
        $_url = $url.$page;
        $request = $this->http_get($_url);
        $request = json_decode($request,true);
        if($request && isset($request['data'])){
            $arr = [];
            foreach ($request['data'] as $k=>$v){
                $data = [
                    'url'=>$v['url'],
                    'title'=>$v['title'],
                    'from_id'=>2,
                    'old_id'=>$v['id'],
                    'cover_url'=>$v['imageUrls']?json_encode($v['imageUrls']):'',
                    'content'=>$v['content'],
                    'create_at'=>time(),
                    'cid'=>$cid
                ];
                $arr[] = $data;
            }
            //添加到新闻
            $this->add_news($arr,2,$page,$cid);
            //判断是否还能下一页
            $page = (intval($page)+1);
            return isset($request['hasNext']) && $request['hasNext']?$this->http_curl($url,$page,$cid):'';
        }else{
            //
            if ($request['retcode']=='100703'){
                //并发达到上限
                //隔2s 继续调用
                sleep(2);
                return $this->http_curl($url,$page,$cid);
            }
        }
    }


//    function http_curl($url,$page=1,$cid){
//        $_url = $url.$page;
//        $request = $this->http_get($_url);
//        $request = json_decode($request,true);
//        if($request && isset($request['data'])){
//            $arr = [];
//            foreach ($request['data'] as $k=>$v){
//                $data = [
//                    'url'=>$v['url'],
//                    'title'=>$v['title'],
//                    'from_id'=>2,
//                    'old_id'=>$v['id'],
//                    'cover_url'=>$v['imageUrls']?json_encode($v['imageUrls']):'',
//                    'content'=>$v['content'],
//                    'create_at'=>time(),
//                    'cid'=>$cid
//                ];
//                $arr[] = $data;
//            }
//            //添加到新闻
//            $this->add_news($arr,2);
//            //判断是否还能下一页
//            $page = (intval($page)+1);
//            return isset($request['hasNext']) && $request['hasNext']?$this->http_curl($url,$page,$cid):'';
//        }else{
//            //
//            if ($request['retcode']=='100703'){
//                //并发达到上限
//                //隔2s 继续调用
//                sleep(3);
//                return $this->http_curl($url,$page,$cid);
//            }
//        }
//    }

    function http_get($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }

}