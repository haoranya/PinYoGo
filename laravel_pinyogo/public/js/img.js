$("#file").change(function(){
	//获取到上传的图片
	var logo = this.files[0];
	//转换图片为可访问字符串
	var str = getObjectUrl(logo);
	//添加图片之前先删除原来的
	$(this).parent().parent().prev().remove();

	$(this).parent().parent().before('tr><td>上传LOGO : <img src="'+str+'" width="200px" height="200px"></td></tr>');

})

//转换图片为可访问的字符串

function getObjectUrl(file) {
  var url = null;
  if (window.createObjectURL != undefined) {
	  url = window.createObjectURL(file)
  } else if (window.URL != undefined) {
	  url = window.URL.createObjectURL(file)
  } else if (window.webkitURL != undefined) {
	  url = window.webkitURL.createObjectURL(file)
  }
  return url
}



$("#add").click(function(){	

$(this).parent().parent().before('<tr> <td>选择你商品的样式图</td><td><input type="file" name="img[]" id="file" /></td><td><input type="button" class="btn btn-danger" onclick="del_(this)" value="删除"></td></tr>');


})

function del_(e){

if(confirm('确定删除么?')){

$(e).parent().parent().remove();

}

}

function del_img(e,val){

$del_info = $("#del_info").val();

$del_info+=","+val;

$(e).parent().parent().remove();

$("#del_info").val($del_info);

}

function cut(route){


	if(confirm('确定删除么?')){

		location.href=route;

	}

}

