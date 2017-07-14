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
            <input type="hidden" name="act_id" value="<?php echo ($info['act_id']); ?>">
				<table class="insert-tab" width="100%">
					<tbody>
                    						<tr>
							<th><i class="require-red"></i>所属机构：</th>
							<td><select id="type_id" class="common-text required"
								name="type_id">
                                <?php if(is_array($branch_info)): $i = 0; $__LIST__ = $branch_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i): $mod = ($i % 2 );++$i;?><option value="<?php echo ($i["type_id"]); ?>"><?php echo ($i["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select></td>
						</tr>
                                            						<tr>
							<th><i class="require-red"></i>活动城市：</th>
                          
							<td><select id="city_codes" class="common-text required"
								name="city_codes">
                                  <option value="all" selected>无限制</option>
                                <?php if(is_array($city_codes)): foreach($city_codes as $k=>$v): ?><option value="<?php echo ($k); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
									</select>
                                    <br> <span id='check_city_codes'><?php if(is_array($my_city_code)): $i = 0; $__LIST__ = $my_city_code;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><span id="one_city_code_<?php echo ($va); ?>"><input name="my_city_code[<?php echo ($va); ?>]" type="checkbox"  checked="checked" value="<?php echo ($va); ?>" /><?php echo ($city_codes[$va]); ?>&nbsp;&nbsp;&nbsp;</span><?php endforeach; endif; else: echo "" ;endif; ?> </span>
                                    </td>
						</tr>
						<tr>
							<th width="120"><i class="require-red">*</i>活动名称</th>
							<td><input class="common-text required" id="act_name"
								name="act_name" size="10" value="<?php echo ($info["act_name"]); ?>" type="text"></td>
						</tr>
						<tr>
							<th><i class="require-red"></i>开始时间：</th>
							<td><input class="common-text required layer_date"  id="start_time"
								name="start_time" size="10" value="<?php echo (date("Y-m-d",$info["start_time"])); ?>" onFocus="this.value=''" type="text"></td>
						</tr>
                        						<tr>
							<th><i class="require-red"></i>结束时间：</th>
							<td><input class="common-text required layer_date"  id="end_time"
								name="end_time" size="10" value="<?php echo (date("Y-m-d",$info["end_time"])); ?>" onFocus="this.value=''" type="text"></td>
						</tr>
                        <tr>
							<th><i class="require-red"></i>可无条件参加：</th>
							<td><input class="common-text required" id="free_times"
								name="free_times" size="10" value="<?php echo ($info["free_times"]); ?>" type="number"><span style="color:#666"></span></td>
						</tr>
                        <tr>
							<th><i class="require-red"></i>可支付参加：</th>
							<td><input class="common-text required" id="pay_times"
								name="pay_times" size="10" value="<?php echo ($info['pay_times']); ?>" type="number"><span style="color:#666">单次支付可获取活动次数</span></td>
						</tr>
                                                <tr>
							<th><i class="require-red"></i>最低支付金额：</th>
							<td><input class="common-text required" id="pay_money"
								name="pay_money" size="10" value="<?php echo ($info['pay_money']/100); ?>" type="text"><span style="color:#666"></span></td>
						</tr>
                                                                        <tr>
							<th><i class="require-red"></i>有效支付次数：</th>
							<td><input class="common-text required" id="valid_pay_num"
								name="valid_pay_num" size="10" value="<?php echo ($info['valid_pay_num']); ?>" type="number"><span style="color:#666">单天有效的支付获取活动机会的次数</span></td>
						</tr>
                                                                                                <tr>
							<th><i class="require-red"></i>可分享参加：</th>
							<td><input class="common-text required" id="share_times"
								name="share_times" size="10" value="<?php echo ($info['share_times']); ?>" type="number"><span style="color:#666">单次分享可获取次数</span></td>
						</tr>
                        							<th><i class="require-red"></i>有效分享次数：</th>
							<td><input class="common-text required" id="valid_share_num"
								name="valid_share_num" size="10" value="<?php echo ($info['valid_share_num']); ?>" type="number"><span style="color:#666">单天有效分享的次数</span></td>
						</tr>
                                                							<th><i class="require-red"></i>奖品分布比例：</th>
							<td class='all_prize_info'></td>
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
/*选择活动城市*/
$("#city_codes").change(function(){
	var val=$("#city_codes").val();
	if(val=='all'){
		$("#check_city_codes").html('');
		}else{
			$("#one_city_code_"+val).remove();
			var city_name=$("#city_codes").find("option:selected").text();
			var str='<span id="one_city_code_'+val+'"><input name="my_city_code['+val+']" type="checkbox"  checked="checked" value="'+val+'" />'+city_name+'&nbsp;&nbsp;&nbsp;</span>';
			$("#check_city_codes").append(str);
			$(this).css("readonly","readonly");
			
			}
	
	});

/*选择活动城市end*/



var act_id="<?php echo ($info['act_id']); ?>";
if(act_id!=""){
	$("#type_id option[value='<?php echo ($info["type_id"]); ?>']").attr("selected", true);
	get_prize();	
	}


var prize_ratio='<?php echo ($info["prize_ratio"]); ?>';
if(prize_ratio!=""){
	$.each($.parseJSON(prize_ratio),function(key,val){

		$("#prize_ratio_"+key).val(val);
		});
	}
$("#type_id").change(function (){
	get_prize();
	});
function get_prize(){
	type_id="<?php echo ($info['act_id']); ?>";
		$.ajax({  
         type : "POST",  
          url : "<?php echo U('/Admin/Prize/getPrize');?>",  
          data : {act_id:type_id},  
          async : false,  
          success : function(data){  
            					if(data.status!=200){
						layer.msg(data.message);
						}else{
							var str="";
						$.each(data.date,function(key,val){
							str+=val.prize_name+' : <input class="common-text required" id="prize_ratio_'+val.prize_id+'" name="prize_ratio['+val.prize_id+']" size="10" value="0" type="number"><br>';
							});
							$('.all_prize_info').html(str);	
							
						}
          }  
     }); 
}
$("#type_id option[value='<?php echo ($info["type_id"]); ?>']").attr("selected", true);
	function add_user() {
		var date = getFormJson('form');
		
		{
			$.post("<?php echo U('addActUp');?>",date,function(data,datatype){
				layer.msg(data.message);
				if (data.status == 200) {
					parent.location.reload();
					return false;

				}

				return false;

			}, "json");
		}
		return false;
	}
</script>