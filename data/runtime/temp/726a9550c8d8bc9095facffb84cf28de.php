<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:53:"themes/admin_simpleboot3/admin\wx_setting\upload.html";i:1532418072;s:75:"F:\phpstudy\WWW\thinkcmf\public\themes\admin_simpleboot3\public\header.html";i:1531901242;}*/ ?>
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
<body>
<div class="wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a>微信设置</a></li>
    </ul>
    <form method="post" class="js-ajax-form margin-top-20" role="form" action="<?php echo url('uploadPost'); ?>">
        <div class="form-group">
            <label>appID</label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="appid" placeholder="请输入appID"
                           value="<?php echo (isset($upload_setting['appid']) && ($upload_setting['appid'] !== '')?$upload_setting['appid']:null); ?>">
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <p class="help-block">微信公众号唯一的 appid</p>
        </div>

        <div class="form-group">
            <label>appsecret</label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="appsecret"
                           placeholder="请输入appsecret" value="<?php echo (isset($upload_setting['appsecret']) && ($upload_setting['appsecret'] !== '')?$upload_setting['appsecret']:null); ?>">
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <p class="help-block">微信公众号唯一的 appsecret</p>
        </div>
        <div class="form-group">
            <label>mchid</label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="mchid" placeholder="请输入appID"
                           value="<?php echo (isset($upload_setting['mchid']) && ($upload_setting['mchid'] !== '')?$upload_setting['mchid']:null); ?>">
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <p class="help-block">微信公众号支付的 商户号</p>
        </div>
        <div class="form-group">
            <label>key</label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="key" placeholder="请输入appID"
                           value="<?php echo (isset($upload_setting['key']) && ($upload_setting['key'] !== '')?$upload_setting['key']:null); ?>">
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <p class="help-block">微信公众号支付的 商户支付密钥</p>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
        </div>
    </form>
</div>
<script src="/static/js/admin.js"></script>
</body>
</html>