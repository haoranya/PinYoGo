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

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
										  <th class="sorting_asc">商品ID</th>
									      <th class="sorting">秒杀ID</th>
									      <th class="sorting">库存量</th>
									      <th class="sorting">秒杀状态</th>		
									      <th class="sorting">图片</th>									     						      						
			                          </tr>
			                      </thead>
			                      <tbody>
                                    @foreach($seckill as $v)
			                          <tr>		                              
									      <td>{{$v->goods_id}}</td>
									      <td>{{$v->id}}</td>
									      <td>{{$v->stock_num}}</td>
									      <td>{{$v->seckill}}</td>
									      <td>
									      	<img alt="" src="{{Storage::url($v->logo)}}" width="50px" height="30px">
									      </td>						     								     
		                                  <td class="text-center">  
										  @if($v->seckill=='开始')                                                                                
		                                 	  <button type="button" class="btn bg-danger btn-xs" data-toggle="modal" onclick="shut({{$v->id}})">关闭</button>    
										  @else
										  <button type="button" class="btn bg-success btn-xs" data-toggle="modal" onclick="start({{$v->id}},{{$v->goods_id}})" data-target="#editModal">开启</button>  
										  @endif                                       
		                                  </td>
			                          </tr>
                                      @endforeach
			                      </tbody>
			                  </table>
			                  <!--数据列表/--> 
                        </div>
                        <!-- 数据表格 /-->
                        <div style="width:100%;text-align:center;">{{ $seckill->appends($req->all())->links() }}</div>
                     </div>
                    <!-- /.box-body -->

		
<!-- 编辑窗口 -->
<form action="{{route('Admin_seckill_start')}}" method="post">
{{csrf_field()}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">广告编辑</h3>
		</div>
        
		<div class="modal-body">
			
			<table class="table table-bordered table-striped"  width="800px">
				<tr>
		      		<td>秒杀的开始时间</td> 
		      		<td>
		      			<input type="date" name="start" id="" value="{{old('date')}}" class="form-control">
		      		</td>
                 @if($errors->first('start'))
                    <td style="color:red;font-size:20px;">{{$errors->first('start')}}</td>
                 @endif
                   
		      	</tr>
                  <tr>
		      		<td>秒杀的结束时间</td>
		      		<td>

                      <input type="date" name="over" id="" value="{{old('over')}}" class="form-control">

		      		</td>
                 @if($errors->first('over'))
                    <td style="color:red;font-size:20px;">{{$errors->first('over')}}</td>
                 @elseif(session()->get('error_over'))
                 <td style="color:red;font-size:20px;">{{session()->get('error_over')}}</td>
                 @endif
		      	</tr>
		      	<tr>
		      		<td>标题</td>
		      		<td><input  class="form-control" name='title' placeholder="标题" >  </td>
                 @if($errors->first('title'))
                    <td style="color:red;font-size:20px;">{{$errors->first('title')}}</td>
                 @endif 
		      	</tr>  	
			 </table>				
             
		</div>
		<div class="modal-footer">
        <input type="hidden" name="goods_id" id="goods_id" value=''>
        <input type="hidden" name = 'seckill_id' id="seckill_id" value=''>	
			<input type="submit" class="btn btn-success" value="保存">
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
	  </div>
	</div>
</div>
</form>
</body>

</html>
<script>

    function start(seckill_id,goods_id){

        $("#seckill_id").val(seckill_id);

        $("#goods_id").val(goods_id);

    }

    function shut(seckill_id){


        if(confirm('确定要关闭?')){

            var url = "{{route('Admin_seckill_close')}}";

            $.ajax({

                type:'get',

                url:url,

                data:{'seckill_id':seckill_id},

                dataType:'json',

                success:function(data){

                    if(data==1){

                        alert('关闭成功');

                        location.reload();

                    }

                }

            })

        }

    }

</script>