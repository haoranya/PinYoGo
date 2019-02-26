<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>类型品牌管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../plugins/select2/select2.css" />
    <link rel="stylesheet" href="../plugins/select2/select2-bootstrap.css" />
    <link rel="stylesheet" href="/css/page.css" />
    <script src="../plugins/select2/select2.min.js" type="text/javascript"></script>

</head>

<body class="hold-transition skin-red sidebar-mini">

    <form action="{{route('Admin_type_doupdate')}}?id=" method="post">
        {{csrf_field()}}
        <div class="modal-body">

            <table class="table table-bordered table-striped" width="800px">

                @if($level==3)
                 <tr>
                    <td>修改一级分类</td>
                    <td>
                        <select class="form-control" name="cat_one_id" id="type_one">
                                 @foreach($type_one as $v)
										<option <?php if($v->id==$type_id[1])echo 'selected'?> value="{{$v->id}}">{{$v->goods_type}}</option>
								 @endforeach
                        </select>
                    </td>
                </tr>

                <tr>    
                     <td>修改二级分类</td>
                    <td>
                        <select class="form-control select-sm" name="cat_two_id" id="type_two">
                              
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>当前三级分类</td>
                    <td>
                        <input type="hidden" name="type_id" value="{{$type->id}}">
                        <input class="form-control" name="goods_type" value="{{$type->goods_type}}" placeholder="三级类型">
                    </td>
                    @if($errors->first('goods_type'))
                    <td style="color:red;font-size:20px;">{{$errors->first('goods_type')}}</td>
                    @endif
                </tr>
                @elseif($level==2)
                <tr>
                    <td>修改一级分类</td>
                    <td>
                        <select class="form-control" name="cat_one_id">
                                 @foreach($type_one as $v)
										<option <?php if($v->id==$type_id[0])echo 'selected'?> value="{{$v->id}}">{{$v->goods_type}}</option>
								 @endforeach
                        </select>
                    </td>
                </tr>

                 <tr>    
                    <td>修改二级分类</td>
                    <td>
                        <input type="hidden" name="type_id" value="{{$type->id}}">
                        <input class="form-control" name="goods_type" value="{{$type->goods_type}}" placeholder="三级类型">
                    </td>
                    @if($errors->first('goods_type'))
                    <td style="color:red;font-size:20px;">{{$errors->first('goods_type')}}</td>
                    @endif
                </tr>
                @elseif($level==1)
                <tr>    
                    <td>修改一级分类</td>
                    <td>
                        <input type="hidden" name="type_id" value="{{$type->id}}">
                        <input class="form-control" name="goods_type" value="{{$type->goods_type}}" placeholder="三级类型">
                    </td>
                    @if($errors->first('goods_type'))
                    <td style="color:red;font-size:20px;">{{$errors->first('goods_type')}}</td>
                    @endif
                </tr>
                @endif
            </table>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="修改">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
        </div>
    </form>

    </div>
    </div>
    </div>

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

                if({{$type_id[0]}} == date[i].id){

                    var selected = "selected";

                 }
                 
                html += "<option  value='" + date[i].id + "'"+selected+">" + date[i].goods_type + "</option>";

            }

            $("#type_two").html('');

            $("#type_two").append(html);

        }

    })

} else {

    $("#type_two").html('');

    $("#type_three").html('');
}

})

$("#type_one").trigger("change");

</script>