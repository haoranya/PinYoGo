$(function(){
	$(".address").hover(function(){
		$(this).addClass("address-hover");	
	},function(){
		$(this).removeClass("address-hover");	
	});
})

$(function(){


	// $(".addr-item .name").click(function(){

	// 	 $(".addr-item .name").each(function(){

	// 		$(this).attr('class','con name')

	// 	 })

	// 	 $(this).toggleClass("selected").siblings().removeClass("selected");


	// });




	$(".payType li").click(function(){

		$(".payType li").each(function(){

			$(this).attr('class','');

		 })


		 $(this).toggleClass("selected").siblings().removeClass("selected");	
	});


})
