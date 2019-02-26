<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商家审核</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../css/style.css">
	<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    
</head>

<body class="hold-transition skin-red sidebar-mini"  >
  <!-- .box-body -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">商家审核</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
							        公司名称：<input  >
									店铺名称： <input  >									
									<button class="btn btn-default" >查询</button>                                    
                                </div>
                            </div>
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
										  <th class="sorting_asc">商家ID</th>
									      <th class="sorting">公司名称</th>
									      <th class="sorting">店铺名称</th>
									      <th class="sorting">联系人姓名</th>
									      <th class="sorting">公司电话</th>
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
								   @foreach($admin as $v)
									  <tr>		                              
				                          <td>{{$v->id}}</td>
									      <td>{{$v->company}}</td>
									      <td>{{$v->shop}}</td>
									      <td>{{$v->name}}</td>
									      <td>{{$v->tel}}</td>
		                                  <td class="text-center">
										  @if($v->shop_state=='审核成功')
										  <button type="button" class="btn bg-olive btn-xs" data-toggle="modal" data-target="#sellerModal{{$v->id}}" >详情</button>
										  <button onclick="if(confirm('确认要驳回么?')){location.href='Manager_shop_stop?id={{$v->id}}'}" class="btn bg-danger btn-xs" >驳回</button>
										  @elseif($v->shop_state=='驳回')
										  <button type="button" class="btn bg-olive btn-xs" data-toggle="modal" data-target="#sellerModal{{$v->id}}" >详情</button>  										   
										  <button onclick="if(confirm('确认要通过么?')){location.href='Manager_shop_start?id={{$v->id}}'}" class="btn bg-success btn-xs" >通过</button>
										  @else  
										  <button type="button" class="btn bg-olive btn-xs" data-toggle="modal" data-target="#sellerModal{{$v->id}}" >详情</button>  										  
										  <button onclick="if(confirm('确认要通过么?')){location.href='Manager_shop_start?id={{$v->id}}'}" class="btn bg-success btn-xs" >通过</button>
										  <button onclick="if(confirm('确认要驳回么?')){location.href='Manager_shop_stop?id={{$v->id}}'}" class="btn bg-danger btn-xs" >驳回</button>
										  @endif                                          
		                                  </td>
			                          </tr>
									@endforeach
			                      </tbody>
			                  </table>
			                  <!--数据列表/-->                        
							  
							 
                        </div>
                        <!-- 数据表格 /-->
						<div style="width:100%;text-align:center;">{{ $admin->appends($req->all())->links() }}</div>
                        
                        
                        
                     </div>
                    <!-- /.box-body -->
                    
	          
					    
                                
<!-- 商家详情 -->
@foreach($admin as $v)
<div class="modal fade" id="sellerModal{{$v->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">商家详情</h3>
		</div>
		<div class="modal-body">							
			
			 <ul class="nav nav-tabs">
			  <li class="active"><a href="#home" data-toggle="tab">基本信息</a></li>
			  <li><a href="#linkman" data-toggle="tab">联系人</a></li>
			  <li><a href="#certificate" data-toggle="tab">证件</a></li>
			  <li><a href="#ceo" data-toggle="tab">法定代表人</a></li>
			  <li><a href="#bank" data-toggle="tab">开户行</a></li>
			</ul>							
			
			<!-- 选项卡开始 -->         
		    <div id="myTabContent" class="tab-content">
			    <div class="tab-pane active in" id="home">
			      <br>
			      <table class="table table-bordered table-striped"  width="800px">
			      	<tr>
			      		<td>公司名称</td>
			      		<td>{{$v->company}}</td>
			      	</tr>
			      	<tr>
			      		<td>公司电话</td>
			      		<td>{{$v->tel}}</td>
			      	</tr>
			      	<tr>
			      		<td>公司详细地址</td>
			      		<td>{{$v->company_location}}</td>
			      	</tr>
			      </table>			      
      			</div>	
			    <div class="tab-pane fade" id="linkman">
			    	<br>
					<table class="table table-bordered table-striped" >
			      	<tr>
			      		<td>真实姓名</td>
			      		<td>{{$v->name}}</td>
			      	</tr>
			      	<tr>
			      		<td>联系人QQ</td>
			      		<td>{{$v->QQ}}</td>
			      	</tr>
			      	<tr>
			      		<td>联系人手机</td>
			      		<td>{{$v->phone}}</td>
			      	</tr>
			      	<tr>
			      		<td>联系人E-Mail</td>
			      		<td>{{$v->email}}</td>
			      	</tr>
			      </table>
			    </div>
			    <div class="tab-pane fade" id="certificate">
					<br>
					<table class="table table-bordered table-striped" >
				      	<tr>
				      		<td>营业执照号</td>
				      		<td>{{$v->business}}</td>
				      	</tr>
				      	<tr>
				      		<td>税务登记证号</td>
				      		<td>{{$v->tax}}</td>
				      	</tr>
				      	<tr>
				      		<td>组织机构代码证号</td>
				      		<td>{{$v->organize}}</td>
				      	</tr>				      	
			     	</table>
			    </div>
			    <div class="tab-pane fade" id="ceo">
					<br>
					<table class="table table-bordered table-striped" >
				      	<tr>
				      		<td>法定代表人</td>
				      		<td>{{$v->legal}}</td>
				      	</tr>
				      	<tr>
				      		<td>法定代表人身份证号</td>
				      		<td>{{$v->legal_ID}}</td>
				      	</tr>					   			      	
			     	</table>
			    </div>
			    <div class="tab-pane fade" id="bank">
					<br>
					<table class="table table-bordered table-striped" >
				      	<tr>
				      		<td>开户行名称</td>
				      		<td>{{$v->bank}}</td>
				      	</tr>
				      	<tr>
				      		<td>开户行支行</td>
				      		<td>{{$v->branck}}</td>
				      	</tr>		
				      	<tr>
				      		<td>银行账号</td>
				      		<td>{{$v->bank_ID}}</td>
				      	</tr>			   			      	
			     	</table>					
			    </div>
  			    </div> 			
           <!-- 选项卡结束 -->          
			
			
		</div>
		<div class="modal-footer">						
			<button onclick="if(confirm('确认要删除么?')){location.href='Manager_shop_del?id={{$v->id}}'}" class="btn btn-danger btn-xs" >删除商家</button>
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
	  </div>
	</div>
</div>
@endforeach

</body>

</html>