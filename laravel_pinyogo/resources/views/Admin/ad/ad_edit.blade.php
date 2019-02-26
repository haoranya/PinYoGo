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
<!-- 添加广告窗口 -->
<form action="{{route('Admin_ad_update')}}?id={{$ad->id}}" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
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
                            @foreach($ad_groups as $v)
                            <option <?php if($group_id==$v->id) echo 'selected'?>  value="{{$v->id}}">{{$v->group}}</option>
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
		      		<td><input type="text"  class="form-control" name="ad_title" value="{{$ad->ad_title}}" placeholder="标题"  >

				    </td>
					  @if($errors->has('ad_title'))
					<td style="color:red;">{{$errors->first('ad_title')}}</td>
					 @endif
		      	</tr>
				<tr>
		      		<td>URL</td>
					<td>
						<input type="text" name="url" class="form-control" value="{{$ad->url}}" placeholder="URL">
					</td>
					@if($errors->has('url'))
					<td style="color:red;">{{$errors->first('url')}}</td>
					@endif
		      	</tr>
				<tr>
				  <td>旧的广告图片</td>
				  <td><img src="{{Storage::url($ad->ad_logo)}}" alt="" width="100px;" heoght="100px;"></td>
				</tr>
				<tr></tr>
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
			<input type="submit" class="btn btn-success" value="更新">
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

				var selected = '';

				if({{$ad->ad_type_id}}== date[i].id){

					var selected = 'selected';

				}

				html += "<option value='" + date[i].id + "'"+selected+">" + date[i].ad_type + "</option>";

			}

			$("#ad_type_id").html('');

			$("#ad_type_id").append(html);

		}

	})

})

$("#group_id").trigger('change');	

</script>
<script src="/js/img.js"></script>