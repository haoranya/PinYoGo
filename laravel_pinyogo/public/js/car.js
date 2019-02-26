function add(k,price,user_id,id,all_num){

var key = "num"+k+user_id+id;

var obj = $("input[name='num"+k+user_id+id+"']");

var number =obj.val();

if(number==10||number>=all_num){

    alert('单次已经达到最多购买');

}else{

number++;

window.localStorage.setItem(key,number);

var value = window.localStorage.getItem(key);

obj.val(value);

$("#count"+k).html('￥'+value*price);

$("#checkbox"+k).val(value*price);

}

var count_money =0;

$("input[type=checkbox]:checked").each(function(){

    count_money+=Number($(this).val());

})

$(".summoney").html('￥'+count_money);

}

function reduce(k,price,user_id,id){

    var key = "num"+k+user_id+id;

    var obj = $("input[name='num"+k+user_id+id+"']");
    
    var number =obj.val();

    if(number==0){

        alert('不可为负数');

    }else{

        number--;
    
        window.localStorage.setItem(key,number);
        
        var value = window.localStorage.getItem(key);
        
        obj.val(value);
        
        $("#count"+k).html('￥'+value*price);

        $("#checkbox"+k).val(value*price);

    }

    var count_money =0;

    $("input[type=checkbox]:checked").each(function(){

        count_money+=Number($(this).val());

    })

    $(".summoney").html('￥'+count_money);
}


//单个复选框的
$(".checkbox").on('click',function(){

    var $this = $(this);

    var count_money =0;

    var fate = 0;

    if($this.is(':checked')){

        $("input[type=checkbox]:checked").each(function(){

            count_money+=Number($(this).val());

            fate++;

        })

    }else{

         $("input[type=checkbox]:checked").each(function(){

            count_money+=Number($(this).val());
            
        })

    }

    $(".summoney").html('￥'+count_money);

    $("#fate").html(fate);
    
})


//全选反选
$("#choose").on('click',function(){

    var $this = $(this);

    var count_money =0;

    var fate = 0;

    if($this.is(':checked')){
     
        $("input[type=checkbox]").each(function(){

            fate++;

            $(this).prop("checked", true);
    
        })

    }else{

        $("input[type=checkbox]").each(function(){

            fate = 1;

            $(this).prop("checked", false);
    
        })
    
    }


    $("input[type=checkbox]:checked").each(function(){

        count_money+=Number($(this).val());
        
    })

    $(".summoney").html('￥'+count_money);

    $("#fate").html(fate-1);

})




  









