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
	<div class="topbar-wrap white">
		<div class="topbar-inner clearfix"></div>
	</div>
	<div class="container clearfix">

		<!--/sidebar-->

		<div class="result-content">
			<form id="from" onsubmit="return add_user();">
				<table class="insert-tab" width="100%">
					<tbody>
						<tr>
							<th width="120"><i class="require-red">*</i>活动机构名称：</th>
							<td><input class="common-text required" id="name"
								name="name" size="10" value="<?php echo ($info["name"]); ?>" type="text"></td>
						</tr>
						<tr>
							<th><i class="require-red"></i>投入金额：</th>
							<td><input class="common-text required" id="last_money"
								name="last_money" size="10" value="<?php echo ($info["name"]); ?>" type="text"></td>
						</tr>
						<tr>
							<th><i class="require-red"></i>奖品类型：</th>
							<td><select id="act_type" class="common-text required"
								name="act_type">
									<option value="1">已红包发放</option>
									<option value="2">其他奖品</option>
									</section>></td>
						</tr>

						<tr>
							<th></th>
							<td><input class="btn btn-primary btn6 mr10" value="添加"
								type="submit"><i class="require-red" id="message"></i></td>
						</tr>
					</tbody>

				</table>
				</from>
		</div>

		<!--/main-->
	</div>
</body>
</html>
<script src="/Public/js/com.js"></script>
<script>
	function add_user(id) {
		var date = getFormJson('form');
		
		{
			$.post("<?php echo U('addBranch');?>",date,function(data,datatype){
				layer.msg(data.message);
				if (data.status == 200) {
					parent.location.reload();
					return false;

				}
				;

			}, "json");
		}
		return false;
	}
</script>