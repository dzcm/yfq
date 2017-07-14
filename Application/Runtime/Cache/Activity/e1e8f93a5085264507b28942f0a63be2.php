<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
		<head>
		<meta charset="UTF-8">
		<title>中国农业银行 张家口分行</title>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes">
		<meta name="format-detection" content="telephone=NO">
		<meta name="apple-touch-fullscreen" content="YES"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="HandheldFriendly" content="True">
		<link rel="stylesheet" type="text/css" href="/Public/nonghang/css/style.css"/>
		<script src="/Public/nonghang/js/jquery.min.js"></script>
		<script>
			(function(win,doc){
				function change(){
					doc.documentElement.style.fontSize=20/320*doc.documentElement.clientWidth+'px';
				}
				change();
				win.addEventListener('resize',change,false);
			})(window,document);
		</script>
		</head>
		<body class="hj-mess">
<div class="wap-personal">
          <div class="wap-personal-left left">
    <img src="<?php echo ($wx_info["headimgurl"]); ?>" ><span class="wap-personal-right"><?php echo ($wx_info["nickname"]); ?></span>
  </div>
          <div id="round"></div>
          <!-- <div class="wap-personal-right"><?php echo ($wx_info["nickname"]); ?></div> -->
        </div>
<div class="wap-balance">
          <div class="wap-balance-left left"><img src="/Public/nonghang/images/yue.png" class="wap-tit"></div>
          <div class="wap-balance-right"><span id="testid"><?php echo ($last_money/100); ?></span>元</div>
        </div>
<div class="wap-record">
          <div class=" "><img src="/Public/nonghang/images/jilu.png" class="wap-tit"></div>
        </div>
<div class="table table-personal">
          <div class="table-tab">
    <?php if(is_array($my_prize)): $i = 0; $__LIST__ = $my_prize;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="table-wrap">
        <div class="table-left"><?php echo (date('Y-m-d H:i',$v["add_time"])); ?></div>
        <div class="table-right">抽中<span><?php echo ($v['money']/100); ?></span>元</div>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
   
  </div>
        </div>
<div class="extract"> <span class="gz-btn btn-left left"> <img src="/Public/nonghang/images/tixian.png"> </span> <a href="javascript:history.go(-1);" class="gz-btn left"> <img src="/Public/nonghang/images/fanhui.png"> </a> </div>
<div style="height:0.5rem; clear:both"></div>
<div class="share">
          <div  class="wap-tc"> <img src="/Public/nonghang/images/btn_01.png" class="wap-tc-pic">
    <div class="wap-tc-jg"><span id="money"><?php echo ($last_money/100); ?></span>元</div>
    <p class="wap-tc-title"> 温馨提示：点击“确定”按钮后<br />
              请返回至聊天界面，关注我们的红包<br />
              消息通知哦！</p>
    <a href="#"><img src="/Public/nonghang/images/affirm.png" class="wap-tc-s3 wap-tc-sub"></a> </div>
        </div>
<div class="buzu">
          <div  class="wap-tc"> <img src="/Public/nonghang/images/buzu.png" class="wap-tc-pic">
    <div class="wap-tc-jg"><span><?php echo ($last_money/100); ?></span>元</div>
    <p class="wap-tc-title"> 温馨提示：您的红包金额累计<br />
              不足1元无法提现！<br /></p>
    <a href="#"><img src="/Public/nonghang/images/affirm.png" class="wap-tc-s3"></a> </div>
        </div>
		
	<div class="result-wrap" id="load">
		<div><img src="/Public/nonghang/images/loading.gif"><br /><br />页面加载中...</div>	   		 
	</div>
	<div class="confirm">
		<div  class="wap-tc" > 	
			<p>温馨提示：提现不领取，中奖白费力！点击提现后24小时未领取红包视为放弃领奖，红包也将被收回。提现后千万要记得返回聊天界面领取红包哦！
</p>
			<a href="#"><img src="/Public/nonghang/images/quxiaobtn.png" class="quxiao"></a>
			<a href="#"><img src="/Public/nonghang/images/affirm.png" class="queren"></a>	 		
		</div> 
	</div>
	   <style>
	   .result-wrap {position: absolute;z-index:88;height:130%;width:100%;background: rgba(0,0,0,0.8); top:0;left:0; bottom:0; right:0;}		 
		#load{display:none; text-align:center;}
		#load div{margin-top:50%; color:yellow; font-size:0.9rem;}
		#load div img{width:10%;}
		</style>
<script>
			var last_money=<?php echo ($last_money); ?>;  
			
			$('.btn-left').click(function (){	
				if(last_money<100){
					$('.confirm').hide();
					$('.buzu').show();
				}else{
					$('.confirm').show();
				}	
			})
			
			$('.quxiao').click(function (){				
				$('.confirm').hide();	
			})
			
			$('.queren').click(function (){				
				$('.confirm').hide();
				$('#load').show();
				if(last_money<100){
					$('#load').hide();					
					$('.confirm').hide();
					$('.buzu').show();
				}else{
					  $.post("<?php echo U('getRedPacket');?>",{},function(data,datatype){
					if(data.status==200){
						$('#share').html(data.date.money/100+"元");
						$('#load').hide();
						$('.share').show();
						}else{
							alert(data.message);
							}

			}, "json");
				}
				
			})
			$(".wap-tc-sub").click(function(){
				window.location.href="/Activity/Prize/myprize";
				});
			$('.wap-tc-s3').click(function (){
				$('.share').hide();
				$('.buzu').hide();
			})
		</script>
</body>
</html>
﻿<script src="http://dbwxapi.sjzdezhong.com/Js/wx/wx.js"></script>
<script>
wx_config( '<?php echo ($share["appId"]); ?>','<?php echo ($share["timestamp"]); ?>','<?php echo ($share["nonceStr"]); ?>','<?php echo ($share["signature"]); ?>');
share("掌银送好礼，抽奖嗨不停—中国农业银行张家口分行客户专享","http://yfq.duobakeji.com/Activity","http://yfq.duobakeji.com/Public/nonghang/images/share.png","掌银送好礼，抽奖嗨不停—中国农业银行张家口分行客户专享","mysuccess");
function mysuccess(){
	 $.post("/Activity/Activity/share",{},function(data,datatype){
		 
			}, "json");
	}
</script>