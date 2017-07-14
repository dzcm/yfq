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

<div class="main-wrap">
 <!-- <div class="search-wrap">
    <div class="search-content">

    </div>
  </div>-->
  <div>
<ul class="sub-menu">
<li>
<a onclick="add()">
<i class="icon-font"></i>
添加奖品
</a>
</li>
</ul>
</div>
  <div class="result-wrap">
    <form name="myform" id="myform" method="post">
      <div class="result-title"> </div>
      <div class="result-content">
        <table class="result-tab" width="100%">
          <tr>
            <th>名称</th>
            <th>所属机构</th>
            <th>所属活动</th>
            <th>奖品金额</th>
            <th>奖品数量</th>
            <th>奖品等级</th>
            <th>操作</th>
          </tr>
          <?php if(is_array($prize_info)): $i = 0; $__LIST__ = $prize_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo ($i["prize_name"]); ?></td>
               <td><?php echo ($branch[$i['type_id']]); ?></td>
               <td><?php echo ($activity[$i['act_id']]); ?></td>
 				<td><span class="last_money_<?php echo ($i["type_id"]); ?>"><?php echo ($i['money']/100); ?></span></td>
                <td><?php echo ($i['number']); ?></td>
                <td><?php echo ($i["level"]); ?></td>
                <td><a href="#" onclick="update(<?php echo ($i["prize_id"]); ?>)">&nbsp;修改&nbsp;</a>&nbsp;|&nbsp;<a href="#" onclick="del(<?php echo ($i["prize_id"]); ?>)">&nbsp;删除&nbsp;</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="list-page">
          <ul class="pagination" >
            <li style=" float:left"> <a href="<?php echo U('index');?>?page=1">首页</a> </li>
            <?php $__FOR_START_32731__=$page;$__FOR_END_32731__=$page+4;for($i=$__FOR_START_32731__;$i < $__FOR_END_32731__;$i+=1){ if($i <= $pages) { ?>
              <li style=" float:left"> <a href="<?php echo U('index');?>?page=<?php echo ($i); ?>"><?php echo ($i); ?></a> </li>
              <?php } } ?>
            <li style=" float:left"> <a href="<?php echo U('index');?>?page=<?php echo ($pages); ?>">尾页</a> </li>
            <li style=" float:left"><a href="javascript:void(0)">当前第<?php echo ($page); ?>页,共<?php echo ($count); ?>条数据,<?php echo ($pages); ?>页</a></li>
          </ul>
        </div>
      </div>
    </form>
  </div>
</div>
<!--/main-->
</div>
</body></html>
<script>
function del(prize_id){
	$.post("<?php echo U('del');?>",{prize_id:prize_id},function(data,datatype){
				layer.msg(data.message);
					if(data.status==200){
						location.reload();
						}

			}, "json");
	}
function add(){

layer.open({
  type: 2,
  title: '添加奖品',
  shadeClose: true,
  shade: 0.8,
  area: ['500px', '500px'],
  content: "<?php echo U('addPrize');?>" //iframe的url
}); 

	}
	function update(id){

		layer.open({
 			 type: 2,
  			title: '添加',
  			shadeClose: true,
  			shade: 0.8,
  			area: ['580px', '580px'],
  			content: "<?php echo U('addPrize');?>?id="+id //iframe的url
});	
		}
</script>