<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>品牌管理</title>
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>


</head>

<body class="hold-transition skin-red sidebar-mini">
    <!-- .box-body -->
    <div class="box-header with-border">
        <h3 class="box-title">品牌管理</h3>
    </div>

    <div class="box-body">

        <!-- 数据表格 -->
        <div class="table-box">

            <!--工具栏-->
            <div class="pull-left">
                <div class="form-group form-inline">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" title="新建" data-toggle="modal" data-target="#editModal">
                            <i class="fa fa-file-o"></i> 新建</button>
                        <button type="button" class="btn btn-default" onclick="del_brand()" title="删除">
                            <i class="fa fa-trash-o"></i> 删除</button>
                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();">
                            <i class="fa fa-refresh"></i> 刷新</button>
                    </div>
                </div>
            </div>
            <div class="box-tools pull-right">
                <div class="has-feedback">

                </div>
            </div>
            <!--工具栏/-->

            <!--数据列表-->
            <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
                <thead>
                    <tr id='tr'>
                        <th class="" style="padding-right:0px">
                        <button id="checkAll" class="icheckbox_square-blue">反选</button>
                        
                        </th>
                        <th class="sorting_asc">品牌ID</th>
                        <th class="sorting">三级分类ID</th>
                        <th class="sorting">品牌名称</th>
                        <th class="sorting">品牌首字母</th>
                        <th class="sorting">三级名称</th>
                        <th class="text-center">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $v)
                    <tr>
                        <td>
                            <input type="checkbox" name='choose' value="{{$v->id}}">
                        </td>
                        <td>{{$v->id}}</td>
                        <td>{{$v->three_type_id}}</td>
                        <td>{{$v->brand}}</td>
                        <td>{{$v->ucfirst_name}}</td>
                        <td>{{$v->goods_name}}</td>
                        <td class="text-center">
                            <a href="{{route('Admin_update_brand')}}?id={{$v->id}}&type_id={{$v->three_type_id}}" class="btn bg-olive btn-xs" data-toggle="modal">修改</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--数据列表/-->
            <div style="width:100%;text-align:center;">{{ $brands->appends($req->all())->links() }}</div>

        </div>
        <!-- 数据表格 /-->

    </div>
    <!-- /.box-body -->

    <!-- 编辑窗口 -->
    <form action="{{route('Admin_add_brand')}}" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">品牌编辑</h3>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <table class="table table-bordered table-striped" width="800px">
                            <tr>
                                <td>
                                    <select class="form-control" name="cat_one_id" id="type_one">

                                        @foreach($type as $v)
                                        <option value="{{$v->id}}">{{$v->goods_type}}</option>
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
                                <td>
                                    <input class="form-control" name="brand" value="{{old('brand')}}" placeholder="品牌名称"> </td>
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
                                <td>
                                    <input class="form-control" name="ucfirst_brand" value="{{old('ucfirst_brand')}}" placeholder="首字母"> </td>
                            </tr>
                            <tr>
                                @if($errors->first('ucfirst_brand'))
                                <td style="color:red;font-size:20px;">{{$errors->first('ucfirst_brand')}}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="保存" class="btn btn-primary">
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
                    </div>
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

                dataType: 'json',

                success: function (date) {

                    var html = '';

                    for (var i = 0; i < date.length; i++) {

                        html += "<option value='" + date[i].id + "'>" + date[i].goods_type + "</option>";

                    }

                    $("#type_two").html('');

                    $("#type_two").append(html);

                    $("#type_two").trigger("change");

                }

            })

        } else {

            alert(1);

            $("#type_two").html('');

            $("#type_three").html('');

            $("#brand").html('');
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

            dataType: 'json',

            success: function (date) {

                var html = '';

                for (var i = 0; i < date.length; i++) {

                    html += "<option value='" + date[i].id + "'>" + date[i].goods_type + "</option>";

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

    function del_brand() {

       var arr = new Array();

        $("input[name='choose']:checked").each(function(i){

            arr[i] = $(this).val();
           
        });

         var vals = arr.join(',');

        if(arr.length==0){

           alert('请选择你要要删除的');

        }else{
            
            var url = "{{route('Admin_del_brand')}}";

            $.ajax({

            type:'GET',

            url:url,

            data:{"data":vals},

            dataType:'json',

            success:function(data){


                if(data==1){

                    alert("删除成功");

                    window.location.reload();


                }

            }

           })

        }

    }

    $("#checkAll").click(function(){
                $("input[name='choose']").each(function(i){
                    $(this).prop("checked", !$(this).prop("checked"));
                });
    });


</script>