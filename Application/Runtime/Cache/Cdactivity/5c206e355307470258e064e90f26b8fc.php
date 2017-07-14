<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>中国农业银行 承德分行</title>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes">
		<meta name="format-detection" content="telephone=NO">
		<meta name="apple-touch-fullscreen" content="YES"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="HandheldFriendly" content="True">
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
	<body class="cd-yfq">	
		<!-- 头像div	 -->
		<div class="warp-personal"> 
			<img src="<?php echo ($wx_info["headimgurl"]); ?>"  >
			<span><?php echo ($wx_info["nickname"]); ?></span> 
		</div>
		<!-- 余额div -->
		<div class="wap-balance">
			<div class="wap-balance-left left"><img src="/Public/cdnonghang/images/yue.png" class="wap-tit"></div>
			<div class="wap-balance-right"><span id="testid"><?php echo ($last_money/100); ?></span>元</div>
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
				          <?php if(is_array($my_prize)): $i = 0; $__LIST__ = $my_prize;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="table-wrap">
              <div class="table-left"><?php echo (date('Y-m-d H:i',$v["add_time"])); ?></div>
              <div class="table-right"><span><?php echo ($v['money']/100); ?></span>元</div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
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
		<div class="wrap-dese" id="bzxg">
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
		<div class="result-wrap" id="load">
			<div><img src="/Public/cdnonghang/images/loading.gif"><br /><br />页面加载中...</div>	   		 
		</div> 
		<!-- 页面加载中 end -->
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
		  
	</body>
</html>