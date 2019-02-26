function hit(attr_id,spec_id,goods_id){
    
   var obj = $("a[attr="+attr_id+"]");

   obj.each(function(){

        $(this).attr('class','');

   });

   $("a[spec="+spec_id+"]").attr('class','selected');

   var spec_id = '';

   $(".selected").each(function(){

        spec_id += $(this).attr('spec')+"-";

   });

   var url = 'Admin_ajax_price';
  
   $.ajax({

       type:'GET',
       url:url,
       data:{'spec_id':spec_id,'goods_id':goods_id},
       success:function(data){

          $("#price").html(data['price']);

          $("#goods_price").val(data['price']);

       }

   })
   
}


function add(){

    var obj = $("input[name='number']");

    var value = obj.val();

    if(value==10){

        alert('一次性最多购买10个');

    }else{

        value++;
        
        obj.val(value);


    }

}

function reduce(){

    var obj = $("input[name='number']");

    var value = obj.val();

    if(value==1){

        alert('至少要购买一个');

    }else{

        value--;
        
        obj.val(value);


    }

}

function btn(){
    
    var obj = $("a[class='selected']");
    var spec_id = '';
    obj.each(function(){

        spec_id += $(this).attr('spec')+'-';

    });

    $("input[name='spec_id']").val(spec_id);

    $("#form_add_cart").submit();

}