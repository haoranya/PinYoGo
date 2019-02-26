<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/style.css"/>       
        <link href="/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/font/css/font-awesome.min.css" />
		<script src="/js/jquery-1.9.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/Validform.min.js"></script>
		<script src="/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/assets/js/jquery.dataTables.min.js"></script>
		<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/assets/layer/layer.js" type="text/javascript" ></script>          
		<script src="/js/lrtk.js" type="text/javascript" ></script>
         <script src="/assets/layer/layer.js" type="text/javascript"></script>	
        <script src="/assets/laydate/laydate.js" type="text/javascript"></script>
</head>
<body>
<form action="{{route('Manager_admin_update')}}?manager_id={{$manager_id}}" method="post" id="form-admin-edit">
		{{csrf_field()}}		
		<div class="form-group">
			<label class="form-label">角色：</label>
			<div class="formControls "> <span class="select-box" style="width:150px;">
				<select class="select" name="power" size="1">
					@foreach($privates as $private)
					<option <?php if($private_id==$private->id) echo 'selected';?> value="{{$private->id}}">{{$private->power_name}}</option>
					@endforeach
				</select>
				</span> </div>
		</div>
		<div> 
        <input class="btn btn-primary radius" type="submit" id="edit_Administrator" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
	</form>
</body>
</html>