<?php if (!defined('THINK_PATH')) exit();?> <!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
          <script src="/Public/js/jquery.js"></script>
      <script  src="/Public/js/layer/layer.js"></script>
            <script  src="/Public/js/laydate/laydate.js"></script>
                        <script  src="/Public/js/com.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
    <script type="text/javascript" src="/Public/js/libs/modernizr.min.js"></script>
    <!--报表-->
 <script language=JavaScript type=text/javascript src="/Public/js/jqplot/jquery.jqplot.min.js"></script>  
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/examples/syntaxhighlighter/scripts/shCore.min.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/examples/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/examples/syntaxhighlighter/scripts/shBrushXml.min.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.logAxisRenderer.min.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>  
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.barRenderer.min.js"></script>  
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>  
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>  
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script> 
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.cursor.min.js"></script> 
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.highlighter.min.js"></script> 
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.highlighter.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.dragable.min.js"></script>   
<script language=JavaScript type=text/javascript src="/Public/js/jqplot/plugins/jqplot.trendline.min.js"></script>   

<script type="text/javascript" src="/Public/js/jqplot/plugins/jqplot.categoryAxisRenderer.js" ></script>  
<link class=include rel=stylesheet type=text/css href="/Public/js/jqplot/jquery.jqplot.min.css" />
<script type="text/javascript" src="/Public/js/jqplot/plugins/jqplot.highlighter.js" ></script>  
<link type=text/css rel=stylesheet href="/Public/js/jqplot/examples/syntaxhighlighter/styles/shCoreDefault.min.css" />
<link type=text/css rel=stylesheet href="/Public/js/jqplot/examples/syntaxhighlighter/styles/shThemejqPlot.min.css" /> 
<script language=JavaScript type=text/javascript src="/Public/js/m_jqplot.js"></script> 
</head>
<body>

<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                    	<li><a href="/Admin/Branch"><i class="icon-font">&#xe008;</i>活动机构</a></li>
                        <li><a href="/Admin/Prize"><i class="icon-font">&#xe008;</i>奖品管理</a></li>
                        <li><a href="/Admin/Activity"><i class="icon-font">&#xe008;</i>活动设置</a></li>
                    </ul>
                </li>
                                <li>
                    <a href="/Admin/Prizereport"><i class="icon-font">&#xe003;</i>报表</a>
                    <ul class="sub-menu">
                              <?php if(is_array($branch_info)): $i = 0; $__LIST__ = $branch_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i): $mod = ($i % 2 );++$i;?><li><a href="/Admin/Prizereport?type_id=<?php echo ($i["type_id"]); ?>"><i class="icon-font">&#xe008;</i><?php echo ($i["name"]); ?>报表</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
               
            </ul>
        </div>
    </div>
      <div class="crumb-wrap">
    <div class="crumb-list" style="position: relative;"><i class="icon-font"></i><a href="index.html" color="#white">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"></span><a style="position: absolute;right: 5%;" href="" color="#white" onClick="login_out()">退出</a></div>
  </div>

<!--/sidebar-->

<div
	style="width: 50%; margin-left: 20%; height: 50px; margin-top: 20px">
	<div class="report_list_1 report_meau"
		style="font-size: 20px; width: 150px; float: left; text-align: center">
		<a href="#" onclick="change(1)"> <i class="icon-font"></i> 今日报表
		</a>
	</div>
	<div class="report_list_2 report_meau"
		style="font-size: 20px; width: 150px; float: left; text-align: center; margin: 0 auto;">
		<a href="#" onclick="change(2)"> <i class="icon-font"></i> 周报表
		</a>
	</div>

	<div class="report_list_3 report_meau"
		style="font-size: 20px; width: 150px; float: left; text-align: center">
		<a href="#" onclick="change(3)"> <i class="icon-font"></i> 昨日报表
		</a>
	</div>
	<div class="report_list_4 report_meau"
		style="font-size: 20px; width: 200px; float: left; text-align: center">
		<a href="#" onclick="change(4)"> <i class="icon-font"></i>
			单日奖品周报表
		</a>
	</div>
</div>
<div class="main-wrap">
	<div class="search-wrap">
		<div class="search-content" style="margin-left: 80%; width: 10%">
			<a href="/Admin/Prizereport/gameReport?type=1">详情导出</a>
		</div>
	</div>
	<div class="result-wrap" id="prize_use"
		style="width: 90%; height: 800px"></div>
</div>
<!--/main-->
</div>
</body>
</html>
<script type="text/javascript">
	var data =<?php echo ($prize_use_info["val"]); ?>;
	var data_max = <?php echo ($prize_use_info["max_num"]); ?>; //Y轴最大刻度
	var line_title = <?php echo ($prize_use_info["prize_name"]); ?>; //曲线名称
	var y_label = "个数"; //Y轴标题
	var x_label = "日期"; //X轴标题
	var x = <?php echo ($prize_use_info["x_title"]); ?>; //定义X轴刻度值
	var title = "一周各进项领取情况"; //统计图标标题

	
	change(2);
	function change(id){
		$(".result-wrap").html("");
		$(".search-wrap").css("display","none");
		$('.report_meau').css("background-color","#fff");
		$('.report_list_'+id).css("background-color","#ccc");
		if(id==2){
			j.jqplot.diagram.base("prize_use", data, line_title, title, x, x_label, y_label, data_max, 1);
			}
		if(id==1){
			$(".search-wrap a").attr("href","/Admin/Prizereport/gameReport?type=1&type_id=<?php echo ($type_id); ?>");
				$(".search-wrap").css("display","block");
				var today_date=[<?php echo ($today_prize_info["number"]); ?>,<?php echo ($today_prize_info["use_num"]); ?>];
			j.jqplot.diagram.base("prize_use", today_date, ['总投放','已领取'], "今日奖品统计表", <?php echo ($today_prize_info["prize_name"]); ?>, "奖品名称", y_label, <?php echo ($today_prize_info["max_num"]); ?>, 2);
				
			
			}
		if(id==3){
			$(".search-wrap a").attr("href","/Admin/Prizereport/gameReport?type=2&type_id=<?php echo ($type_id); ?>");
				$(".search-wrap").css("display","block");
				var yest_number=<?php echo ($yestday_prize_info["number"]); ?>;
				
				var yest_use_num=<?php echo ($yestday_prize_info["use_num"]); ?>;
				
				var yest_prize_name=<?php echo ($yestday_prize_info["prize_name"]); ?>;
				
				var yest_max_num=<?php echo ($yestday_prize_info["max_num"]); ?>;


				var yestday_prize_info=[yest_number,yest_use_num];
			j.jqplot.diagram.base("prize_use", yestday_prize_info, ['总投放','已领取'], "昨日奖品统计表", yest_prize_name, "奖品名称", y_label, yest_max_num, 2);
				
			
			}
		if(id==4){
			j.jqplot.diagram.base("prize_use",[ <?php echo ($prize_day_totle["val"]); ?>],["奖品总数"], "单日奖品总数周报表", <?php echo ($date_list); ?>, "个数","日期",<?php echo ($prize_day_totle["max"]); ?>, 1);
			}
		}
	
	

</script>