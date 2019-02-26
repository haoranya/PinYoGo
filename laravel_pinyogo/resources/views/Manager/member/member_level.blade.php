<!DOCTYPE>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/style.css"/>       
        <link href="/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/font/css/font-awesome.min.css" />
		<script src="/js/jquery-1.9.1.min.js"></script>
		<script src="/assets/js/typeahead-bs2.min.js"></script>   
        <script src="/js/lrtk.js" type="text/javascript" ></script>		
		<script src="/assets/js/jquery.dataTables.min.js"></script>
		<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/assets/dist/echarts.js"></script>
      
<title>会员等级</title>
</head>

<body>
<div class="grading_style"> 
<div id="category">
    <div id="scrollsidebar" class="left_Treeview">
    <div class="show_btn" id="rightArrow"><span></span></div>
    <div class="widget-box side_content" >
    <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
     <div class="side_list">
      <div class="widget-header header-color-green2">
          <h4 class="lighter smaller">会员等级</h4>
      </div>
      <div class="widget-body">
         <ul class="b_P_Sort_list">
             <li><i class="orange  fa fa-user-secret"></i><a href="#">全部({{$one+$two+$three+$four+$five}})</a></li>
             <li><i class="fa fa-diamond pink "></i> <a href="#">普通会员({{$one}})</a></li>
             <li> <i class="fa fa-diamond pink "></i> <a href="#">白银会员({{$two}})</a> </li>
             <li> <i class="fa fa-diamond pink "></i> <a href="#">黄金会员({{$three}})</a></li>
             <li><i class="fa fa-diamond pink "></i> <a href="#">铂金会员({{$four}})</a></li>
             <li><i class="fa fa-diamond pink "></i> <a href="#">超级会员({{$five}})</a></li>
            </ul>
  </div>
  </div>
  </div>  
  </div>
  <!--右侧样式-->
   <div class="page_right_style right_grading">
   <div class="Statistics_style" id="Statistic_pie">
     <div class="type_title">等级统计 
     <span class="top_show_btn Statistic_btn">显示</span> 
     <span class="Statistic_title Statistic_btn"><a title="隐藏" class="top_close_btn">隐藏</a></span>
     </div> 
      <div id="Statistics" class="Statistics"></div> 
      </div>
      <!--列表样式-->
      <div class="grading_list">
       <div class="type_title">全部会员等级列表</div>
       <div class="search_style">
     <form action="{{route('Manager_member_list')}}">
      <ul class="search_content clearfix">
       <li><label class="l_f">会员名称</label><input name="name" type="text"  class="text_add" value="{{$name}}" placeholder="输入会员名称、电话、邮箱"  style=" width:400px"/></li>
       <li><label class="l_f">添加时间</label><input name="add_time" value="{{$add_time}}" class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="submit" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </ul>
      </form>
    </div>
         <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
        <tr>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="80">性别</th>
				<th width="120">手机</th>
				<th width="150">邮箱</th>
				<th width="">地址</th>
				<th width="180">加入时间</th>
                <th width="100">等级</th>
				<th width="70">状态</th>                
				<th width="250">操作</th>
			</tr>
		</thead>
	<tbody>
    @foreach($user_arr as $user)
		<tr>
          <td>{{$user->id}}</td>
          <td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{$user->user}}','member-show.html','10001','500','400')">{{$user->user}}</u></td>
          <td>{{$user->sex}}</td>
          <td>{{$user->phone}}</td>
          <td>admin@mail.com</td>
          <td class="text-l">{{$user->province}} {{$user->city}} {{$user->county}}</td>
          <td>{{$user->created_at}}</td>
          <td>{{$user->member}}</td>
          <td class="td-status">
            @if($user->state=='已开启')
            <span class="label label-success radius">{{$user->state}}</span>
            @else
            <span class="label label-defaunt radius">{{$user->state}}</span>
            @endif
          </td>
          <td class="td-manage">
         @if($user->state=='已开启')
         <a onClick="member_stop(this,'10001','{{$user->id}}')"  href="javascript:;" title="停用"  class="btn btn-xs btn-success"><i class="fa fa-check  bigger-120"></i></a> 
         @else
         <a style="text-decoration:none" class="btn btn-xs" onClick="member_start(this,id,'{{$user->id}}')" href="javascript:;" title="启用"><i class="fa fa-close bigger-120"></i></a>
         @endif
          <a title="删除" href="javascript:;"  onclick="member_del(this,'1',{{$user->id}})" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
          </td>
		</tr>
    @endforeach
      </tbody>
	</table>
    <div style="width:100%;text-align:center;">{{ $users->appends($req->all())->links() }}</div>
   </div>
      </div>
   </div> 
  </div>
  
</div>
</body>
</html>
<script type="text/javascript"> 
$(function() { 
	$("#category").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',	
		durationTime :false,
		spacingw:20,
		spacingh:240,
		set_scrollsidebar:'.right_grading',
	});
});
$(function() { 
	$("#Statistic_pie").fix({
		float : 'top',
		//minStatue : true,
		skin : 'green',	
		durationTime :false,
		spacingw:0,
		spacingh:0,
		close_btn:'.top_close_btn',
		show_btn:'.top_show_btn',
		side_list:'.Statistics',
		close_btn_width:80,
		side_title:'.Statistic_title',
	});
});
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'#?='+id,w,h);
}
/*用户-停用*/
function member_stop(obj,id,user_id){
	layer.confirm('确认要停用吗？',function(index){
        var url = "{{route('Manager_ajax_stop')}}";
        $.ajax({

            type:'GET',
            url:url,
            data:{'user_id':user_id},
            dataType:'json',
            success:function(data){

                if(data==1){

                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,id,'+user_id+')" href="javascript:;" title="启用"><i class="fa fa-close bigger-120"></i></a>');
		            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		            $(obj).remove();
		            layer.msg('已停用!',{icon: 5,time:1000});
                }

            }

        })

		
	});
}
/*用户-启用*/
function member_start(obj,id,user_id){
	layer.confirm('确认要启用吗？',function(index){

        var url = "{{route('Manager_ajax_start')}}";
        $.ajax({

            type:'GET',
            url:url,
            data:{'user_id':user_id},
            dataType:'json',
            success:function(data){

                if(data==1){

                    	$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,id,'+user_id+')" href="javascript:;" title="停用"><i class="fa fa-check  bigger-120"></i></a> ');
		                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		                $(obj).remove();
		                layer.msg('已启用!',{icon: 6,time:1000});

                }

            }

        })

	
	});
}

/*用户-删除*/
function member_del(obj,id,user_id){
	layer.confirm('确认要删除吗？',function(index){

        var url = "{{route('Manager_ajax_del')}}";
        $.ajax({

            type:'GET',
            url:url,
            data:{'user_id':user_id},
            dataType:'json',
            success:function(data){

                if(data==1){

                    $(obj).parents("tr").remove();
		            layer.msg('已删除!',{icon:1,time:1000});

                }

            }

        })

		
	});
}

</script>
<script type="text/javascript">
//初始化宽度、高度  
 $(".widget-box").height($(window).height()); 
 $(".page_right_style").width($(window).width()-220);
 //$(".table_menu_list").width($(window).width()-240);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".widget-box").height($(window).height());
	 $(".page_right_style").width($(window).width()-220);
	 //$(".table_menu_list").width($(window).width()-240);
	}) 
/**************/
     require.config({
            paths: {
                echarts: './assets/dist'
            }
        });
        require(
            [
                'echarts',
				'echarts/theme/macarons',
                'echarts/chart/pie',   // 按需加载所需图表，如需动态类型切换功能，别忘了同时加载相应图表
                'echarts/chart/funnel'
            ],
            function (ec,theme) {

                var myChart = ec.init(document.getElementById('Statistics'),theme);
			
			option = {
    title : {
        text: '用户等级统计',
        subtext: '实时更新最新等级',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        
        x : 'center',
        y : 'bottom',
        data:['普通用户','白银用户','黄金用户','铂金用户','超级用户']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: false},
            dataView : {show: false, readOnly: true},
            magicType : {
                show: true, 
                type: ['pie', 'funnel'],
                option: {
                    funnel: {
                        x: '25%',
                        width: '50%',
                        funnelAlign: 'left',
                        max: 6200
                    }
                }
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'会员数量',
            type:'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:{{$one}}, name:'普通用户'},
                {value:{{$two}}, name:'白银用户'},
				{value:{{$three}}, name:'黄金用户'},
				{value:{{$four}}, name:'铂金用户'},
				{value:{{$five}}, name:' 超级用户'},
            ]
        }
    ]
};
   myChart.setOption(option);
			}
);
</script>
<script type="text/javascript">
$(function($) {
				var oTable1 = $('#sample-table').dataTable( {
				"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,4,5,6,7,9]}// 制定列不参与排序
		] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			});
</script>