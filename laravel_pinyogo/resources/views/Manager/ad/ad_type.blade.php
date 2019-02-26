<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>广告分类管理</title>
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../css/style.css">
	<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    
</head>

<body class="hold-transition skin-red sidebar-mini"  >
  <!-- .box-body -->
                
                    <div class="box-header with-border">
                        <h3 class="box-title">广告分类管理</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" title="新建分类" data-toggle="modal" data-target="#editModal" ><i class="fa fa-file-o"></i> 新建分类</button>
                                        <button type="button" class="btn btn-default" title="新建分组" data-toggle="modal" data-target="#edit" ><i class="fa fa-file-o"></i> 新建分组</button>
                                        <button type="button" class="btn btn-default" title="删除分组" data-toggle="modal" data-target="#delete_group"><i class="fa fa-trash-o"></i>删除分组</button>
                                        <button type="button" class="btn btn-default" title="修改分组" data-toggle="modal" data-target="#update_group"><i class="fa fa-trash-o"></i>修改分组</button>
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
							        名称：<input >	<button class="btn btn-default" >查询</button>                                    
                                </div>
                            </div>
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>		
			                          <tr>
										  <th class="sorting_asc">分类ID</th>
									      <th class="sorting">分类名称</th>
									      <th class="sorting">分组</th>
									      <th class="sorting">KEY</th>					      							
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
								  @foreach($ad_types as $v)
			                          <tr>
				                          <td>{{$v->id}}</td>
									      <td>{{$v->ad_type}}</td>
									      <td>{{$v->ad_group}}</td>
									      <td>{{$v->key}}</td>
		                                  <td class="text-center">
		                                 	  <a onclick='if(confirm("你确认要修改吗？")){location.href="{{route("Admin_ad_type_edit")}}?id={{$v->id}}"}' class="btn bg-olive btn-xs">修改</a>                                                                                   
		                                 	  <a onclick='if(confirm("你确认要删除吗？")){location.href="{{route("Admin_ad_del_type")}}?id={{$v->id}}"}' class="btn bg-olive btn-xs">删除</a>                                           
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
	            <!-- 分页 -->
				<div style="width:100%;text-align:center;">{{ $ad_types->appends($req->all())->links() }}</div>
				                
<!-- 分类编辑窗口 -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">广告分类编辑</h3>
		</div>
	<form action="{{route('Manager_ad_add_type')}}" method="post">
		{{csrf_field()}}
		<div class="modal-body">							
			
			<table class="table table-bordered table-striped"  width="800px">
		      	<tr>
		      		<td>分类名称</td>
		      		<td><input  class="form-control" name="ad_type" value="{{old('ad_type')}}" placeholder="分类名称"></td>
					@if($errors->has('ad_type'))
					<td style="color:red;">{{$errors->first('ad_type')}}</td>
					@elseif(session()->get('error_ad_type'))
					<td style="color:red;">{{session()->get('error_ad_type')}}</td>
					@endif
		      	</tr>
				<tr>
					<td>选择广告组</td>
                    <td>
                        <select class="form-control" name="group_id">
                            @foreach($group as $v)
                            <option value="{{$v->id}}">{{$v->group}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
			    <tr>
		      		<td>KEY</td>
		      		<td><input  class="form-control" name="key" value="{{old('key')}}" placeholder="KEY"></td>
					@if($errors->has('key'))
					<td style="color:red;">{{$errors->first('key')}}</td>
					@endif
		      	</tr>		      
			 </table>				
			
		</div>
		<div class="modal-footer">						
			<input type="submit" class="btn btn-success" value="添加分类">
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
		</form>
	  </div>
	</div>
</div>



<!-- 分组编辑窗口 -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">广告分类编辑</h3>
		</div>
	<form action="{{route('Manager_ad_add_group')}}" method="post">
		{{csrf_field()}}
		<div class="modal-body">							
			
			<table class="table table-bordered table-striped"  width="800px">
		      	<tr>
		      		<td>分组名称</td>
		      		<td><input  class="form-control" name="group" value="{{old('group')}}" placeholder="分组名称"></td>
					@if($errors->has('group'))
					<td style="color:red;">{{$errors->first('group')}}</td>
					@endif
		      	</tr> 
			 </table>				
			
		</div>
		<div class="modal-footer">						
			<input type="submit" class="btn btn-success" value="添加分组">
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
		</form>
	  </div>
	</div>
</div>


<!-- 分组删除窗口 -->
<div class="modal fade" id="delete_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">广告分类编辑</h3>
		</div>
	<form action="{{route('Admin_ad_del_group')}}" method="post">
		{{csrf_field()}}
		<table class="table table-bordered table-striped"  width="800px">
				<tr>
					<td>选择广告组</td>
                    <td>
                        <select class="form-control" name="group_id">
                            @foreach($group as $v)
                            <option value="{{$v->id}}">{{$v->group}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
		</table>
		<div class="modal-footer">						
			<input type="submit" class="btn btn-success" value="删除分组">
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
		</form>
	  </div>
	</div>
</div>


<!-- 分组修改窗口 -->
<div class="modal fade" id="update_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">广告分类编辑</h3>
		</div>
	<form action="{{route('Admin_ad_update_group')}}" method="post">
		{{csrf_field()}}
		<table class="table table-bordered table-striped"  width="800px">
				<tr>
					<td>选择广告组</td>
                    <td>
                        <select class="form-control" name="group_id">
                            @foreach($group as $v)
                            <option value="{{$v->id}}">{{$v->group}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
				<tr>

					<td>新的广告组名</td>
					<td><input type="text" name="group"></td>
					@if(session()->get('error_group'))
					<td style="color:red;">{{session()->get('error_group')}}</td>
					@endif
				</tr>
		</table>
		<div class="modal-footer">						
			<input type="submit" class="btn btn-success" value="修改分组">
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
		</form>
	  </div>
	</div>
</div>


</body>

</html>