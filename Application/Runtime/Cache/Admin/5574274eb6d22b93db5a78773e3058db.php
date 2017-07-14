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
            <input type="hidden" name="prize_id" value="<?php echo ($info['prize_id']); ?>">
				<table class="insert-tab" width="100%">
					<tbody>
						<tr>
							<th width="120"><i class="require-red">*</i>奖品名称</th>
							<td><input class="common-text required" id="prize_name"
								name="prize_name" size="10" value="<?php echo ($info["prize_name"]); ?>" type="text"></td>
						</tr>
						<tr>
							<th><i class="require-red"></i>奖品等级：</th>
							<td><input class="common-text required" id="level"
								name="level" size="10" value="<?php echo ($info["level"]); ?>" type="text"></td>
						</tr>
                        <tr>
							<th><i class="require-red"></i>投放数量：</th>
							<td><input class="common-text required" id="number"
								name="number" size="10" value="<?php echo ($info["number"]); ?>" type="text"><span style="color:#CCC">按数量限制必填</span></td>
						</tr>
                        <tr>
							<th><i class="require-red"></i>奖品金额：</th>
							<td><input class="common-text required" id="money"
								name="money" size="10" value="<?php echo ($info['money']/100); ?>" type="text"><span style="color:#CCC">红包发放必填</span></td>
						</tr>
						<tr>
							<th><i class="require-red"></i>所属机构：</th>
							<td><select id="type_id" class="common-text required"
								name="type_id">
                                <?php if(is_array($branch_info)): $i = 0; $__LIST__ = $branch_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i): $mod = ($i % 2 );++$i;?><option value="<?php echo ($i["type_id"]); ?>"><?php echo ($i["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</section>></td>
						</tr>
						<tr>
							<th><i class="require-red"></i>所属活动：</th>
							<td><select id="act_id" class="common-text required"
								name="act_id">
                                 <option value="0">全部</option>
                                <?php if(is_array($act_info)): $i = 0; $__LIST__ = $act_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["act_id"]); ?>"><?php echo ($vo["act_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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
var prize_id="<?php echo ($info['prize_id']); ?>";
if(prize_id!=""){
$("#act_id option[value='<?php echo ($info["act_id"]); ?>']").attr("selected", true);
$("#type_id option[value='<?php echo ($info["type_id"]); ?>']").attr("selected", true);	
	}

if(prize_id!=""){
	$("input").attr("readonly",true);
	$("select").attr("disabled",true);
	$("#number").attr("readonly",false);
	$(".btn").attr("readonly",false);
	}
	function add_user(id) {
		var date = getFormJson('form');
		
		{
			$.post("<?php echo U('addPrize');?>",date,function(data,datatype){
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