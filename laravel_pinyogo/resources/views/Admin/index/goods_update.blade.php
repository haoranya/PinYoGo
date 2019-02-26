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

	<!-- 富文本编辑器 -->
	<link rel="stylesheet" href="../plugins/kindeditor/themes/default/default.css" />
	<script charset="utf-8" src="../plugins/kindeditor/kindeditor-min.js"></script>
	<script charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>

</head>
<style>

	.color{
		
		color:red;

	}

</style>
<body class="hold-transition skin-red sidebar-mini">

	<!-- 正文区域 -->
	<section class="content">

		<div class="box-body">

			<!--tab页-->
			<div class="nav-tabs-custom">

				<!--tab头-->
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#home" data-toggle="tab">商品基本信息</a>
					</li>
					<li>
						<a href="#customAttribute" data-toggle="tab">扩展属性</a>
					</li>
				</ul>
				<!--tab头/-->
				<form action="/Admin_goods_doupdate?id={{$goods_info['id']}}" method="post">
					{{csrf_field()}}
					<!--tab内容-->
					 <div class="tab-content">
						<!--表单内容-->
						<div class="tab-pane active" id="home">
							<div class="row data-type">
								<div class="col-md-2 title">商品分类</div>
								<div class="col-md-8 data">
									<table>
										<tr>
											<td>
											<select class="form-control" name="cat_one_id" id="type_one">
													@foreach($type as $v)
													<option <?php if($v->id==$goods_info->cat_one_id)echo 'selected'?> value="{{$v->id}}">{{$v->goods_type}}</option>
													@endforeach
												</select>
											</td>
											<td>
												<select class="form-control select-sm" name="cat_two_id" id="type_two"></select>
											</td>
											<td>
												<select class="form-control select-sm" name="cat_three_id" id="type_three"></select>
											</td>
										</tr>
									</table>
								</div>
								    @if($errors->has('cat_three_id'))
									<div class="col-md-2 title color" >{{$errors->first('cat_three_id')}}</div>
									@else
									<div class="col-md-2 title color" >分类</div>								
									@endif
								<div class="col-md-2 title">商品名称</div>
								<div class="col-md-8 data">
									<input type="text" name="goods_name" class="form-control" value="{{$goods_info->goods_name}}" placeholder="商品名称">
								</div>
								   @if($errors->has('goods_name'))
									<div class="col-md-2 title color" >{{$errors->first('goods_name')}}</div>
									@else
									<div class="col-md-2 title color" >名称</div>						
									@endif
								<div class="col-md-2 title">品牌</div>
								<div class="col-md-8 data">
									<select class="form-control" name="brand_id" id="brand"></select>
								</div>
								    @if($errors->has('brand_id'))
									<div class="col-md-2 title color" >{{$errors->first('brand_id')}}</div>
									@else
									<div class="col-md-2 title color" >品牌</div>						
									@endif
								<div class="col-md-2 title">价格</div>
								<div class="col-md-8 data">
									<div class="input-group">
										<span class="input-group-addon">¥</span>
										<input type="text" name="price" value="{{$goods_info->price}}" class="form-control" placeholder="价格" value="">
									</div>
								</div>
								    @if($errors->has('price'))
									<div class="col-md-2 title color" >{{$errors->first('price')}}</div>
									@else
									<div class="col-md-2 title color" >价格</div>						
									@endif

									<div class="col-md-2 title">库存</div>
								<div class="col-md-8 data">
									<div class="input-group">
										<span class="input-group-addon">🛒</span>
										<input type="text" name="number" value="{{$goods_info->number}}" class="form-control" placeholder="库存量" value="">
									</div>
								</div>
								    @if($errors->has('number'))
									<div class="col-md-2 title color" >{{$errors->first('number')}}</div>
									@else
									<div class="col-md-2 title color" >库存</div>						
									@endif
								
								<div class="col-md-2 title">是否秒杀</div>
								<div class="col-md-8 data">
									<div class="input-group">
										<span class="input-group-addon">🕕</span>
										<select class="form-control select-sm" name="seckill_state" id="type_two">
											<option <?php if($goods_info->seckill_state=='非秒杀') echo 'selected'?> value="非秒杀">设为普通商品</option>
											 <option <?php if($goods_info->seckill_state=='秒杀') echo 'selected'?> value="秒杀">设为秒杀商品</option>
										</select>
									</div>
								</div>
								<div class="col-md-2 title color" >选择是否秒杀</div>		

								<div class="col-md-2 title editer">商品介绍</div>
								<div class="col-md-8 data editer">
									<textarea name="desc" style="width:800px;height:400px;visibility:hidden;">{{$goods_info->desc}}</textarea>
								</div>	
								    @if($errors->has('desc'))
									<div class="col-md-2 title color" style="width:174.83px;height:320px;line-height:320px;" >{{$errors->first('desc')}}</div>	
									@else
									<div class="col-md-2 title color" style="width:174.83px;height:320px;line-height:320px;" >描述</div>				
									@endif
								<div class="col-md-2 title rowHeight2x">包装列表</div>
								<div class="col-md-8 data rowHeight2x">
									<textarea rows="4" name="packing" class="form-control" placeholder="包装列表">{{$goods_info->packing}}</textarea>
								</div>
								    @if($errors->has('packing'))
									<div class="col-md-2 title color" style="width:174.83px;height:84px;line-height:84px;" >{{$errors->first('packing')}}</div>		
									@else
									<div class="col-md-2 title color" style="width:174.83px;height:84px;line-height:84px;" >包装</div>				
									@endif
								<div class="col-md-2 title rowHeight2x">售后服务</div>
								<div class="col-md-8 data rowHeight2x">
									<textarea rows="4" name="serve" class="form-control" placeholder="售后服务">{{$goods_info->serve}}</textarea>
								</div>
								    @if($errors->has('serve'))
									<div class="col-md-2 title color" style="width:174.83px;height:84px;line-height:84px;" >{{$errors->first('serve')}}</div>		
									@else
									<div class="col-md-2 title color" style="width:174.83px;height:84px;line-height:84px;" >服务</div>				
									@endif
							</div>
						</div>
						
						<!--扩展属性-->
						
						<div class="tab-pane" id="customAttribute">
						<div>
							<h3>旧的属性-规格:</h3>
							@foreach($spec_info as $k=>$v)

							     @if($spec_info[$k]==null)
								
								 @elseif($spec_info[$k+1]['attr_name']!=$v['attr_name'])
								 <input style="color:red" type="button" value="删除{{$v['attr_name']}}属性" onclick="del_old_attr(this,'{{$v['attribute_id']}}')">
								 @endif

							<div class="data">
								@if($spec_info[$k]!=null)
								<input class="form-control" name='old_attr[]' value="{{$v['attr_name']}}" alt="{{$v['attribute_id']}}" placeholder="扩展属性">
							    <input class="col-md-12 title" name='old_spec[]' value="{{$v['spec']}}" alt={{$v['id']}} placeholder="规格">
								<input type="button" class="title" value="删除规格" onclick="del_old_spec(this,'{{$v['id']}}')">
								@endif
							</div>
							@endforeach
						</div>
							<div class="row data-type add">
								<br>
								<div class="data-type">
									<input type="button" class="title" value="添加一个属性" onclick="attribute_add()" style="width:174.83px;height:50px;line-height:50px;" >
									@if(session()->get('error_attr'))
									<div class="title color" style="width:174.83px;height:84px;line-height:84px;float:right;" >{{session()->get('error_attr')}}</div>		
									@else
									<div class="title color" style="width:174.83px;height:84px;line-height:84px;float:right;" >属性</div>			
									@endif
									@if(session()->get('error_spec'))
									<div class="title color" style="width:174.83px;height:84px;line-height:84px;float:right;" >{{session()->get('error_spec')}}</div>		
									@else
									<div class="title color" style="width:174.83px;height:84px;line-height:84px;float:right;" >规格</div>			
									@endif
								</div>
								<br>
								<div>
									<!-- <div class="col-md-2 title">扩展属性</div>
									<div class="col-md-9 data">
										<input class="form-control" name="attribute[]"  placeholder="扩展属性">
									</div>
									<div class="col-md-1">
										<input type="button" class="title" value="删除属性" onclick="del_attr(this)">
									</div>
									<input class="col-md-12 title" name="spec[]"  placeholder="规格"> -->
								</div>
							</div>

							<br>
							<br>
							<br>
							<div class="btn-toolbar list-toolbar">
								<input type="submit" value="修改" class="btn btn-primary">
								<button class="btn btn-default">返回列表</button>
							</div>

						</div>
					</div>
					<input type="hidden" name="del_attr" id='del_attr'>
					<input type="hidden" name="del_spec" id='del_spec'> 					
				</form>
				<!--tab内容/-->

				<!--表单内容/-->

			</div>

		</div>

	</section>


	<!-- 正文区域 /-->
	<script type="text/javascript">

		var editor;
		KindEditor.ready(function (K) {
			editor = K.create('textarea[name="desc"]', {
				allowFileManager: true
			});
		});

	</script>

</body>

</html>
<script>

	$("#type_one").change(function () {

		var parent_id = $(this).val();

		var url = "{{route('Admin_goods_type')}}";

		if (parent_id != '') {

			$.ajax({

				type: 'GET',

				url: url,

				data: { 'parent_id': parent_id },

				dateType: 'json',

				success: function (date) {

					var html = '';

					for (var i = 0; i < date.length; i++) {

							var selected = '';

             		if({{$goods_info->cat_two_id}} == date[i].id){

             		    var selected = "selected";

             		 }

						html += "<option value='" + date[i].id + "'"+selected+">" + date[i].goods_type + "</option>";

					}

					$("#type_two").html('');

					$("#type_two").append(html);

					$("#type_two").trigger("change");

				}

			})

		} else {

			$("#type_two").html('');

			$("#type_three").html('');
		}



	})

	$("#type_one").trigger("change");

	$("#type_two").change(function () {

		var parent_id = $(this).val();

		var url = "{{route('Admin_goods_type')}}";

		$.ajax({

			type: 'GET',

			url: url,

			data: { 'parent_id': parent_id },

			dateType: 'json',

			success: function (date) {

				var html = '';

				for (var i = 0; i < date.length; i++) {

						var selected = '';

             		if({{$goods_info->cat_three_id}} == date[i].id){

             		    var selected = "selected";

             		 }
					

					html += "<option value='" + date[i].id + "'"+selected+">" + date[i].goods_type + "</option>";

				}

				$("#type_three").html('');

				$("#type_three").append(html);

				$("#type_three").trigger("change");

			}
		})

	})

	$("#type_three").change(function () {

		var goods_type_id = $("#type_three").val();

		var url = "{{route('Admin_brand')}}";

		$.ajax({

			type: "GET",

			url: url,

			data: { 'goods_type_id': goods_type_id },

			success: function (date) {

				var html = '';

				for (var i = 0; i < date.length; i++) {

					var selected = '';

             		if({{$goods_info->brand_id}} == date[i].id){

             		    var selected = "selected";

             		 }
                 
					html += "<option value='" + date[i].id + "'"+selected+">" + date[i].brand + "</option>";

				}

				$("#brand").html('');

				$("#brand").append(html);

			}

		})

	})

	var attribute = `<div>
						<div class="col-md-2 title">扩展属性</div>
						<div class="col-md-9 data">
							<input class="form-control" name="attribute[]" placeholder="扩展属性">
						</div>
						<div class="col-md-1">
							<input type="button" class="title" value="删除属性" onclick="del_attribute(this)">
						</div>
					    <input class="col-md-12 title" name="spec[]" placeholder="规格">
					</div>`;

	var spec = `<input class="col-md-12 title" name="spec[]" placeholder="规格">`;

	function attribute_add() {
		$(".add").append(attribute);
	}

	function del_attribute(e) {

		if (confirm("确定要删除么？")) {
			$(e).parent().parent().remove();
		}
	}

	function del_old_spec(e,spec_id) {

		var del_spec_id = $("#del_spec").val();

		if (confirm("确定要删除么？")) {

			$(e).parent().remove();

			del_spec_id += spec_id+',';

			$("#del_spec").val(del_spec_id);

		}

	}

	function del_old_attr(e,attr_id) {

		var del_attr_id = $("#del_attr").val();

		if (confirm("确定要删除么？")) {

			$(e).remove();

			$("input[name='old_attr[]']").each(function(i){

				if($(this).attr('alt')==attr_id){

					$(this).parent().remove();

				}

			})
			
			del_attr_id += attr_id+',';

			$("#del_attr").val(del_attr_id);

		}

	}

</script>