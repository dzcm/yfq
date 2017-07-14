<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>欢乐开宝箱 天天赢大奖</title>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes">
		<meta name="format-detection" content="telephone=NO">
		<meta name="apple-touch-fullscreen" content="YES"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="HandheldFriendly" content="True">
		<link rel="stylesheet" type="text/css" href="/Public/cdnonghang/css/index.css"/>
		<link rel="stylesheet" type="text/css" href="/Public/cdnonghang/css/style.css"/>
		<script src="/Public/cdnonghang/js/jquery.min.js"></script>
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
        <script src="http://dbwxapi.sjzdezhong.com/Js/wx/wx.js"></script>
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
        
	<div class="cd-yfq">	
		
		<div class="yfq-close"><img src="/Public/cdnonghang/images/close.png"></div>
		<!-- 头像div	 -->
		<div class="warp-personal"> 
			<img src="<?php echo ($wx_info["headimgurl"]); ?>"  >
			<span><?php echo ($wx_info["nickname"]); ?></span> 
		</div>
		<!-- 余额div -->
		<div class="wap-balance">
			<div class="wap-balance-left left"><img src="/Public/cdnonghang/images/yue.png" class="wap-tit"></div>
			<div class="wap-balance-right"><span id="testid" class="last_money"><?php echo ($last_money/100); ?></span>元</div>
		</div>
		
		<!-- 开箱记录 -->
		<div class="wap-record">
			<img src="/Public/cdnonghang/images/jilu.png" class="wap-tit">
		</div>		
		
		<!-- 中奖信息列表 -->
		<div class="table-personal">
			<div class="table-top">
			   
		    </div>
			<div class="table-tab">
          
    <!--<div class="table-wrap">
              <div class="table-left"><?php echo (date('Y-m-d H:i',$v["add_time"])); ?></div>
              <div class="table-right"><span><?php echo ($v['money']/100); ?></span>元</div>
            </div>-->

			</div>  
		</div>
		<!-- 底部按钮部分 -->
		<div class="extract">
			<span class="gz-btn btn-left left">
				<img src="/Public/cdnonghang/images/tixian.png">
			</span>
			<a href="javascript:;" class="gz-btn left"  id="fenxiang">
				<img src="/Public/cdnonghang/images/dese.png">
			</a>
		</div>
		<div style="height:2rem; clear:both"></div>  		
		
		
		<!-- 奔走相告-分享 -->
		<div class="wrap-dese" id="bzxg001">
			<img src="/Public/cdnonghang/images/shares.png" style="width:100%">
		</div>
		<!-- 奔走相告-分享 end -->
		
		<!-- 提现成功 -->
		<div class="share">
			<div  class="wap-txcg" id="shows" style=" ">
				<img src="/Public/cdnonghang/images/btn_01.png" class="wap-tc-pic">
				<div class="wap-tc-jg"><span id="my_money">1.5</span>元</div>
				<p class="wap-tc-title"> <img src="/Public/cdnonghang/images/jishi.png" /></p>
				<a href="#" class="wap-cg"><img src="/Public/cdnonghang/images/queding.png"></a>				
			</div> 
		</div>	
		<!-- 提现成功 end -->
		
		<!-- 提现提示 -->
	 	<div class=" confirm">
			<div  class="wap-wenxin">
				<div class="close01"><img src="/Public/cdnonghang/images/close.png"></div>
				<div class="tixian-pic"> 
					 <img src="/Public/cdnonghang/images/tixianwenzi.png"> 
				</div>				
				<div class="wenxinbtn"> 
					<a href="#"><img src="/Public/cdnonghang/images/quxiao.png" class="quxiao"></a>
					<a href="#"><img src="/Public/cdnonghang/images/affirma.png" class="queren"></a>
				</div>	 		
			</div> 
		</div>
		<!-- 提现提示 end -->		
	
		<!-- 提现不足 -->
		<div class=" buzu">
			<div class="buzu-tc"> 
				<span class="buzu-tc3"><img src="/Public/cdnonghang/images/queding.png"></span> 
			</div>
        </div>		
		<!-- 提现不足 end -->
		<!-- 页面加载中 -->
		<div class="result-wrap-jz" id="load">
			<div><img src="/Public/cdnonghang/images/loading.gif"><br /><br />页面加载中...</div>	   		 
		</div> 
		<!-- 页面加载中 end -->
	<script>
			var last_money=0;  
			
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
            $('#bzxg001').show();
        })
        $('#bzxg001').click(function () {
            $(this).hide();
        })
		</script> 
		  
	</div>
</html>

        <div class="jinnang" id="jinnang" style="display:none">
	    <div class="close" style="top:1.2rem" id="mlclosr"></div>
		<img src="/Public/cdnonghang/images/jinone.jpg">
		<img src="/Public/cdnonghang/images/jintwo.jpg">
		<img src="/Public/cdnonghang/images/jinthree.jpg">
</div>
	   <!--福袋结果_start-->
	   <div class="result-wrap" style="display:none" id="result">
	   	    <div class="result-blank"></div>
	   	    <div class="result">
	   	    <div class="close"></div>
	   	    	<div class="getnum">1.5</div>
	   	    <div class="result-btn-wrap">
            
	   	    	<a href="" class="srnz">
	   	    		<img src="/Public/cdnonghang/images/srnz.png">
	   	    	</a>
	   	    	<a href="javascript:;" class="bzxg" id="bzxg">
	   	    		<img src="/Public/cdnonghang/images/bzxg.png">
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
	   	    		<img src="/Public/cdnonghang/images/ok.png">
	   	    	</a>
	   	    	<a href="javascript:;" class="bzxg" id="badbzxgs">
	   	    		<img src="/Public/cdnonghang/images/fx.png">
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
	   	    		<img src="/Public/cdnonghang/images/topay.png">
	   	    	</a>
	   	    	<a href="javascript:;" class="bzxg" id="badbzxg">
	   	    		<img src="/Public/cdnonghang/images/xiangyixiang.png">
	   	    	</a>
	   	    </div>
	   	    </div>
	   </div>
	   <!--需要支付_end-->
	   <!--游戏说明_start-->
	   <div class="result-wrap" style="display:none" id="explain">
	   		<div class="sm-blank"></div>
	   		<div class="sm-wrap">
	   			<img src="/Public/cdnonghang/images/shuoming.png" class="shuoming">
	   			<a href="" class="gopay">
	   				<img src="/Public/cdnonghang/images/quzhifu.png">
	   			</a>
	   		</div>
	   </div>
	   <!--游戏说明_end-->
	   <!--分享_start-->
	   <div class="result-wrap" style="display:none" id="shares">
	   		<img src="/Public/cdnonghang/images/shares.png" class="share-img">
	   </div>
	   <!--分享_end-->
	   <!--二维码_start-->
	   <div class="result-wrap" style="display:none" id="ewm">
	   		<img src="/Public/cdnonghang/images/ewm.jpg" class="ewm-img">
	   </div>
	   <!--二维码_end-->
	   <script>
	   $(function(){
	   	//填写相应的条件,出现“福袋结果”弹框,点击分享按钮，可弹出分享弹框
	   	//if(){
	   	  //$("#result").css("display","block");
	       // }
	   	    $("#share").click(function(){
	   		$("#shares").css("display","block");
	        })

	   		$(".close,#bzxg,#badbzxgs").click(function(){
	   		$("#result,#result-bad,#need").css("display","none");
	        })

	        $("#shares").click(function(){
	   		$(this).css("display","none");
	        })

	        $("#bad-ok,#badbzxg").click(function(){
	   		$("#result-bad,#need").css("display","none");
	        })
	        $("#bzxg,#badbzxgs").click(function(){
	   		$("#shares").css("display","block");
	        })
	   })
	   </script>
	   <!--<a href="" class="hdjn">
	   		<img src="/Public/cdnonghang/images/hdjn.png">
	   </a>-->
	   <div class="blank"></div>
	   <ul class="fd-list">
	   	   <li>
	   	   		<a href="javascript:"><img src="/Public/cdnonghang/images/jin.png"></a>
	   	   </li>
	   	   <li>
	   	   		<a href="javascript:"><img src="/Public/cdnonghang/images/jin.png"></a>
	   	   </li>
	   	   <li>
	   	   		<a href="javascript:"><img src="/Public/cdnonghang/images/jin.png"></a>
	   	   </li>
	   </ul>
	   <div class="btn-wrap">
	   <!-- <?php echo U('/Cdactivity/Prize/myprize');?> -->
	   		<a href="javascript:;" class="grzx-btn">
	   			<img src="/Public/cdnonghang/images/wdbx.png">
	   		</a>
	   		<!--<a href="<?php echo U('/Cdactivity/Directions');?>" class="miji"></a>-->
	   		<a href="javascript:;" class="miji" id="miji"></a>
	   </div>
	</body>
</html>

<script>
if("<?php echo ($sub); ?>"!="1"){
	
	$(".db-weixin").css("display","block");
	}
// 抽奖
	function mylocation(res){
	  $.post("<?php echo U('/Cdactivity/Activity');?>",{'lat':res.latitude,"lon":res.longitude},function(data,datatype){
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
			}, "json");
		}

$(function(){
		   $(".fd-list li").click(function(){
					 dizhi();   
			  
			   
			/*   $.post("<?php echo U('/Cdactivity/Activity');?>",{},function(data,datatype){
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
			}, "json");*/
			   
			   });
//支付
$(".mypay").click(function(){


				$.post("<?php echo U('/Cdactivity/Pay');?>",{},function(data,datatype){
					data=data.trim();
					var info=JSON.parse(data);
					if(info.status==200){
						window.location.href=info.date.url;
						}else{
							alert(info.message);
							}﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿
			}, "text");﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿
				
				});
				
});
 

</script>
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
	        $("#mlclosr").click(function(){
	   		$("#jinnang").css("display","none");
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
		    $("#miji").click(function(){
				$("#jinnang").show();
				});
	    //填写条件,出现“游戏说明”弹框
	   	//if(){
	   	  //$("#explain").css("display","block");
	       // }
		   
		   
		   //广告
		   $(".opac").fadeOut(5000); 
		   
		   //我的宝箱
		   $(".grzx-btn").click(function(){
			   $.post("<?php echo U('/Cdactivity/Prize/myjsonprize');?>",{},function(data,datatype){

				   var mydata=$.parseJSON(data);
				   
				   last_money=mydata.last_money/100;
				   $(".table-tab").html("");
				   $(".last_money").html(last_money);
					$.each(mydata.myprize,function(k,v){
						var money=v.money/100;
						var str='    <div class="table-wrap">';
              str+='<div class="table-left">'+v.add_time+'</div>';
               str+='<div class="table-right"><span>'+money+'</span>元</div>';
             str+='</div>';
			 $(".table-tab").append(str);
						});
			}, "text");﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿
				$(".cd-yfq").css("display","block");
			});
			
			$(".yfq-close").click(function(){
				$(".cd-yfq").css("display","none");
			});
		   
	   })
	   </script>