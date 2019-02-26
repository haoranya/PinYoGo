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
  <!-- .box-body -->
                
                    <div class="box-header with-border">
                        <h3 class="box-title">商品审核</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">                        
                                        <button type="button" class="btn btn-default" title="刷新" ><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    商品名称：<input >
									<button class="btn btn-default" >查询</button>                                    
                                </div>
                            </div>
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
										  <th class="sorting_asc">商品ID</th>
									      <th class="sorting">商品名称</th>
									      <th class="sorting">商品价格</th>
									      <th class="sorting">一级分类</th>
									      <th class="sorting">二级分类</th>
									      <th class="sorting">三级分类</th>
									      <th class="sorting">状态</th>									     						
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
			                        @foreach($goods_arr as $goods)
									   <tr>
				                          <td>{{$goods->id}}</td>
									      <td>{{$goods->goods_name}}</td>
									      <td>{{$goods->price}}</td>
									      <td>{{$goods->cat_one_name}}</td>
									      <td>{{$goods->cat_two_name}}</td>
									      <td>{{$goods->cat_three_name}}</td>
		                                  <td>	                                 
		                                  	
		                                  	<span>
		                                  		{{$goods->goods_state}}
		                                  	</span>
		                                  </td>		                                  
		                                  <td class="text-center">
										  @if($goods->goods_state=='审核通过')
										  <a onclick="if(confirm('确定要驳回么?')){ location.href='Manager_goods_no?id={{$goods->id}}' }" class="btn btn-default" title="驳回" >驳回</a>
										  @elseif($goods->goods_state=='已驳回')
										  <a onclick="if(confirm('确定要通过审核么?')){ location.href='Manager_goods_ok?id={{$goods->id}}' }" class="btn btn-default" title="审核通过" > 审核通过</a>
										  @else
										  <a onclick="if(confirm('确定要通过审核么?')){ location.href='Manager_goods_ok?id={{$goods->id}}' }" class="btn btn-default" title="审核通过" > 审核通过</a>
                                          <a onclick="if(confirm('确定要驳回么?')){ location.href='Manager_goods_no?id={{$goods->id}}' }" class="btn btn-default" title="驳回" >驳回</a>                            
		                                  @endif
										 </td>
			                          </tr>
									@endforeach
			                      </tbody>
			                  </table>
			                  <!--数据列表/-->                        
							  
							 
                        </div>
                        <!-- 数据表格 /-->
                        
                        <div style="width:100%;text-align:center;">{{ $goods_info->appends($req->all())->links() }}</div>
                     </div>
                    <!-- /.box-body -->
        
</body>

</html>