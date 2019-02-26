<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>品牌修改管理</title>
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../css/style.css">
	<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    
</head>
<body class="hold-transition skin-red sidebar-mini">

</form>
<!-- 修改表单 -->


<form action="{{route('Admin_doupdate_brand')}}?id={{$brand->id}}" method="post" >

		<div class="modal-body">	
            {{csrf_field()}}	
			<table class="table table-bordered table-striped"  width="800px">
             <tr>
					<td>
						<select class="form-control" name="cat_one_id" id="type_one">
							
							@foreach($type as $v)
							<option <?php if($v->id==$goods_type_id[2])echo 'selected'?> value="{{$v->id}}"> {{$v->goods_type}}</option>
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
		      	<tr>
		      		<td>品牌名称</td>
		      		<td><input  class="form-control" name="brand" value="{{$brand->brand}}" placeholder="品牌名称" >  </td>
                  </tr>
                  <tr>
                    @if($errors->first('brand'))
                    <td style="color:red;font-size:20px;">{{$errors->first('brand')}}</td>
                    @elseif(session()->get('error_brand'))
                    <td style="color:red;font-size:20px;">{{session()->get('error_brand')}}</td>
                    @endif
                  </tr>	      	
		      	<tr>
		      		<td>首字母</td>
		      		<td><input  class="form-control" name="ucfirst_brand" value="{{$brand->ucfirst_brand}}" placeholder="首字母">  </td>
                  </tr>
                  <tr>
                    @if($errors->first('ucfirst_brand'))
                    <td style="color:red;font-size:20px;">{{$errors->first('ucfirst_brand')}}</td>
                    @endif
                  </tr>	   	      	
             </table>	
             
             <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="确认修改">
   
        </div>
		</div>
		
</form>

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

                if({{$goods_type_id[1]}} == date[i].id){

                    var selected = "selected";

                 }

                html += "<option  value='" + date[i].id + "'"+selected+">" + date[i].goods_type + "</option>";

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

                if({{$goods_type_id[0]}} == date[i].id){

                    var selected = "selected";

                 }

                html += "<option  value='" + date[i].id + "'"+selected+">" + date[i].goods_type + "</option>";


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

            html += "<option value='" + date[i].id + "'>" + date[i].brand + "</option>";

        }

        $("#brand").html('');

        $("#brand").append(html);

    }

})

})

</script>