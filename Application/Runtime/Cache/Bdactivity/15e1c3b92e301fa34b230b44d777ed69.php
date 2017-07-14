<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>首页</title>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes">
		<meta name="format-detection" content="telephone=NO">
		<meta name="apple-touch-fullscreen" content="YES"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="HandheldFriendly" content="True">
		<link rel="stylesheet" type="text/css" href="/Public/bdnonghang/css/index.css"/>
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
	<body class="index">
	   <!--福袋结果_start-->
	   <div class="result-wrap" style="display:none" id="result">
	   	    <div class="result-blank"></div>
	   	    <div class="result">
	   	    <div class="close"></div>
	   	    	<div class="getnum">1.5</div>
	   	    <div class="result-btn-wrap">
	   	    	<a href="" class="srnz">
	   	    		<img src="/Public/bdnonghang/images/srnz.png">
	   	    	</a>
	   	    	<a href="javascript:;" class="bzxg" id="bzxg">
	   	    		<img src="/Public/bdnonghang/images/bzxg.png">
	   	    	</a>
	   	    </div>
	   	    </div>
	   </div>
	   <!--福袋结果_end-->
	   <!--福袋结果_未中奖_start-->
	   <div class="result-wrap" style="display:none" id="result-bad">
	   	    <div class="result-blank"></div>
	   	    <div class="result result-bad">
	   	    <div class="close"></div>
	   	    <div class="result-btn-wrap bad-result-btn">
	   	    	<a href="javascript:;" class="srnz" id="bad-ok">
	   	    		<img src="/Public/bdnonghang/images/ok.png">
	   	    	</a>
	   	    	<a href="javascript:;" class="bzxg" id="badbzxg">
	   	    		<img src="/Public/bdnonghang/images/fx.png">
	   	    	</a>
	   	    </div>
	   	    </div>
	   </div>
	   <!--福袋结果_未中奖_end-->
	    <!--需要支付_start-->
	   <div class="result-wrap" style="display:none" id="need">
	   	    <div class="result-blank"></div>
	   	    <div class="result need-pay">
	   	    <div class="close"></div>
	   	    <div class="result-btn-wrap bad-result-btn">
	   	    	<a href="javascript:;" class="srnz" id="bad-ok">
	   	    		<img src="/Public/bdnonghang/images/topay.png">
	   	    	</a>
	   	    	<a href="javascript:;" class="bzxg wzxx" id="badbzxg">
	   	    		<img src="/Public/bdnonghang/images/xiangyixiang.png">
	   	    	</a>
	   	    </div>
	   	    </div>
	   </div>
	   <!--需要支付_end-->
	   <!--游戏说明_start-->
	   <div class="result-wrap" style="display:none" id="explain">
	   		<div class="sm-blank"></div>
	   		<div class="sm-wrap">
	   			<img src="/Public/bdnonghang/images/shuoming.png" class="shuoming">
	   			<a href="" class="gopay">
	   				<img src="/Public/bdnonghang/images/quzhifu.png">
	   			</a>
	   		</div>
	   </div>
	   <!--游戏说明_end-->
	   <!--分享_start-->
	   <div class="result-wrap" style="display:none" id="shares">
	   		<img src="/Public/bdnonghang/images/shares.png" class="share-img">
	   </div>
	   <!--分享_end-->
	   <script>
	   $(function(){
	   	$("#text").click(function(){
	   		$("#result").css("display","block");
	        })
	   	//填写相应的条件,出现“福袋结果”弹框,点击分享按钮，可弹出分享弹框
	   	//if(){
	   	  //$("#result").css("display","block");
	       // }
	   	$("#share").click(function(){
	   		$("#shares").css("display","block");
	        })
	   	$("#te").click(function(){
	   		$("#result-bad").css("display","block");
	        })

	   		$(".close").click(function(){
	   		$("#result").css("display","none");
	        })
	   		$(".close").click(function(){
	   		$("#result-bad").css("display","none");
	        })
	        $(".close").click(function(){
	   		$("#need").css("display","none");
	        })

	   	
	   		$("#bzxg").click(function(){
	   		$("#result").css("display","none");
	   		$("#shares").css("display","block");
	        })
	        $("#shares").click(function(){
	   		$(this).css("display","none");
	        })

	        $("#bad-ok").click(function(){
	   		$("#result-bad").css("display","none");
	        })
	        $("#badbzxg").click(function(){
	   		$("#result-bad").css("display","none");
	   		$("#shares").css("display","block");
			
	        })
			$(".wzxx").click(function(){
				$("#need").css("display","none");
				});
	    //填写条件,出现“游戏说明”弹框
	   	//if(){
	   	  //$("#explain").css("display","block");
	       // }
	   })
	   </script>
	   <a href="<?php echo U('/Bdactivity/Directions');?>" class="hdjn">
	   		<img src="/Public/bdnonghang/images/hdjn.png">
	   </a>
	   <div class="blank"></div>
	   <ul class="fd-list">
	   	   <li>
	   	   		<a href="javascript:"><img src="/Public/bdnonghang/images/jin.png"></a>
	   	   </li>
	   	   <li>
	   	   		<a href="javascript:"><img src="/Public/bdnonghang/images/yin.png"></a>
	   	   </li>
	   	   <li>
	   	   		<a href="javascript:"><img src="/Public/bdnonghang/images/mu.png"></a>
	   	   </li>
	   </ul>
	   <div class="btn-wrap">
	   		<a href="<?php echo U('/Bdactivity/Prize/myprize');?>" class="grzx-btn">
	   			<img src="/Public/bdnonghang/images/wdbx.png">
	   		</a>
	   </div>
	</body>
</html>
<script>
// 抽奖
		   $(".fd-list li").click(function(){
			   $.post("<?php echo U('/Bdactivity/Activity');?>",{},function(data,datatype){
				   switch(data.status){
					case 400:
						 switch(data.date.code){
							case 1:
								$("#need").css("display","block");
 					 			break;
							case 2://分享
								alert(data.date.msg);
  								break;
							default:
  								alert(data.date.msg);
  								break;
							}
					
 					 	break;
					case 200:
					$(".getnum").html(data.date.money/100);					
					$("#result").css("display","block");
  							break;
					case 300:
					$("#result-bad").css("display","block");				
  							break;
					default:
  					alert(data.message);	
							}
					/*if(data.status==200){
						$('.result-txt').html(data.date.money/100+"元");
						$("#result").css("display","block");
						}
					if(data.status==300){
							alert(data.message);
							}
					if(data.status==400){
						if(data.date.code==1){
							$("#explain").css("display","block");
							}
						if(data.date.code==2){
							alert("您可通过分享获取游戏机会");
							$("#shares").css("display","block");
							}
							}
					if(data.status==500){
						$("#grab1").css("display","block");
					}*/
			}, "json");
			   
			   });
//支付
$(".srnz").click(function(){

				$.post("<?php echo U('/Bdactivity/Pay');?>",{},function(data,datatype){
					data=data.trim();
					var info=JSON.parse(data);
					if(info.status==200){
						window.location.href=info.date.url;
						}else{
							alert(info.message);
							}﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿
			}, "text");﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿
				
				});

</script>