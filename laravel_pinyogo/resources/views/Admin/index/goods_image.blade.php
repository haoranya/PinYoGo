<!DOCTYPE html>
<html>

<head>
	<!-- 页面meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>商品编辑</title>
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

	<!-- 正文区域 -->
	<section class="content">

		<div class="box-body">

			<!--tab页-->
			<div class="nav-tabs-custom">
								
					<!-- 颜色图片 -->
					<div class="btn-group">
						<button type="button" class="btn btn-default" title="新建" data-target="#uploadModal" data-toggle="modal">
							<i class="fa fa-file-o"></i> 新建</button>

					</div>

					<table class="table table-bordered table-striped table-hover dataTable">
						<thead>
							<tr>

								<th class="sorting">商品ID</th>
								<th class="sorting">商品名称</th>
								<th class="sorting">LOGO图</th>商品名称</th>
								<th class="sorting">操作</th>
						</thead>
						<tbody>
							@foreach($img_data as $v)
							<tr>
								<td>{{$v->goods_id}}</td>
								<td>{{$v->goods_name}}</td>
								<td>
									<img alt="	" src="{{Storage::url($v->logo)}}" width="50px" height="30px">
								</td>
								<td>	
								    <a class="btn btn-danger" onclick ="cut('{{route("Admin_del_image")}}?id={{$v->id}}')" >删除</a>
									<a class="btn btn-warning" href='{{route("Admin_edit_image")}}?id={{$v->id}}' >修改</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div style="width:100%;text-align:center;">{{ $img_data->appends($req->all())->links() }}</div>
					<!--表单内容/-->
					<form action="{{route('Admin_add_image')}}" method="post" enctype='multipart/form-data'>
					{{csrf_field()}}
					<!-- 上传窗口 -->
					<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">上传商品图片</h3>
								</div>
								<div class="modal-body">

									<table class="table table-bordered table-striped">

										<div class="col-md-2 title">选择商品</div>
										<div class="col-md-10 data">
											<select class="form-control" name="goods_id" id="goods_id">

												@foreach($data as $v)
													<option value="{{$v->id}}">{{$v->goods_name}}</option>
												@endforeach

											</select>
											<tr>
											@if(session()->get('error_goods'))
												<td style="color:red">{{session()->get('error_goods')}}</td>
											@endif
											</tr>
											<tr>
											    <td>选择你商品的LOGO图</td>
												<td><input type="file" name="logo" id="file" />
											</tr>
											<tr>
												@if($errors->has('logo'))
												<td style="color:red;font-size:12px;">{{$errors->first('logo')}}</td>
												@endif
											</tr>
											<tr><td></td></tr>  
											<tr> 
												<td>选择你商品的样式图</td><td><input type="file" name="img[]" id="file" /></td>
										   </tr>
										    <tr>
												@if(session()->get('error_img'))
												<td style="color:red;font-size:12px;">{{session()->get('error_img')}}</td>
												@endif
											</tr>	
											<tr><td><input type="button" class="btn btn-warning" value="添加" id="add" ></td></tr>
									</table>

									</div>
									<div class="modal-footer">
										<input type="submit" class="btn btn-success" aria-hidden="true" value="保存">
										<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
									</div>
								</div>
							</div>
						</div>

				    </form>
				   <!--表单内容/-->

				</div>

			</div>

	</section>


</body>

</html>
<script src="/js/img.js"></script>