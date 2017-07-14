<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
		<head>
		<meta charset="UTF-8">
		<title>中国农业银行 保定分行</title>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes">
		<meta name="format-detection" content="telephone=NO">
		<meta name="apple-touch-fullscreen" content="YES"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="HandheldFriendly" content="True">
		<link rel="stylesheet" type="text/css" href="/Public/bdnonghang/css/style.css"/>
		<script src="/Public/bdnonghang/js/jquery.min.js"></script>
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
		<body class="bd-yfq">
<!-- 头像div	 -->
<div class="warp-personal"> <img src="<?php echo ($wx_info["headimgurl"]); ?>"  > <span><?php echo ($wx_info["nickname"]); ?></span> </div>
<!-- 余额div -->
<div class="wap-balance">
          <div class="wap-balance-left left"><img src="/Public/bdnonghang/images/yue.png" class="wap-tit"></div>
          <div class="wap-balance-right"><span id="testid"><?php echo ($last_money/100); ?></span>元</div>
        </div>

<!-- 开箱记录 -->
<div class="wap-record"> <img src="/Public/bdnonghang/images/jilu.png" class="wap-tit"> </div>

<!-- 中奖信息列表 -->
<div class="table-personal">
          <div class="table-top"> </div>
          <div class="table-tab">
          <?php if(is_array($my_prize)): $i = 0; $__LIST__ = $my_prize;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="table-wrap">
              <div class="table-left"><?php echo (date('Y-m-d H:i',$v["add_time"])); ?></div>
              <div class="table-right"><span><?php echo ($v['money']/100); ?></span>元</div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
        </div>
<!-- 底部按钮部分 -->
<div class="extract"> <span class="gz-btn btn-left left"> <img src="/Public/bdnonghang/images/tixian.png"> </span> <a href="javascript:;" class="gz-btn left"  id="fenxiang"> <img src="/Public/bdnonghang/images/dese.png"> </a> </div>
<div style="height:0.5rem; clear:both"></div>
<div class="share">
          <div  class="wap-txcg" id="shows" style=" "> <img src="/Public/bdnonghang/images/btn_01.png" class="wap-tc-pic">
    <div class="wap-tc-jg"><span id="my_money">1.5</span>元</div>
    <p class="wap-tc-title"> <img src="/Public/bdnonghang/images/jishi.png" /></p>
    <a href="#" class="wap-cg"><img src="/Public/bdnonghang/images/queding.png"></a> </div>
        </div>
<div class=" confirm">
          <div  class="wap-wenxin">
    <p> 温馨提示：提现不领取，中奖白费力！点击提现后24小时未领取红包视为放弃领奖，红包也将被收回。提现后千万要记得返回聊天界面领取红包哦！ </p>
    <div class="wenxinbtn"> <a href="#"><img src="/Public/bdnonghang/images/quxiao.png" class="quxiao"></a> <a href="#"><img src="/Public/bdnonghang/images/affirma.png" class="queren"></a> </div>
  </div>
        </div>
<div class=" buzu">
          <div class="buzu-tc"> <span class="buzu-tc3"><img src="/Public/bdnonghang/images/queding.png"></span> </div>
        </div>
<div class="result-wrap" id="load">
          <div><img src="/Public/bdnonghang/images/loading.gif"><br />
    <br />
    页面加载中...</div>
        </div>
<style>
	   .result-wrap {position: absolute;z-index:88;height:130%;width:100%;background: rgba(0,0,0,0.8); top:0;left:0; bottom:0; right:0;}		 
		#load{display:none; text-align:center;}
		#load div{margin-top:50%; color:yellow; font-size:0.9rem;}
		#load div img{width:10%;}
		.wrap-phone{
			width:100%;
			height:100%;
			background:rgba(0,0,0,0.6);
			display:none;
			position:absolute;
			top:0;
			left:0;
			bottom:0;
			right:0;
		}
		</style>
<!-- 奔走相告-分享 -->
<div class="wrap-phone" id="bzxg"> <img src="/Public/bdnonghang/images/shares.png" style="width:100%"> </div>
<!-- 奔走相告-分享 end --> 
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
						$('#my_money').html(data.date.money/100+"元");
						$('#load').hide();
						$('.share').show();
						}else{
							alert(data.message);
							}

			}, "json");
				}
				
			})
			  
			  
			$(".wap-tc-sub").click(function(){
				window.location.href="/Bdactivity/Prize/myprize";
				});
			$('.wap-cg').click(function (){
				$('.share').hide();
				$('.buzu').hide();
			})
						$(".buzu-tc3").click(function(){
				$('.buzu').hide();
				});
			$('#fenxiang').click(function () { 
            $('#bzxg').show();
        })
        $('#bzxg').click(function () {
            $(this).hide();
        })
		</script> 
<!-- <script>setTimeout("$('#load').hide()",1000);  --> 
<!-- $('.btn-left').click(function (){				  --> 
<!-- $('.share').show();	 --> 
<!-- }) --> 
<!-- $('.wap-tc-s3').click(function (){ --> 
<!-- $('.share').hide(); --> 
<!-- }) --> 

<!-- </script> -->
﻿<script src="http://dbwxapi.sjzdezhong.com/Js/wx/wx.js"></script>
<script>
wx_config( '<?php echo ($share["appId"]); ?>','<?php echo ($share["timestamp"]); ?>','<?php echo ($share["nonceStr"]); ?>','<?php echo ($share["signature"]); ?>');

share("掌银送好礼，抽奖嗨不停—中国农业保定分行客户专享","http://yfq.duobakeji.com/Bdactivity?rand=<?php echo ($rand); ?>","http://yfq.duobakeji.com/Public/bdnonghang/images/share.jpg","掌银送好礼，抽奖嗨不停—中国农业保定分行客户专享","mysuccess");
function mysuccess(){
	 $.post("/Bdactivity/Activity/share",{},function(data,datatype){
		 
			}, "json");
	}

  // 7.2 获取当前地理位置>
function dizhi(){
	getLocation("mylocation");
		
	}
	
function reconfig(){
	wx_config( '<?php echo ($share["appId"]); ?>','<?php echo ($share["timestamp"]); ?>','<?php echo ($share["nonceStr"]); ?>','<?php echo ($share["signature"]); ?>');
	}

</script>
</body>
</html>