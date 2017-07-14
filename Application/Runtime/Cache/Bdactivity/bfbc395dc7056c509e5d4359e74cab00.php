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
		<link rel="stylesheet" type="text/css" href="/Public/bdnonghang/css/index.css"/>
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
	<body class="jinnang">
		<img src="/Public/bdnonghang/images/jinone.jpg">
		<img src="/Public/bdnonghang/images/jintwo.jpg">
		<img src="/Public/bdnonghang/images/jinthree.jpg">
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