<?php
namespace app\portal\model;
use think\Model;
class NewsModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];

    /**
     * 关联分类表
     */
    public function newsclass()
    {
        return $this->belongsToMany('NewsClassModel', 'news_class', 'cid', 'id');
    }


    public function dataList($new_class,$keyword)
    {
        $where = [];
        if ($new_class) {
            $where['cid'] =$new_class;
        }
        if ($keyword) {
            $where['title'] =array('like', "%$keyword%");
        }
        $res = $this->where($where)->order('id', 'DESC')->paginate(10);
        foreach ($res as $key=>$value){
            $class = $this->newsclass()->where('id',$value['cid'])->column('name');
            $res[$key]['cover_url']=json_decode($value['cover_url'])[0];
            $res[$key]['cid']=$class[0];
            $res[$key]['create_at']=date('Y-m-d H:i:s',$value['create_at']);
        }
        return $res;
    }

}