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
		<img src="/Public/nonghang/images/btn_02.png" class="wap-tit">
		<p class="introduce" style="margin-bottom:0.9rem;font-size:0.9rem;">2017年1月15日至2017年3月31 日</p>
		<img src="/Public/nonghang/images/btn_03.png" class="wap-tit">
		<p class="introduce">1、用户参与游戏需先关注张家口农行官方微信号。</p>		
		<p class="introduce">2、每人每天可通过支付一分钱获得1次抽奖机会，<br />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;分享游戏可额外获得一次抽奖机会。即每人每天<br />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;最多两次抽奖机会。</p>
		<p class="introduce">3、用户每次拆福袋得到的红包金额进行累计，大于<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;或等于1元方可进行提现，小于1元无法提现。</p>
		<p class="introduce" style="margin-bottom:0.9rem">4、活动结束后个人中心账户金额进行清零，请在活<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;动结束前进行红包领取，否则视为放弃中奖资格。</p>
		<img src="/Public/nonghang/images/btn_04.png" class="wap-tit">
		 
		<div class="table"> 
		    <div class="table-wrap">
			  <div class="table-left">一等奖</div>
			  <div class="table-right">50元红包</div>
		    </div>
		    <div class="table-wrap">
			  <div class="table-left">二等奖</div>
			  <div class="table-right">20元红包</div>
		    </div>
			<div class="table-wrap">
			  <div class="table-left">三等奖</div>
			  <div class="table-right">10元红包</div>
		    </div>			
			<div class="table-wrap">
			  <div class="table-left">四等奖</div>
			  <div class="table-right">&nbsp;&nbsp;5元红包</div>
		    </div>
			<div class="table-wrap">
			  <div class="table-left">五等奖</div>
			  <div class="table-right">&nbsp;&nbsp;2元红包</div>
		    </div>
			<div class="table-wrap">
			  <div class="table-left">六等奖</div>
			  <div class="table-right">&nbsp;&nbsp;1元红包</div>
		    </div>
			<div class="table-wrap">
			  <div class="table-left">七等奖</div>
			  <div class="table-right">0.8元红包</div>
		    </div>
			<div class="table-wrap">
			  <div class="table-left">八等奖</div>
			  <div class="table-right">0.5元红包</div>
		    </div>
			<div class="table-wrap">
			  <div class="table-left">九等奖</div>
			  <div class="table-right">0.3元红包</div>
		    </div>
			<div class="table-wrap">
			  <div class="table-left">十等奖</div>
			  <div class="table-right">0.2元红包</div>
		    </div>
		</div>
		<a href="javascript:history.go(-1);" class="gz-btn">
	    	<img src="/Public/nonghang/images/fanhui.png">
	    </a>
		<div style="height:0.5rem"></div>
	</body>
    ﻿<script src="http://dbwxapi.sjzdezhong.com/Js/wx/wx.js"></script>
<script>
wx_config( '<?php echo ($share["appId"]); ?>','<?php echo ($share["timestamp"]); ?>','<?php echo ($share["nonceStr"]); ?>','<?php echo ($share["signature"]); ?>');
share("掌银送好礼，抽奖嗨不停—中国农业银行张家口分行客户专享","http://yfq.duobakeji.com/Activity","http://yfq.duobakeji.com/Public/nonghang/images/share.png","掌银送好礼，抽奖嗨不停—中国农业银行张家口分行客户专享","mysuccess");
function mysuccess(){
	 $.post("/Activity/Activity/share",{},function(data,datatype){
		 
			}, "json");
	}
</script>
</html>