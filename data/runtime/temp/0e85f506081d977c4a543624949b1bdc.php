<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"F:\phpstudy\WWW\thinkcmf\public/plugins/float_menu_lite/view/widget.html";i:1512070007;}*/ ?>
<?php if(in_array(($float_menu_switch), explode(',',"1,2"))): if($isMobile != 'true'): ?>
    <div class="fml_conct" style="right: -127px;">
      <div class="fml_bar">
        <ul>
          <li class="fml_items">
            <i class="fa fa-chevron-up fml_icons"></i>返回顶部</li>
          <?php if(!(empty($float_menu_TEL) || (($float_menu_TEL instanceof \think\Collection || $float_menu_TEL instanceof \think\Paginator ) && $float_menu_TEL->isEmpty()))): ?>
            <li class="fml_items">
              <i class="fa fa-phone-square fml_icons"></i><?php echo $float_menu_TEL; ?></li>
          <?php endif; if(!(empty($float_menu_QQ) || (($float_menu_QQ instanceof \think\Collection || $float_menu_QQ instanceof \think\Paginator ) && $float_menu_QQ->isEmpty()))): ?>
            <li class="fml_items">
              <i class="fa fa-qq fml_icons"></i>
              <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $float_menu_QQ; ?>&amp;site=qq&amp;menu=yes&amp;from=message&amp;isappinstalled=0">在线咨询</a></li>
          <?php endif; if(!(empty($float_menu_shop) || (($float_menu_shop instanceof \think\Collection || $float_menu_shop instanceof \think\Paginator ) && $float_menu_shop->isEmpty()))): ?>
            <li class="fml_items">
              <i class="fa fa-shopping-cart fml_icons"></i>
              <a target="_blank" href="<?php echo $float_menu_shop; ?>">购物商城</a></li>
          <?php endif; if(!(empty($float_menu_QR) || (($float_menu_QR instanceof \think\Collection || $float_menu_QR instanceof \think\Paginator ) && $float_menu_QR->isEmpty()))): ?>
            <li class="fml_items fml_ercode" style="height: 53px;">
              <i class="fa fa-qrcode fml_icons"></i>微信二维码
              <br>
              <img class="hd_qr" src="<?php echo cmf_get_image_url($float_menu_QR); ?>" width="100%"></li><?php endif; ?>
        </ul>
      </div>
    </div>
    <style>
	.clear:after{content:'\20';display:block;height:0;clear:both;visibility:hidden;} 
	.fml_icons{font-size: 2em;line-height: 1.8em;margin:0px 0.5em 0px 0.4em;} 
	.fml_conct{position:fixed;z-index:9999999;bottom:<?php echo (isset($float_menu_pc_bottom) && ($float_menu_pc_bottom !== '')?$float_menu_pc_bottom:'25'); ?>%;right:-127px;cursor:pointer;transition:all .3s ease;} 
	.fml_bar ul li{width:180px;height:53px;font:16px/53px 'Microsoft YaHei';color:#ffffff;margin-bottom:3px;border-radius:3px;transition:all .5s ease;overflow:hidden;} 
	.fml_bar .fml_items{background:<?php echo (isset($float_menu_color) && ($float_menu_color !== '')?$float_menu_color:'#2780E3'); ?>;} 
	.hd_qr{padding:0 29px 25px 29px;} 
	.fml_bar a{color:#FFFFFF}</style>
    <script>$(function() {
        // 悬浮窗口
        $(".fml_conct").hover(function() {
          $(".fml_conct").css("right", "5px");
          $(".fml_bar .fml_ercode").css('height', '200px');
        },
        function() {
          $(".fml_conct").css("right", "-127px");
          $(".fml_bar .fml_ercode").css('height', '53px');
        });
        // 返回顶部
        $(".fml_top").click(function() {
          $("html,body").animate({
            'scrollTop': '0px'
          },
          300)
        });
      });
      function stopss() {
        return false;
      }
      document.oncontextmenu = stopss;</script>
  <?php endif; endif; if(in_array(($float_menu_switch), explode(',',"1,3"))): if($isMobile == 'true'): ?>
    <ul id="fml_menus" data-open="收起" data-close="菜单">
      <?php if(!(empty($float_menu_TEL) || (($float_menu_TEL instanceof \think\Collection || $float_menu_TEL instanceof \think\Paginator ) && $float_menu_TEL->isEmpty()))): ?>
        <li>
          <a href="tel://<?php echo $float_menu_TEL; ?>">
            <i class="fa fa-phone-square fml_icons"></i>
          </a>
        </li>
      <?php endif; if(!(empty($float_menu_QQ) || (($float_menu_QQ instanceof \think\Collection || $float_menu_QQ instanceof \think\Paginator ) && $float_menu_QQ->isEmpty()))): ?>
        <li>
          <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $float_menu_QQ; ?>&amp;site=qq&amp;menu=yes&amp;from=message&amp;isappinstalled=0">
            <i class="fa fa-qq fml_icons"></i>
          </a>
        </li>
      <?php endif; if(!(empty($float_menu_shop) || (($float_menu_shop instanceof \think\Collection || $float_menu_shop instanceof \think\Paginator ) && $float_menu_shop->isEmpty()))): ?>
        <li>
          <a href="<?php echo $float_menu_shop; ?>">
            <i class="fa fa-shopping-cart fml_icons"></i>
          </a>
        </li>
      <?php endif; if(!(empty($float_menu_QR) || (($float_menu_QR instanceof \think\Collection || $float_menu_QR instanceof \think\Paginator ) && $float_menu_QR->isEmpty()))): ?>
        <li>
          <i class="fa fa-qrcode fml_icons"></i>
        </li>
      <?php endif; ?>
    </ul>
    <script type="text/javascript">(function() {
        var ul = $("#fml_menus"),
        li = $("#fml_menus li"),
        i = li.length,
        n = i - 1,
        r = 120;
        ul.click(function() {
          $(this).toggleClass('active');
          if ($(this).hasClass('active')) {
            for (var a = 0; a < i; a++) {
              li.eq(a).css({
                'transition-delay': "" + (50 * a) + "ms",
                '-webkit-transition-delay': "" + (50 * a) + "ms",
                '-o-transition-delay': "" + (50 * a) + "ms",
                'transform': "translate(" + ( - r * Math.cos(90 / n * a * (Math.PI / 180))) + "px," + ( - r * Math.sin(90 / n * a * (Math.PI / 180))) + "px",
                '-webkit-transform': "translate(" + ( - r * Math.cos(90 / n * a * (Math.PI / 180))) + "px," + ( - r * Math.sin(90 / n * a * (Math.PI / 180))) + "px",
                '-o-transform': "translate(" + ( - r * Math.cos(90 / n * a * (Math.PI / 180))) + "px," + ( - r * Math.sin(90 / n * a * (Math.PI / 180))) + "px",
                '-ms-transform': "translate(" + ( - r * Math.cos(90 / n * a * (Math.PI / 180))) + "px," + ( - r * Math.sin(90 / n * a * (Math.PI / 180))) + "px"
              });
            }
          } else {
            li.removeAttr('style');
          }
        });
      })($);</script>
    <style>
	.fml_icons{font-size: 40px;line-height: 60px;} 
	#fml_menus{position:fixed;right:5%;bottom:<?php echo (isset($float_menu_mobile_bottom) && ($float_menu_mobile_bottom !== '')?$float_menu_mobile_bottom:'5'); ?>%;width:60px;height:60px;line-height:60px;list-style-type:none;margin:0;padding:0;text-align:center;color:#fff;cursor:pointer;} 
	#fml_menus>li,#fml_menus:after{position:absolute;left:0;top:0;width:100%;height:100%;border-radius:50%;-webkit-border-radius:50%;background-color:<?php echo (isset($float_menu_color) && ($float_menu_color !== '')?$float_menu_color:'#2780E3'); ?>;} 
	#fml_menus>li{transition:all .6s;-webkit-transition:all .6s;-moz-transition:.6s;} 
	#fml_menus:after{content:attr(data-close);z-index:1;border-radius:50%;-webkit-border-radius:50%;} 
	#fml_menus.active:after{content:attr(data-open);} 
	#fml_menus a{width:60px;height:60px;display:inline-block;border-radius:50%;-webkit-border-radius:50%;text-decoration:none;color:#fff;font-size:0.8em;}
	</style>
	<?php endif; endif; ?>