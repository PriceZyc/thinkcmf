<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:53:"themes/admin_simpleboot3/portal\admin_news\index.html";i:1539069866;s:75:"F:\phpstudy\WWW\thinkcmf\public\themes\admin_simpleboot3\public\header.html";i:1531901242;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="/themes/admin_simpleboot3/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/admin_simpleboot3/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            APP: '<?php echo \think\Request::instance()->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="/themes/admin_simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <script src="/themes/admin_simpleboot3/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip({
                container:'body',
                html:true,
            });
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
</head>
<style>
    img{
        width: 80px!important;
    }
</style>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:;">列表</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('index'); ?>">
         分类:
        <select name="class" id="class" style="width: 150px;height: 30px">
            <option value="0">全部</option>
            <?php if(is_array($news_class) || $news_class instanceof \think\Collection || $news_class instanceof \think\Paginator): if( count($news_class)==0 ) : echo "" ;else: foreach($news_class as $key=>$vo): ?>
                <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $new_class): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
          <span style="margin-left: 20px">关键字:</span>
        <input type="text" class="form-control" name="keyword" style="width: 50%;"
               value="<?php echo (isset($keyword) && ($keyword !== '')?$keyword:''); ?>" placeholder="请输入关键字...">
        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url('index'); ?>">清空</a>
    </form>
    <form class="js-ajax-form" action="" method="post">
        <div class="table-actions">
            <button class="btn btn-primary btn-sm js-ajax-submit" type="submit"
                    data-action="<?php echo url('publish',array('yes'=>1)); ?>" data-subcheck="true" data-msg="您确定发布吗？">发布
            </button>
            <button class="btn btn-primary btn-sm js-ajax-submit" type="submit"
                    data-action="<?php echo url('publish',array('no'=>1)); ?>" data-subcheck="true" data-msg="您确定取消发布吗？">取消发布
            </button>
            <!--<button class="btn btn-danger btn-sm js-ajax-submit" type="submit"-->
                    <!--data-action="<?php echo url('delete'); ?>" data-subcheck="true" data-msg="您确定删除吗？">-->
                <!--<?php echo lang('DELETE'); ?>-->
            <!--</button>-->
        </div>
        <table class="table table-hover table-bordered table-list">
            <thead>
            <tr>
                <th width="1%">
                    <label>
                        <input type="checkbox" class="js-check-all" data-direction="x" data-checklist="js-check-x">
                    </label>
                </th>

                <th width="3%">ID</th>
                <th width="5%">分类</th>
                <th width="20%">标题</th>
                <th width="6%">图片</th>
                <th width="10%">路径</th>
                <th width="3%">状态</th>
                <th width="8%">时间</th>
            </tr>
            </thead>
            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
                <tr>
                    <td>
                        <input type="checkbox" class="js-check" data-yid="js-check-y" data-xid="js-check-x" name="ids[]"
                               value="<?php echo $vo['id']; ?>" title="ID:<?php echo $vo['id']; ?>">
                    </td>
                    <td><b><?php echo $vo['id']; ?></b></td>
                    <td><?php echo $vo['cid']; ?></td>
                    <td><?php echo $vo['title']; ?></td>
                    <td>
                        <?php if(!(empty($vo['cover_url']) || (($vo['cover_url'] instanceof \think\Collection || $vo['cover_url'] instanceof \think\Paginator ) && $vo['cover_url']->isEmpty()))): ?>
                            <a href="javascript:parent.imagePreviewDialog('<?php echo cmf_get_image_preview_url($vo['cover_url']); ?>');">
                                <img src="<?php echo cmf_get_image_preview_url($vo['cover_url']); ?>" alt="">
                                <!--<i class="fa fa-photo fa-fw"></i>-->
                            </a>
                            <?php else: ?>
                            <!--<i class="fa fa-close fa-fw"></i>-->
                        <?php endif; ?>
                    </td>
                    <td><a href="<?php echo $vo['url']; ?>" target="_Blank"><?php echo $vo['url']; ?></a></td>
                    <td>
                        <?php if($vo['status'] == 1): ?>
                            <a data-toggle="tooltip" title="已发布"><i class="fa fa-check"></i></a>
                        <?php endif; if($vo['status'] == 0): ?>
                            <a data-toggle="tooltip" title="未发布"><i class="fa fa-close"></i></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo $vo['create_at']; ?>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
    </form>
</div>
<script src="/static/js/admin.js"></script>
<script>

    function reloadPage(win) {
        win.location.reload();
    }

    $(function () {

    });
</script>
</body>
</html>