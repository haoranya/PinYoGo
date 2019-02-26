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
                        <h3 class="box-title">商品管理</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i> 新建</button>
                                        <button type="button" class="btn btn-default" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
                                        <button type="button" class="btn btn-default" title="提交审核" ><i class="fa fa-check"></i> 提交审核</button>
                                        <button type="button" class="btn btn-default" title="屏蔽" onclick='confirm("你确认要屏蔽吗？")'><i class="fa fa-ban"></i> 屏蔽</button>
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                  状态：<select>
                                         	<option value="">全部</option>      
                                         	<option value="0">未申请</option>    
                                         	<option value="1">申请中</option>    
                                         	<option value="2">审核通过</option>    
                                         	<option value="3">已驳回</option>                                     
                                        </select>
							                  商品名称：<input >									
									<button class="btn btn-default" >查询</button>                                    
                                </div>
                            </div>
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
			                              <th class="" style="padding-right:0px">
			                                  <input id="selall" type="checkbox" class="icheckbox_square-blue">
			                              </th> 
										  <th class="sorting_asc">商品ID</th>
									      <th class="sorting">商品一级分类</th>
									      <th class="sorting">商品二级分类</th>
									      <th class="sorting">商品三级分类</th>
									      <th class="sorting">商品品牌ID</th>										  
									      <th class="sorting">商品名称</th>
									      <th class="sorting">商品价格</th>
									      <th class="sorting">商品的品牌</th>
									      <th class="sorting">三级分类</th>
									      <th class="sorting">状态</th>									     						
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
								   @foreach($data as $v)
			                          <tr>
			                              <td><input  type="checkbox"></td>			                              
				                          <td>{{$v->id}}</td>
				                          <td>{{$v->cat_one_id}}</td>
				                          <td>{{$v->cat_two_id}}</td>
				                          <td>{{$v->cat_three_id}}</td>
				                          <td>{{$v->brand_id}}</td>
									      <td>{{$v->goods_name}}</td>
									      <td>{{$v->price}}</td>
									      <td>{{$v->brand}}</td>
									      <td>{{$v->goods_type}}</td>
		                                  <td>
		                                  	<span>
		                                  		{{$v->goods_state}}
		                                  	</span>
		                                  </td>		                                  
		                                  <td class="text-center">
										     <a class="btn btn-warning btn-xs" href='{{route("Admin_goods_price")}}?id={{$v->id}}' >价格</a>            										  	     
										     <a class="btn btn-warning btn-xs" href='{{route("Admin_edit_price")}}?id={{$v->id}}' >价改</a>       										  	     
		                                 	 <a class="btn btn-warning btn-xs" href='{{route("Admin_goods_update")}}?id={{$v->id}}' >修改</a>               
		                                 	 <a class="btn btn-danger btn-xs" href='{{route("Admin_goods_del")}}?id={{$v->id}}' >删除</a>               
		                                  </td>
			                          </tr>
									  @endforeach
			                      </tbody>
			                  </table>
			                  <!--数据列表/-->                        

							 <div style="width:100%;text-align:center;">{{ $data->appends($req->all())->links() }}</div> 
							 
                        </div>
                        <!-- 数据表格 /-->
                        
                        
                     </div>
                    <!-- /.box-body -->
		
</body>

</html>