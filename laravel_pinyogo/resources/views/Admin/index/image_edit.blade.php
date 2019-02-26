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
					
					<!--表单内容/-->
					<form action="{{route('Admin_update_image')}}?id=<?=$image_info->id?>" method="post" enctype='multipart/form-data'>
                    {{csrf_field()}}
                    <input type="hidden" name="del" id="del_info">
                    <div class="modal-header">
									<h3 id="myModalLabel">修改商品图片</h3>
								</div>
								<div class="modal-body">
                                
									<table class="table table-bordered table-striped">
                                        <div class="">选择商品</div>
										<div class="">
										    <select class="form-control" name="goods_id" id="goods_id"> 

												@foreach($data as $v)
													<option <?php if($image_info->goods_id==$v->id) echo 'selected';?> value="{{$v->id}}">{{$v->goods_name}}  </option>
												@endforeach

                                            </select>
                                            
                                            <span>旧的LOGO : <img src="{{Storage::url($image_info->logo)}}" width="200px" height="200px"></span>
                                            <span></span>
											<tr>
                                                <td>修改你商品的LOGO图</td>
												<td><input type="file" name="logo" id="file" />
											</tr>
                                            @foreach($imgs as $img)
                                            <tr>    
                                                <td>旧的样式图:<img src="{{Storage::url($img)}}" alt="" width='50'></td>
                                                <td><input type="button" onclick="del_img(this,'<?=$img?>')" value="删除"></td>
                                            </tr>
                                            @endforeach
											<tr> 
												<td>选择你商品的样式图</td><td><input type="file" name="img[]" id="file" /></td>
										   </tr>
                                            <tr><td><input type="button" class="btn btn-warning" value="添加" id="add" ></td></tr>
                                        </div> 
									</table>

									</div>
									<div class="modal-footer">
										<input type="submit" class="btn btn-success" aria-hidden="true" value="修改">
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

