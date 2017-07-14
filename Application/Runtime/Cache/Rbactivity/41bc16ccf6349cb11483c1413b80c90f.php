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
		<link rel="stylesheet" type="text/css" href="/Public/renbaoqingrenjie/css/index.css"/>
		<script src="/Public/renbaoqingrenjie/js/jquery.min.js"></script>
		
  <link href="/Public/renbaoqingrenjie/css/prompt.css" rel="stylesheet" media="all" />  
  <script src="/Public/renbaoqingrenjie/js/jquery.prompt.js"></script> 
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
		<div class="result-wrap" id="get" style="display:none">
			<div class="result-bg">
				<h1></h1>
				<p class="my_prize_name">1KG超能洗衣液</p>
			</div>
			<div class="sure-btn" id="sure">
				<img src="/Public/renbaoqingrenjie/images/sure-btn.png">
			</div>
		</div>
		<div class="result-wrap" id="my_info" style="display:none">
			<div class="result-bg" >
				<span class="ch" id="ch">×</span>
				<div class="re-txt">马上填写个人信息，查看中奖礼品！</div>
				<div class="mess-form" action="" method="">
					<div class="input-wrap">
						<div class="input-txt">姓名：</div>
						<input type="text" name="name" id="name">
					</div>
					<div class="input-wrap">
						<div class="input-txt">手机号：</div>
						<input type="text" name="phone" id="UserPhone">
					</div>
					<div class="input-wrap">
						<div class="input-txt">车牌号：</div>
						<input type="text" name="car-num" id="carnum">
					</div>
					<button class="tj-btn" type="submit" id="submit">
						<img src="/Public/renbaoqingrenjie/images/tj-btn.png">
					</button>
				</div>
			</div>
		</div>
		<script>
		/*var real_name="<?php echo ($rbuser_info); ?>";
		if(real_name==""){
			$("#my_info").css("display","block");
			}*/
		<!-- 车牌号 -->
		function isLicenseNo(str) {
			return /(^[\u4E00-\u9FA5]{1}[a-zA-Z0-9]{6}$)|(^[a-zA-Z]{2}[a-zA-Z0-9]{2}[a-zA-Z0-9\u4E00-\u9FA5]{1}[a-zA-Z0-9]{4}$)|(^[\u4E00-\u9FA5]{1}[a-zA-Z0-9]{5}[挂学警军港澳]{1}$)|(^[a-zA-Z]{2}[0-9]{5}$)|(^(08|38){1}[a-zA-Z0-9]{4}[a-zA-Z0-9挂学警军港澳]{1}$)/.test(str);
		}
		$(function(){ 
			
			$(".prizes").click(function(){
	   		$("#my_info").css("display","block");

	   		
						/*$.ajax({  
         type : "POST",  
          url : "<?php echo U('/Rbactivity/Activity');?>",  
          data : {},  
          async : false,  
          success : function(data){  
            	if(data.status==200){
						$("#get").css("display","block");
						}else{
							if(data.status==500||data.status==400){
								$.prompt("您已经参与过该活动了", 'error', 2000);
								}else{
									$.prompt(data.message, 'error', 2000);
									}
							
						}
          }  
     });*/
         
	        })
	        $("#ch").click(function(){
	   		$("#my_info").css("display","none");
	   	})
			function myprize(){
					$.ajax({  
         type : "POST",  
          url : "<?php echo U('/Rbactivity/Activity');?>",  
          data : {},  
          async : false,  
          success : function(data){  
            	if(data.status==200){
					$(".my_prize_name").html(data.date.prize_name);
						$("#get").css("display","block");
						}else{
							if(data.status==500||data.status==400){
								$.prompt("您已经参与过该活动了", 'error', 2000);
								}else{
									$.prompt(data.message, 'error', 2000);
									}
							
						}
          }  
     });
				}

	        $("#sure").click(function(){
	   		$("#get").css("display","none");
	        })

	        $("#submit").click(function(){
	        //表单验证
	        var name=$('input[name="name"]').val();
	        var phone=$('input[name="phone"]').val();
	        var carnum=$('input[name="car-num"]').val();
            //if(name=='' ){
             //   alert("请填写您的姓名!")
            //    return false;
            //  }	
			  
            //if(phone=='' ){
             //   alert("请填写您的手机号!")
            //    return false;
            //  }
			//if(carnum=='' ){
            //    alert("请填写您的车牌号!")
            //    return false;
            //  } 
			  
			  
				if($("#name").val()==''){
					$.prompt('请填写您的姓名', 'error', 2000);
					return false;
				}
					
				var tel = $("#UserPhone").val();
				if (tel == '') {
					$.prompt('请填写您的手机号', 'error', 2000);
					return false;
				}
			   var regu = /^[1][34578][0-9]{9}$/;

	           var re = new RegExp(regu);
	           if (!re.test(tel)) {
	              $.prompt('请输入正确手机号码', 'error', 2000);
	              return false;
	           }			   
			   
			   if($("#carnum").val()=='' || $("#carnum").val().length<7 || !isLicenseNo(carnum)){
					$.prompt('请输入正确的车牌号', 'error', 2000);
					return false;
		 	   }		 
			$.ajax({  
         type : "POST",  
          url : "<?php echo U('/Rbactivity/Index/addUser');?>",  
          data : {phone:tel,car_number:carnum,name:name},  
          async : false,  
          success : function(data){  
            	if(data.status==200){
						$("#my_info").css("display","none");
						 myprize();
						}else{
							$.prompt(data.message, 'error', 2000);
						}
          }  
     });
             
	        })
	        
		})
		</script>
		<img src="/Public/renbaoqingrenjie/images/title.png" class="title">
		<div class="prize-wrap">
			<div class="prizes" id="prizes"><img src="/Public/renbaoqingrenjie/images/chengnuo.png"></div>
			<div class="prizes"><img src="/Public/renbaoqingrenjie/images/zhongqing.png"></div>
			<div class="prizes"><img src="/Public/renbaoqingrenjie/images/xiangban.png"></div>
			<div class="prizes"><img src="/Public/renbaoqingrenjie/images/youni.png"></div>
			<div class="prizes"><img src="/Public/renbaoqingrenjie/images/shanmeng.png"></div>
			<div class="prizes"><img src="/Public/renbaoqingrenjie/images/xiangyi.png"></div>
			<div class="prizes"><img src="/Public/renbaoqingrenjie/images/ailian.png"></div>
			<div class="prizes"><img src="/Public/renbaoqingrenjie/images/zhaomi.png"></div>
			<div class="prizes"><img src="/Public/renbaoqingrenjie/images/bali.png"></div>
		</div>
		<img src="/Public/renbaoqingrenjie/images/rules.png" class="rule">
		<img src="/Public/renbaoqingrenjie/images/romantic.png" class="romantic">
		<img src="/Public/renbaoqingrenjie/images/prize-ths.png" class="prize-txt">
		<img src="/Public/renbaoqingrenjie/images/zhu.png" class="zhu">
		<a href="tel:4001234567" class="tel">
			<img src="/Public/renbaoqingrenjie/images/cal.png">
		</a>
		
		<img src="/Public/renbaoqingrenjie/images/bottom.png" class="bottom">
	</body>
</html>