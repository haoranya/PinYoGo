<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/style.css" />
	<link href="//css/codemirror.css" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/ace.min.css" />
	<link rel="stylesheet" href="/font/css/font-awesome.min.css" />
	<script src="/js/jquery-1.9.1.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/typeahead-bs2.min.js"></script>
	<script src="/assets/js/jquery.dataTables.min.js"></script>
	<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
	<script src="/assets/layer/layer.js" type="text/javascript"></script>
	<script src="/assets/laydate/laydate.js" type="text/javascript"></script>
	<script src="/js/dragDivResize.js" type="text/javascript"></script>
	<title>添加权限</title>
</head>

<body>
	<div class="Competence_add_style clearfix">
		<div class="left_Competence_add">
			<div class="title_name">修改权限</div>
			<div class="Competence_add">
				<form action="Manager_admin_power_update?id={{$private->id}}" method="post" id="form_edit">
					{{csrf_field()}}
				<input type="hidden" name="private" id="private">
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限名称 </label>
					<div class="col-sm-9">
						<input type="text" id="private_name" value="{{$private->power_name}}" placeholder="填写权限名称" name="private_name" class="col-xs-10 col-sm-5">
					</div>
					@if(session()->get('error_private'))
					<p style="color:red">{{session()->get('error_private')}}</p>
					@endif
				</div>
               </form>
				<div class="form-group"></div>
				<div class="form-group"> </div>
				<!--按钮操作-->
				<div class="Button_operation">
					<button onclick="private()" class="btn btn-primary radius" type="submit">
						<i class="fa fa-save "></i> 保存并提交</button>
					<button onclick="article_save();" class="btn btn-secondary  btn-warning" type="button">
						<i class="fa fa-reply"></i> 返回上一步</button>
					<button onclick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
				</div>
			</div>
		</div>
		<!--权限分配-->
		<div class="Assign_style" id="get_private">
			<div class="title_name">权限分配</div>
			<div class="Select_Competence">
				<dl class="permission-list">
					<dt>
						<label class="middle">
							<span class="lbl">会员管理</span>
						</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_member_level',$private_arr)){ echo 'checked'; }  }?> value="/Manager_member_level" class="ace" name="user-Character-0-0" id="id-disable-check">
									<span class="lbl">会员列表</span>
								</label>
							</dt>
							<dd>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ajax_start',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ajax_start" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">开启</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ajax_stop',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ajax_stop" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-1">
									<span class="lbl">停用</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ajax_del',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ajax_del" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-2">
									<span class="lbl">删除</span>
								</label>
							</dd>
						</dl>
					</dd>
				</dl>
				<!-- 管理员管理 -->
				<dl class="permission-list">
					<dt>
						<label class="middle">
							<span class="lbl">管理员管理</span>
						</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_list',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_list" class="ace" name="user-Character-0-0" id="id-disable-check">
									<span class="lbl">管理员列表</span>
								</label>
							</dt>
							<dd>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_add',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_add" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">添加</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_edit',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_edit" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">修改</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_start',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_start" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">开启</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_stop',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_stop" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-1">
									<span class="lbl">停用</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_del',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_del" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-2">
									<span class="lbl">删除</span>
								</label>
							</dd>
						</dl>
						<dl class="cl permission-list2">
							<dt>
								<label class="middle"><input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_power',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_power" class="ace" name="user-Character-0-0" id="id-disable-check">
									<span class="lbl">权限管理</span>
								</label>
							</dt>
							<dd>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_power_add',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_power_add" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">添加</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_power_edit',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_power_edit" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-1">
									<span class="lbl">修改</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_admin_power_del',$private_arr)){ echo 'checked'; }  }?> value="/Manager_admin_power_del" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-2">
									<span class="lbl">删除</span>
								</label>
							</dd>
						</dl>
					</dd>
				</dl>

				<!-- 店铺管理 -->
				<dl class="permission-list">
					<dt>
						<label class="middle">
							<span class="lbl">店铺管理</span>
						</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_shop_agree',$private_arr)){ echo 'checked'; }  }?> value="/Manager_shop_agree" class="ace" name="user-Character-0-0" id="id-disable-check">
									<span class="lbl">店铺审核</span>
								</label>
							</dt>
							<dd>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/无',$private_arr)){ echo 'checked'; }  }?> value="" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">通过</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/无',$private_arr)){ echo 'checked'; }  }?> value="" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">驳回</span>
								</label>
							</dd>
						</dl>
						<dl class="cl permission-list2">
							<dt>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_shop_page',$private_arr)){ echo 'checked'; }  }?> value="/Manager_shop_page" class="ace" name="user-Character-0-0" id="id-disable-check">
									<span class="lbl">店铺管理</span>
								</label>
							</dt>
							<dd>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/无',$private_arr)){ echo 'checked'; }  }?> value="" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">开启</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/无',$private_arr)){ echo 'checked'; }  }?> value="" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-1">
									<span class="lbl">停用</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/无',$private_arr)){ echo 'checked'; }  }?> value="" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-2">
									<span class="lbl">删除</span>
								</label>
							</dd>
						</dl>
					</dd>
				</dl>
				<!--商品管理-->
				<dl class="permission-list">
					<dt>
						<label class="middle">
							<span class="lbl">商品管理</span>
						</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_goods_agree',$private_arr)){ echo 'checked'; }  }?> value="/Manager_goods_agree" class="ace" name="user-Character-0-0" id="id-disable-check">
									<span class="lbl">商品审核</span>
								</label>
							</dt>
							<dd>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_goods_ok',$private_arr)){ echo 'checked'; }  }?> value="/Manager_goods_ok" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">通过</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_goods_no',$private_arr)){ echo 'checked'; }  }?> value="/Manager_goods_no" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-1">
									<span class="lbl">驳回</span>
								</label>
							</dd>
						</dl>
					</dd>
				</dl>
				<!--交易管理-->
				<dl class="permission-list">
					<dt>
						<label class="middle">
							<span class="lbl">广告管理</span>
						</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_type',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_type" class="ace" name="user-Character-0-0" id="id-disable-check">
									<span class="lbl">广告类型</span>
								</label>
							</dt>
							<dd>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_add_type',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_add_type" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">添加分类</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_add_group',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_add_group" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">添加分组</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_type_edit',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_type_edit" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">修改分类</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_update_group',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_update_group" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">修改分组</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_del_type',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_del_type" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">删除分类</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_del_group',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_del_group" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">删除分组</span>
								</label>
							</dd>
						</dl>
						<dl class="cl permission-list2">
							<dt>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_list',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_list" class="ace" name="user-Character-0-1" id="user-Character-0-1">
									<span class="lbl">广告管理</span>
								</label>
							</dt>
							<dd>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_start',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_start" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
									<span class="lbl">开启</span>
								</label>
								<label class="middle">
									<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_ad_stop',$private_arr)){ echo 'checked'; }  }?> value="/Manager_ad_stop" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-1">
									<span class="lbl">停用</span>
								</label>
							</dd>
					</dd>
					</dl>

					<!--会员管理-->
					<dl class="permission-list">
						<dt>
							<label class="middle">
								<span class="lbl">文章管理</span>
							</label>
						</dt>
						<dd>
							<dl class="cl permission-list2">
								<dt>
									<label class="middle">
										<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_artical_list',$private_arr)){ echo 'checked'; }  }?> value="/Manager_artical_list" class="ace" name="user-Character-0-0" id="id-disable-check">
										<span class="lbl">文章列表</span>
									</label>
								</dt>
								<dd>
									<label class="middle">
										<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_artical_add',$private_arr)){ echo 'checked'; }  }?> value="/Manager_artical_add" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
										<span class="lbl">添加</span>
									</label>
									<label class="middle">
										<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_artical_edit',$private_arr)){ echo 'checked'; }  }?> value="/Manager_artical_edit" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-1">
										<span class="lbl">修改</span>
									</label>
									<label class="middle">
										<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_artical_del',$private_arr)){ echo 'checked'; }  }?> value="/Manager_artical_del" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-2">
										<span class="lbl">删除</span>
									</label>
								</dd>
							</dl>
							<dl class="cl permission-list2">
								<dt>
									<label class="middle">
										<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_artical_page',$private_arr)){ echo 'checked'; }  }?> value="/Manager_artical_page" class="ace" name="user-Character-0-1" id="user-Character-0-1">
										<span class="lbl">文章分类</span>
									</label>
								</dt>
								<dd>
									<label class="middle">
										<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_artical_type_add',$private_arr)){ echo 'checked'; }  }?> value="/Manager_artical_type_add" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0">
										<span class="lbl">添加</span>
									</label>
									<label class="middle">
										<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_artical_type_update',$private_arr)){ echo 'checked'; }  }?> value="/Manager_artical_type_update" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-1">
										<span class="lbl">修改</span>
									</label>
									<label class="middle">
										<input type="checkbox" <?php if($private_arr){  if(in_array('/Manager_artical_type_del',$private_arr)){ echo 'checked'; }  }?> value="/Manager_artical_type_del" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-2">
										<span class="lbl">删除</span>
									</label>
								</dd>
							</dl>
						</dd>
					</dl>
			</div>
		</div>
	</div>
</body>

</html>
<script type="text/javascript">
	//初始化宽度、高度  
	$(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
	$(".Assign_style").width($(window).width() - 500).height($(window).height()).val();
	$(".Select_Competence").width($(window).width() - 500).height($(window).height() - 40).val();
	//当文档窗口发生改变时 触发  
	$(window).resize(function () {

		$(".Assign_style").width($(window).width() - 500).height($(window).height()).val();
		$(".Select_Competence").width($(window).width() - 500).height($(window).height() - 40).val();
		$(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
	});
	/*字数限制*/
	function checkLength(which) {
		var maxChars = 200; //
		if (which.value.length > maxChars) {
			layer.open({
				icon: 2,
				title: '提示框',
				content: '您出入的字数超多限制!',
			});
			// 超过限制的字数了就将 文本框中的内容按规定的字数 截取
			which.value = which.value.substring(0, maxChars);
			return false;
		} else {
			var curr = maxChars - which.value.length; //250 减去 当前输入的
			document.getElementById("sy").innerHTML = curr.toString();
			return true;
		}
	};
	/*按钮选择*/
	$(function () {
		$(".permission-list dt input:checkbox").click(function () {
			$(this).closest("dl").find("dd input:checkbox").prop("checked", $(this).prop("checked"));
		});
		$(".permission-list2 dd input:checkbox").click(function () {
			var l = $(this).parent().parent().find("input:checked").length;
			var l2 = $(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
			if ($(this).prop("checked")) {
				$(this).closest("dl").find("dt input:checkbox").prop("checked", true);
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", true);
			}
			else {
				if (l == 0) {
					$(this).closest("dl").find("dt input:checkbox").prop("checked", false);
				}
				if (l2 == 0) {
					$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", false);
				}
			}

		});
	});


	function private(){

		if($("#private_name").val()==''){

			alert('权限名称不可以为空');

		}else{

				var private = '';

				$('input:checkbox:checked').each(function(){

					private+=$(this).val()+',';

				})

				$("#private").val(private);

				$("#form_edit").submit();

		}



	}

</script>