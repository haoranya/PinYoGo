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

				                
<!-- 分类修改窗口 -->
	<form action="{{route('Admin_ad_type_update')}}?id={{$ad_type_info->id}}" method="post">
		{{csrf_field()}}
		<div class="modal-body">				
			
			<table class="table table-bordered table-striped"  width="800px">
		      	<tr>
		      		<td>分类名称</td>
		      		<td><input  class="form-control" name="ad_type" value="{{$ad_type_info->ad_type}}" placeholder="分类名称"></td>
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
                            @foreach($ad_groups as $v)
                            <option <?php if($ad_type_info->group_id==$v->id){echo 'selected';}?> value="{{$v->id}}">{{$v->group}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
			    <tr>
		      		<td>KEY</td>
		      		<td><input  class="form-control" name="key" value="{{$ad_type_info->key}}" placeholder="KEY"></td>
					@if($errors->has('key'))
					<td style="color:red;">{{$errors->first('key')}}</td>
					@endif
		      	</tr>		      
			 </table>				
			
		</div>
		<div class="modal-footer">						
			<input type="submit" class="btn btn-success" value="修改分类">
		</div>
		</form>
</body>

</html>