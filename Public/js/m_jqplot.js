/***
 *	作者：DevilJie 
 *	创建时间：2014-11-05
 *	个人网站：http://www.w3210.com
 **/
var j = {jqplot :{}};
j.jqplot.diagram = {
	/**
	 * document: 输出图形的位置id
	 * s：柱状图数据 例如：[[1,2,3,4]]单柱状图  [[1,2,3,4],[2,3,4,5]] 双柱状图 以此类推
	 * title：每一个柱状对应的名称 ["参加人数","中奖人数"]
	 * ticks:x轴显示数据例如[1,2,3,4,5,6,7,8]
	 * x_label:x轴名称
	 * y_label:y轴名称
	 * t: 1：曲线图 2：柱状图
	 */
	base : function(document, s, xtitle, title, ticks, x_label, y_label, max, t){
		var renderer;
		if(t == 1) renderer = $.jqplot.BlockRenderer ;
		else if(t == 2) renderer = $.jqplot.BarRenderer ;
        var plot3 = $.jqplot(document, s, {
        	title: title,
			legend:{show:true,labels: xtitle},
			animate:true,
			seriesDefaults: {  
               renderer: renderer, // 利用渲染器（BarRenderer）渲染现有图表  
               pointLabels: { show: true } ,
			   lineWidth: 1,
			   dragable: {
color: undefined, // 当拖动数据点是，拖动线与拖动数据点颜色
constrainTo: 'none', //设置拖动的的范围: 'x'（只能在横向上拖动）,
// 'y'（只能在纵向上拖动）, or 'none'（无限制）.
}, 
            },
			markerOptions: {
				isDragable: true,
				},
			axes:{
				yaxis:{
            		label: y_label==null?"":y_label,
            		max:max
				},
				xaxis:{
					renderer: $.jqplot.CategoryAxisRenderer, // 设置横（纵）轴上数据加载的渲染器,
					ticks: ticks,
                	label: x_label==null?"":x_label
				}
			}, 
			series:[{color:'#5FAB78'}],
			
			highlighter: {
      show: true,
	  sizeAdjust: 15,
	  tooltipAxes: 'y',
    	yvalues: 1,
		 useAxesFormatters: true 

    },
    cursor: {
		style: 'crosshair',
      // 显示光标，光标默认为十字
      show: true,
      // 提示的位置在左下角
      tooltipLocation:'sw'
    } 
        });
	}
};