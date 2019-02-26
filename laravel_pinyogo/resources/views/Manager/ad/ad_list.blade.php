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
  <!-- .box-body -->
                
                    <div class="box-header with-border">
                        <h3 class="box-title">广告管理</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
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
			                          <tr>
										  <th class="sorting_asc">广告ID</th>
									      <th class="sorting">分类ID</th>
									      <th class="sorting">标题</th>
									      <th class="sorting">URL</th>		
									      <th class="sorting">图片</th>	
									      <th class="sorting">排序</th>		
									      <th class="sorting">是否有效</th>											     						      							
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
                                  @foreach($ads as $ad)
			                          <tr>		                              
				                          <td>{{$ad->id}}</td>
									      <td>{{$ad->ad_type_id}}</td>
									      <td>{{$ad->ad_title}}</td>
									      <td>{{$ad->url}}</td>
									      <td>
									      	<img alt="" src="{{Storage::url($ad->ad_logo)}}" width="100px" height="50px">
									      </td>
									      <td>{{$ad->sort}}</td>
									      <td>{{$ad->ad_state}}</td>									     								     
		                                  <td class="text-center">   
                                          @if($ad->ad_state=='无效')
                                          <button type="button" class="btn btn-default" title="开启" onclick='if(confirm("你确认要开启吗？")){location.href="Manager_ad_start?id={{$ad->id}}"}'><i class="fa fa-check"></i> 开启</button>
                                          @else
                                          <button type="button" class="btn btn-default" title="屏蔽" onclick='if(confirm("你确认要屏蔽吗？")){location.href="Manager_ad_stop?id={{$ad->id}}"}'><i class="fa fa-ban"></i> 屏蔽</button>                                        
                                          @endif
                                          </td>
			                          </tr>
                                 @endforeach
			                      </tbody>
			                  </table>
			                  <!--数据列表/--> 
                        </div>
                        <!-- 数据表格 /-->
                        <div style="width:100%;text-align:center;">{{ $ads->appends($req->all())->links() }}</div>
                     </div>
                    <!-- /.box-body -->


</body>

</html>