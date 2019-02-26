@extends("Front/layouts/footer")
 @section('footer')
  @extends("Front/layouts/head")
	 @section('head')
	 @endsection('head')


<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/widget/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/widget/nav.js"></script>
<script type="text/javascript" src="js/pages/seckill-index.js"></script>
<script>
	   $(function(){
		   $("#code").hover(function(){
			   $(".erweima").show();
		   },function(){
			   $(".erweima").hide();
		   });
	   })
	</script>
</body>

	<div class="py-container index">
		<!--banner-->
		<div class="banner">
			<img src="img/_/banner.png" class="img-responsive" alt="">
		</div>

		<!--商品列表-->
		<div class="goods-list">
			<ul class="seckill" id="seckill">
				@foreach($seckill_arr as $seckill)
				<li class="seckill-item" >
					<div class="pic" onclick="location.href='{{ route('Front_seckill_item') }}?goods_id={{$seckill->goods_id}}'">
						<img src="{{Storage::url($seckill->goods_image->logo)}}" alt=''  >
					</div>
					<div class="intro"><span>{{$seckill->title}}</span></div>
					<div class='price'><b class='sec-price'>￥{{$seckill->goods_info->price}}</b>
					<div class='num'>
						<div>已售{{$seckill->goods_info->number-($seckill->seckill_num)/$seckill->goods_info->number}}%</div>
						<div class='progress'>
							<div class='sui-progress progress-danger'><span style='width: {{$seckill->goods_info->number-($seckill->seckill_num)/$seckill->goods_info->number}}%;' class='bar'></span></div>
						</div>
						<div><p class='owned'>剩余{{$seckill->seckill_num}}件</p></div>
					</div>
					<a class='sui-btn btn-block btn-buy' href="{{ route('Front_seckill_item') }}?goods_id={{$seckill->goods_id}}" target='_blank'>立即抢购</a>
				</li>
	   			@endforeach
			</ul>
		</div>
		<div class="cd-top">
			<div class="top">
				<img src="img/_/gotop.png" />
				<b>TOP</b>
			</div>
			<div class="code" id="code">
				<span><img src="img/_/code.png"/></span>
			</div>
			<div class="erweima">
				<img src="img/_/erweima.jpg" alt="">
				<s></s>
			</div>
		</div>
	</div>

	<!--回到顶部-->

	<!-- 底部栏位 -->
@endsection('footer')