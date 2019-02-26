<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>广告管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../css/style.css">
	<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    
</head>

<body class="hold-transition skin-red sidebar-mini">
  <!-- .box-body -->
                
                    <div class="box-header with-border">
                        <h3 class="box-title">广告管理</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" title="新建" data-toggle="modal" data-target="#ad_add" ><i class="fa fa-file-o"></i> 新建</button>
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
							                                  
                                </div>
                            </div>
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
										  <th class="sorting_asc">广告ID</th>
									      <th class="sorting">分类ID</th>
									      <th class="sorting">标题</th>
									      <th class="sorting">URL</th>		
									      <th class="sorting">图片</th>		
									      <th class="sorting">是否有效</th>											     						      							
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
								    @foreach($ads as $v)
			                          <tr>
				                          <td>{{$v->id}}</td>
									      <td>{{$v->ad_type_id}}</td>
									      <td>{{$v->ad_title}}</td>
									      <td>{{$v->url}}</td>
									      <td>
									      	<img src="{{Storage::url($v->ad_logo)}}" width="50px" height="30px">
									      </td>
									      <td>{{$v->ad_state}}</td>
		                                  <td class="text-center">
		                                 	  <a href="{{route('Admin_ad_edit')}}?id={{$v->id}}" class="btn bg-success btn-xs">修改</a>                                      
		                                 	  <a href="{{route('Admin_ad_del')}}?id={{$v->id}}" class="btn bg-danger btn-xs">删除</a>                                      
		                                  </td>
			                          </tr>
									  @endforeach
			                      </tbody>
			                  </table>
			                  <!--数据列表/--> 
                        </div>
                        <!-- 数据表格 /-->
                     </div>
                    <!-- /.box-body -->
					<div style="width:100%;text-align:center;">{{ $ads->appends($req->all())->links() }}</div>
		
<!-- 添加广告窗口 -->
<form action="{{route('Admin_ad_add')}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
<div class="modal fade" id="ad_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">广告编辑</h3>
		</div>
		<div class="modal-body">							
			
			<table class="table table-bordered table-striped"  width="800px">
				<tr>
					@if(session()->get('error_ad'))
					<td style="color:red;">{{session()->get('error_ad')}}</td>
					@endif
				</tr>
			    <tr>
		      		<td>广告分组</td>
		      		<td>
					  <select class="form-control" name="group_id" id="group_id">
                            @foreach($group as $v)
                            <option value="{{$v->id}}">{{$v->group}}</option>
                            @endforeach
                        </select>
		      		</td>
		      	</tr>
				<tr>
		      		<td>广告分类</td>
		      		<td>
		      			<select class="form-control" name="ad_type_id" id="ad_type_id"></select>
		      		</td>
				
		      	</tr>
		      	<tr>
		      		<td>标题</td>
		      		<td><input type="text"  class="form-control" name="ad_title" value="{{old('ad_title')}}" placeholder="标题"  > 
					  	
				    </td>
					  @if($errors->has('ad_title'))
					<td style="color:red;">{{$errors->first('ad_title')}}</td>
					 @endif
		      	</tr>
				<tr>
		      		<td>URL</td>
					<td>
						<input type="text" name="url" class="form-control" value="{{old('url')}}" placeholder="URL"> 
					</td>
					@if($errors->has('url'))
					<td style="color:red;">{{$errors->first('url')}}</td>
					@endif
		      	</tr>	
				<tr>
				  
				</tr>		      	
		      	<tr>
		      		<td>广告图片</td>
		      		<td>
						<input type="file" name='ad_logo' id="file" />
		      		</td>
					  @if($errors->has('ad_logo'))
					    <td style="color:red;">{{$errors->first('ad_logo')}}</td>
					  @endif
		      	</tr>	      
			 </table>				
			
		</div>
		<div class="modal-footer">						
			<input type="submit" class="btn btn-success" value="提交">
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
	  </div>
	</div>
</div>
</form>

</body>

</html>
<script>

$("#group_id").change(function () {

var group_id = $(this).val();

var url = "{{route('Admin_ad_get_type')}}";

	$.ajax({

		type: 'GET',

		url: url,

		data: { 'group_id': group_id },

		dateType: 'json',

		success: function (date) {

			var html = '';

			for (var i = 0; i < date.length; i++) {

				html += "<option value='" + date[i].id + "'>" + date[i].ad_type + "</option>";

			}

			$("#ad_type_id").html('');

			$("#ad_type_id").append(html);

		}

	})

})

$("#group_id").trigger('change');	

</script>
<script src="/js/img.js"></script>