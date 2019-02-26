<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商品分类管理</title>
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

<body class="hold-transition skin-red sidebar-mini" >
  <!-- .box-body -->
                
                    <div class="box-header with-border">
                        <h3 class="box-title">商品类型品牌管理</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" title="新建" data-toggle="modal" data-target="#editModal" ><i class="fa fa-file-o"></i> 新建</button>
                                        <button type="button" class="btn btn-default" title="删除"><i class="fa fa-trash-o"></i> 删除</button>
                                       
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
							                  分类模板名称：<input  >									
									<button class="btn btn-default">查询</button>                                    
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
                                          <th class="sorting_asc">一级分类ID</th>
                                          <th class="sorting">二级分类ID</th>
									      <th class="sorting">三级分类ID</th>
									      <th class="sorting">一级分类名称<span style="float:right" >操作</span></th>
									      <th class="sorting">二级分类名称<span style="float:right" >操作</span></th>
									      <th class="sorting">三级分类名称<span style="float:right" >操作</span></th>						     						
			                          </tr>
			                      </thead>
			                      <tbody>
                                      @foreach($type_arr as $k=>$v)
			                          <tr>  
			                              <td><input  type="checkbox"></td>	                              
                                          <td>{{$v[1]['one']['id']}}</td>
                                          <td>{{$v[1]['id']}}</td>
                                          <td>{{$v['id']}}</td>
                                          <td>  
                                               {{$v[1]['one']['goods_type']}}

                                                 @if($v==null)
                                                   
								                 @elseif($type_arr[$k+1][1]['one']['id']!=$v[1]['one']['id'])
                                                 <a style="float:right" class="btn btn-xs btn-warning" href='{{route("Admin_update_type")}}?id={{$v[1]['one']['id']}}&level={{$v[1]['one']['level']}}' >一级修改</a>
                                                 <a style="float:right" class="btn btn-xs btn-danger" href='{{route("Admin_del_type")}}?id={{$v[1]['one']['id']}}&level={{$v[1]['one']['level']}}' >一级删除</a>
								                 @endif

                                          </td>
                                          <td>
                                               {{$v[1]['goods_type']}}
                                               @if($v==null)
								
                                               @elseif($type_arr[$k+1][1]['id']!=$v[1]['id'])
                                               <a style="float:right" class="btn btn-xs btn-warning" href='{{route("Admin_update_type")}}?id={{$v[1]['id']}}&level={{$v[1]['level']}}' >二级修改</a>
                                               <a style="float:right" class="btn btn-xs btn-danger" href='{{route("Admin_del_type")}}?id={{$v[1]['id']}}&level={{$v[1]['level']}}' >二级删除</a>
                                               @endif
                                         </td>			                                                                 
                                          <td>
                                               {{$v['goods_type']}}
                                               @if($v==null)
                                               @else
                                               <a style="float:right" class="btn btn-xs btn-warning" href='{{route("Admin_update_type")}}?id={{$v['id']}}&level={{$v['level']}}' >三级修改</a>
                                               <a style="float:right" class="btn btn-xs btn-danger" href='{{route("Admin_del_type")}}?id={{$v['id']}}&level={{$v['level']}}' >三级删除</a>
                                               @endif
                                        </td>				                                                                 
                                      </tr>
                                      @endforeach
			                      </tbody>
			                  </table>
			                  <!--数据列表/-->                        
							  
                              <div style="width:100%;text-align:center;">{{ $types->appends($req->all())->links() }}</div>
                        </div>
                        <!-- 数据表格 /-->
                        
                        
                       
                        
                     </div>
                    <!-- /.box-body -->
                    
	           
					    
                                
<!-- 编辑窗口 -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">商品类型模板编辑</h3>
        </div>
        <form action="{{route('Admin_add_type')}}" method="post">
            {{csrf_field()}}
		<div class="modal-body">			
             <table class="table table-bordered table-striped"  width="800px">
                 <tr>
                    
                      @if(session()->get('error_goods_type'))
					  <td style="color:red;font-size:20px;">{{session()->get('error_goods_type')}}</td>				
					  @endif 

                 </tr>
                 <tr>
		      		<td>一级分类</td>
                      <td><input  class="form-control" name="goods_type[]"  placeholder="一级类型"></td> 
                 </tr>
                 <tr>
		      		<td>二级分类</td>
                      <td><input  class="form-control" name="goods_type[]" placeholder="二级类型"></td>
                 </tr>
                  <tr>
		      		<td>三级分类</td>
                      <td><input  class="form-control" name="goods_type[]" placeholder="三级类型"></td>
                 </tr>
			 </table>
        </div>
        <div class="modal-footer">
			<input type="submit" class="btn btn-success" value="保存">
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
        </form>
		
	  </div>
	</div>
</div>
    
</body>

</html>