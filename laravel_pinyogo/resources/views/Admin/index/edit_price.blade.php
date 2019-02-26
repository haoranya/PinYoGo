<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商品管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../css/style.css">
	<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
 
</head>

<body class="hold-transition skin-red sidebar-mini" >
<form action="Admin_update_price" method="post" id="form">
@foreach($attrs as $attr)
    <input type="hidden" name="goods_id" value="{{$attr->goods_id}}">
    <p>属性:{{$attr->attribute}}</p>
    <p>规格</p>
    <select name="spec[]" class="spec" onchange="choose()">
        @foreach($attr->specs as $spec)
        <option value="{{$spec->id}}">{{$spec->spec}}</option>        
        @endforeach
    </select>
  @endforeach
  @if(session()->get('error_spec'))
<p style="color:red">{{session()->get('error_spec')}}</p>
  @endif
    <p>价格</p>

        {{csrf_field()}}

        <input type="text" name="price" id="price">

       

    <p>库存量</p>

        <input type="text" name="number" id="number" >

        <input type="button" onclick="sub()" value="更新">
    </form>
</body>

</html>
<script>

   function choose(){
        var spec_id = '';

        var goods_id = "{{$attr->goods_id}}";

        $('.spec').each(function(){

            spec_id+=$(this).val()+"-";
           
        });
        var url = "{{route('Admin_ajax_price')}}";
        $.ajax({

            type:'GET',
            url:url,
            data:{'spec_id':spec_id,'goods_id':goods_id},
            success:function(data){
                
                $("#price").val(data.price);

                $("#number").val(data.number);

            }

        })

    }

    choose();

    function sub(){

        if($("#price").val()==''){

            alert("价格不可以为空");

        }else if($("#number").val()==''){

            alert('库存量不可以为空');

        }else{
            
            $("#form").submit();

        }

    }

</script>