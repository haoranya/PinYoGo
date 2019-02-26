<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\GoodsRequest;

use App\Http\Requests\TypeRequest;

use App\Http\Requests\Brand_add_Request;

use App\Http\Requests\ImageRequest;

use App\Http\Requests\Goods_updateRequest;

use App\Models\Goods_type;

use App\Models\Brand;

use App\Models\Good;

use App\Models\Attribute;

use App\Models\Spec;

use App\Models\Goods_image;

use App\Models\Seckill;

use App\Models\Attr_spec;

use DB;

use Storage;

//图片的处理需要下载依赖包

use Intervention\Image\ImageManagerStatic as Image;

class Admin_indexController extends Controller
{

   
    function index(){

        return view("Admin.index.index");

    }
    function goods(Request $req){

        $brand = new Goods_type;

        $data = DB::table('goods')  
        ->leftjoin('goods_types', 'goods.cat_three_id', '=', 'goods_types.id')
        ->leftjoin('brands', 'brands.id', '=', 'goods.brand_id')
        ->select(
            'goods.id','goods_name','goods_state','cat_one_id','cat_two_id','cat_three_id',
            'brand_id','price','desc','serve','packing','shop_id','goods_type','brand','ucfirst_brand','brand_id')
        ->where('goods.shop_id',session()->get('admin_id'))
        ->paginate(1);
    
        return view("Admin.index.goods",['data'=>$data,'req'=>$req]);

    }
    function seller(){

        return view("Admin.index.seller");

    }
    function goods_edit(){

        $parent_id = 0;

        $type = Goods_type::where('parent_id',$parent_id)->get();

        return view("Admin.index.goods_edit",['type'=>$type]);

    }

    function goods_type(){

        $parent_id = isset($_GET['parent_id'])?$_GET['parent_id']:0;

        $type = Goods_type::where('parent_id',$parent_id)->get();

        return $type;

    }

  function brand(){

        $goods_type_id = $_GET['goods_type_id'];

        $brand = Brand::where('goods_type_id',$goods_type_id)->get();

        return $brand;

    }

    function brand_page(Request $req){

        $types = Goods_type::where('level',1)->get();

        $brands = Brand::where('admin_id',session()->get('admin_id'))->paginate(5);

        foreach($brands as $v){

            $goods_id = $v['goods_type_id'];

            $goods_names = Goods_type::where('id',$goods_id)->first(['goods_type','id']);

            $goods_name = $goods_names['goods_type'];

            $v['goods_name']=$goods_name;

            $v['three_type_id'] = $goods_names['id'];

        }

        return view("Admin.index.goods_brand",['brands'=>$brands,'req'=>$req,'type'=>$types]);

    }

    function add_brand(Brand_add_Request $req){

        $brand = new Brand;

        $old_brand = $brand->where('brand',$req->brand)->first();

        if($old_brand!=null){

            return back()->withInput()->with('error_brand','不可以添加相同的品牌');

        }
        
        $brand->fill($req->all());

        $brand->goods_type_id =$req->cat_three_id;

        $brand->admin_id = session()->get('admin_id');
        
        $brand->save();

        return "<script>if(confirm('添加成功,是否继续添加?')){location.href='Admin_brand_page';}else{location.href='Admin_brand_page';}</script>";

    }

    function update_brand(){

        $types = Goods_type::where('level',1)->get();

        $id = $_GET['id'];

        $parent_id = $_GET['type_id'];

        $goods_type_id = [];

        $goods_type_id[0]= (int)$parent_id;

        while($parent_id!=0){

            $type = Goods_type::find($parent_id);

            $parent_id = $type->parent_id;

            $goods_type_id[]=$parent_id;

        }

        unset($goods_type_id[3]);

        $brand = Brand::find($id);

        return view('Admin.index.brand_update',['type'=>$types,'brand'=>$brand,'goods_type_id'=>$goods_type_id]);

    }

    function doupdate_brand(Brand_add_Request $req){

          Brand::where('id',$req->id)->update(['brand'=>$req->brand,'ucfirst_brand'=>$req->ucfirst_brand,'goods_type_id'=>$req->cat_three_id]);

          return "<script>if(confirm('修改成功,是否继续修改?')){location.href='Admin_brand_page';}else{location.href='Admin_brand_page';}</script>";

    }

    function del_brand(){

        $data = $_GET['data'];

        $id_arr = explode(',',$data);

        foreach($id_arr as $id){

            Brand::where("id",$id)->delete();

            Good::where("brand_id",$id)->delete();

        }

        echo true;

    }

    function goods_types(Request $req){

        $level = 3;

        $types = Goods_type::where('level',$level)->where('admin_id',session()->get('admin_id'))->paginate(5);

        $type_arr=[];

        foreach($types as $k=>$v){

            $type_arr[$k]=$v;

            $parent_id = $v->parent_id;

            $type = Goods_type::where('id',$parent_id)->get();

            foreach($type as $kk=>$vv){

                $type_arr[$k][$kk+1]=$vv;

                $parent_id = $vv->parent_id;

                $type = Goods_type::where('id',$parent_id)->get();

                $type_arr[$k][$kk+1]['one']=$type[0];

            }
        }

        array_push( $type_arr,null);//添加元素

        return view("Admin.index.goods_types",['type_arr'=>$type_arr,'req'=>$req,'types'=>$types]);

    }

    function add_type(Request $req){

        foreach($req->goods_type as $k=>$v){

            if($req->goods_type[$k]==null){

                return back()->withInput()->with('error_goods_type','分类不能为空');
    
            }

        }

        $goods_types = $req->goods_type;

        $parent_id = 0;

        $level = 1;

        foreach($goods_types as $v){    

           $id = Goods_type::where('goods_type',$v)->where('level',$level)->get(['id']);
          
           if(json_encode($id)!='[]'){

             $parent_id = $id[0]['id'];

             $level++;

             continue ;

           }

           DB::table('goods_types')->insert(['goods_type'=>$v,'parent_id'=>$parent_id,'level'=>$level,'admin_id'=>session()->get('admin_id')]); 

           $parent_id = DB::getPdo()->lastInsertId();

           $level++;

        }

        return "<script>if(confirm('添加成功,是否继续添加?')){location.href='Admin_goods_types';}else{location.href='Admin_goods_types';}</script>";

    }

    function update_type(){

        $level = $_GET['level'];
        $type_one = [];
        if($level!=1){

            $type_one = $this->goods_type();

        }

        $type_id =  $_GET['id'];

        $type = Goods_type::find($type_id);

        $parent_id = $type->parent_id;

        $goods_type = [];

        $type_id = [];

         while($parent_id>0){

            $type_info = Goods_type::find($parent_id);

            $parent_id  = $type_info->parent_id;

            $id =  $type_info->id;

            $type_name = $type_info->goods_type;

            $goods_type [] = $type_name;

            $type_id [] = $id;

        }

        if($type_id==[]){

            $type_id[0]=0;
        }

        return view("Admin.index.update_type",['type_one'=>$type_one,'type'=>$type,'goods_type'=>$goods_type,'type_id'=>$type_id,'level'=>$level]);

    }

    function type_doupdate(TypeRequest $req){

            if($req->cat_two_id){

                $cat_two_id = $req->cat_two_id;

                $goods_type = $req->goods_type;

                $id = $req->type_id;

                Goods_type::where('id',$id)->update(['goods_type'=>$goods_type,'parent_id'=>$cat_two_id]);
                
            }else if($req->cat_one_id){

                $cat_one_id = $req->cat_one_id;

                $goods_type = $req->goods_type;
                
                $id = $req->type_id;

                Goods_type::where('id',$id)->update(['goods_type'=>$goods_type,'parent_id'=>$cat_one_id]);

            }else{

                $id = $req->type_id;

                $goods_type = $req->goods_type;

                Goods_type::where('id',$id)->update(['goods_type'=>$goods_type]);

            }

            return "<script>if(confirm('修改成功,是否继续修改?')){location.href='Admin_goods_types';}else{location.href='Admin_goods_types';}</script>";
           
    }


    function del_type(){

        $level = $_GET['level'];

        $id = $_GET['id'];

        if($level==3){

            Goods_type::where('id',$id)->where('admin_id',session()->get('admin_id'))->delete();

            Brand::where('goods_type_id',$id)->where('admin_id',session()->get('admin_id'))->delete();

            Good::where("brand_id",$id)->where('shop_id',session()->get('admin_id'))->delete();

        }else if($level==2){

            $three_id = Goods_type::where('parent_id',$id)->where('admin_id',session()->get('admin_id'))->get(['id']);

            foreach($three_id as $v){

                Goods_type::where('id',$v['id'])->where('admin_id',session()->get('admin_id'))->delete();

                Brand::where('goods_type_id',$v['id'])->where('admin_id',session()->get('admin_id'))->delete();

                Good::where('brand_id',$v['id'])->where('shop_id',session()->get('admin_id'))->delete();

            }

              Goods_type::where('id',$id)->where('admin_id',session()->get('admin_id'))->delete();


        }else{

            $two_id = Goods_type::where('parent_id',$id)->where('admin_id',session()->get('admin_id'))->get(['id']);

            foreach($two_id as $v){

                $three_id = Goods_type::where('parent_id',$v['id'])->where('admin_id',session()->get('admin_id'))->get(['id']);

                foreach($three_id as $vv){

                    Goods_type::where('id',$vv['id'])->where('admin_id',session()->get('admin_id'))->delete();

                    Brand::where('goods_type_id',$vv['id'])->where('admin_id',session()->get('admin_id'))->delete();

                    Good::where('brand_id',$vv['id']);

                }

                Goods_type::where('id',$v['id'])->where('admin_id',session()->get('admin_id'))->delete();

            } 

            Goods_type::where('id',$id)->where('admin_id',session()->get('admin_id'))->delete();

        }


        return "<script>if(confirm('删除成功,是否继续删除?')){location.href='Admin_goods_types';}else{location.href='Admin_goods_types';}</script>";

    }

    function goods_add(GoodsRequest $req){

        foreach($req->attribute as $k=>$v){

            if($req->attribute[$k]==null){
           
                return back()->withInput()->with('error_attr','属性不能为空');
    
            }

        }

        foreach($req->spec as $k=>$v){

            if($req->spec[$k]==null){
           
                return back()->withInput()->with('error_spec','规格不能为空');
    
            }

        }

        $goods = new Good;

        $attribute = new Attribute;

        $spec = new Spec;

        $attribute_data = $req->attribute;

        $spec_data = $req->spec;
        
        $goods->fill($req->all());

        $goods->shop_id = session()->get('admin_id')?session()->get('admin_id'):0;

        $goods->save();

        $goods_id = $goods->id;

        $seckill_state = $req->seckill_state;

        if($seckill_state=='秒杀'){

            Seckill::insert(['goods_id'=>$goods_id,'stock_num'=>$req->number,'admin_id'=>session()->get('admin_id'),'seckill_num'=>$req->number]);

        }

        $goods_id = $goods->id;

        $arr=[];

        for($i=0;$i<count($attribute_data);$i++){

            $arr[$attribute_data[$i]][]=$spec_data[$i];
        }

        $attr_id = [];

        foreach($arr as $k=>$v){

            $attribute->attribute = $k;

            DB::table('attributes')->insert(['attribute'=>$k,'goods_id'=>$goods_id]);

            $id = DB::getPdo()->lastInsertId();

            $attr_id[]=$id;

            foreach($v as $vv){

                DB::table('specs')->insert(['spec'=>$vv,'attribute_id'=>$id]);

            }

        }

        return "<script>if(confirm('添加成功,请等待审核,是否继续添加?')){location.href='Admin_goods_edit';}</script>";

    }

    function goods_update(Request $req){

        $id = $req->id;

        $goods_info = Good::find($id);

        $types = Goods_type::where('level',1)->get();

        $attrs = Attribute::where('goods_id',$id)->get();

        $attrs_id_arr = [];

        foreach($attrs as $attr){

            $attrs_id_arr[][$attr['attribute']]=$attr['id'];

        }

        $spec_info = [];

        foreach($attrs_id_arr as $attr_id){

            foreach($attr_id as $k=>$v){

                $specs = Spec::where('attribute_id',$v)->get();

                foreach($specs as $spec){

                    $spec->attr_name = $k;

                    $spec_info[]=$spec;

                }

            }

        }
        array_push( $spec_info,null);//添加元素
       
        return view("Admin.index.goods_update",['type'=>$types,'goods_info'=>$goods_info,'spec_info'=>$spec_info]);

    }

    function goods_doupdate(Goods_updateRequest $req){

        if($req->attribute!=null){

            foreach($req->attribute as $k=>$v){

                if($req->attribute[$k]==null){
               
                    return back()->withInput()->with('error_attr','属性不能为空');
        
                }
    
            }

        }

       if($req->spec!=null){

        foreach($req->spec as $k=>$v){

            if($req->spec[$k]==null){
           
                return back()->withInput()->with('error_spec','规格不能为空');
    
            }

        }

       }

        $goods_id = $_GET['id'];

        $goods_name = $req->goods_name;

        $cat_one_id = $req->cat_one_id;

        $cat_two_id = $req->cat_two_id;

        $cat_three_id = $req->cat_three_id;

        $brand_id = $req->brand_id;

        $price = $req->price;

        $number = $req->number;

        $seckill_state = $req->seckill_state;

        if($seckill_state=='秒杀'){

            $seckill = Seckill::where('goods_id',$goods_id)->first();

            if(!$seckill){

                Seckill::insert(['goods_id'=>$goods_id,'stock_num'=>$number]);

            }

        }else{

            $seckill = Seckill::where('goods_id',$goods_id)->first();

            if($seckill){

                Seckill::where('goods_id',$goods_id)->delete();

            }

        }

        $desc = $req->desc;

        $serve = $req->serve;

        $packing = $req->packing;

        $del_attr = $req->del_attr;

        $del_spec = $req->del_spec;

        $attr_arr = $req->attribute;

        $spec_arr = $req->spec;
        //商品的更新

        Good::where('id',$goods_id)->update(['goods_name'=>"$goods_name",'cat_one_id'=>$cat_one_id,'cat_two_id'=>$cat_two_id,'cat_three_id'=>$cat_three_id,'brand_id'=>$brand_id,'price'=>$price,'number'=>$number,'seckill_state'=>$seckill_state,'desc'=>"$desc",'serve'=>"$serve",'packing'=>"$packing"]);
            
        if($del_attr!=null){//判断是否删除了原来的属性

            $attr_id_arr = explode(',',$del_attr);

            foreach($attr_id_arr as $attr_id){

                if($attr_id!=''){

                    Attribute::where('id',$attr_id)->delete();

                    Spec::where('attribute_id',$attr_id)->delete();

                }
            }

        }

        if($del_spec!=null){//判断是否删除了原来的属性下的规格

            $spec_id_arr = explode(',',$del_spec);

            foreach($spec_id_arr as $spec_id){

                if($spec_id!=''){

                    Spec::where('id',$spec_id)->delete();

                }
            }

        }

        if($attr_arr!=null){//判断是否添加了新的属性

            // dd($attr_arr);

            $arr=[];

            for($i=0;$i<count($attr_arr);$i++){

                $arr[$attr_arr[$i]][]=$spec_arr[$i];
            }

            // dd($arr);
    
            foreach($arr as $attr=>$spec){//添加新的属性下对应的规格

                    // dd($attr);

                   $attr_info = Attribute::where('attribute',$attr)->where('goods_id',$goods_id)->first();//判断要添加的属性是否已经存在

                   if($attr_info==null){//不存在就添加

                      DB::table('attributes')->insert(['attribute'=>$attr,'goods_id'=>$goods_id]);
    
                      $attr_id = DB::getPdo()->lastInsertId();

                    //   dd($attr_id);
 
                   }else{

                    $attr_id = $attr_info->id;

                   }
                //    dd($attr_id);
                    foreach($spec as $v){//循环规格

                        // dd($v);

                        $spec_info = Spec::where('spec',$v)->where('attribute_id',$attr_id)->first();//判断这个规格是否存在
                
                        if($spec_info!=null){//如果存在就跳过本次循环
                         
                            continue ;

                        }
                     
                        DB::table('specs')->insert(['spec'=>$v,'attribute_id'=>$attr_id]);//不存在就添加

                    }

                }
        }

        return "<script>if(confirm('修改成功,是否继续修改?')){location.href='Admin_goods';}else{location.href='Admin_goods';}</script>";

    }

    function goods_del(){

        $id = $_GET['id'];

        $goods_images_info = Goods_image::where('goods_id',$id)->first();

        $img_arr = json_decode($goods_images_info->imgs);

        foreach($img_arr as $img){

            storage::delete($img);

            storage::delete('big/'.$img);
        }

        Storage::delete($goods_images_info->logo);

        Storage::delete('big/'.$goods_images_info->logo);

        Goods_image::where('goods_id',$id)->delete();

        $attr_id_arr = Attribute::where('goods_id',$id)->select('id')->get();

        foreach($attr_id_arr as $attr_id){

            Spec::where('attribute_id',$attr_id['id'])->delete();

            Attribute::where('id',$attr_id['id'])->delete();

        }

        $goods_info = Good::where('id',$id)->delete();

    }

    function goods_price(){

        $goods_id = $_GET['id'];

        $attributes = Attribute::where('goods_id',$goods_id)->get();

        $attrs = [];

        foreach($attributes as $attr){

            $attr_id = $attr->id;

            $specs = Spec::where('attribute_id',$attr_id)->get();

            $attr->specs = $specs;

            $attrs[] = $attr; 

        }

        return view('Admin.index.goods_price',['attrs'=>$attrs]);

    }

    function add_price(Request $req){

        $attr_spec = new Attr_spec;

        $spec_id = '';

        foreach($req->spec as $spec){

            $spec_id.=$spec."-";

        }

        $data = Attr_spec::where('spec_id',$spec_id)->first();

        if($data){

            return back()->withInput()->with('error_spec','不可以添加重复的');

        }else{

            $attr_spec->fill($req->all());

            $attr_spec->spec_id = $spec_id;
     
            $attr_spec->save();
     
            return "<script>if(alert('添加成功'));location.href='Admin_goods';</script>";

        }

    }

    function edit_price(){

        $goods_id = $_GET['id'];

        $attributes = Attribute::where('goods_id',$goods_id)->get();

        $attrs = [];

        foreach($attributes as $attr){

            $attr_id = $attr->id;

            $specs = Spec::where('attribute_id',$attr_id)->get();

            $attr->specs = $specs;

            $attrs[] = $attr;

        }

        return view('Admin.index.edit_price',['attrs'=>$attrs]);

        return view('Admin.index.goods_price',['attrs'=>$attrs]);

    }

    function ajax_price(){

        $spec_id = $_GET['spec_id'];

        $goods_id = $_GET['goods_id'];

        $price = Attr_spec::where('spec_id',$spec_id)->first();

        $info = [];
       
        if($price!=null){

            $info['price']=$price->price;

            $info['number']=$price->number;

            return  $info;

        }else{

            $goods_price = (Good::where('id',$goods_id)->select('price')->first())->price;

            $info['price']=$goods_price;

            $info['number']=0;

            return $info;

        }

    }

    function update_price(Request $req){

        // dd($req->all());

        $attr_spec = new Attr_spec;

        $spec_id = '';

        foreach($req->spec as $spec){

            $spec_id.=$spec."-";

        }

        $data = Attr_spec::where('spec_id',$spec_id)->first();

        if($data!=null){

            Attr_spec::where('spec_id',$spec_id)->update(['price'=>$req->price,'number'=>$req->number]);

            return "<script>if(alert('更新成功'));location.href='Admin_goods';</script>";

        }else{

            return back()->withInput()->with('error_spec','此商品你还未添加价格，不可以修改默认商品价格,请前往添加');

        }

    }

    function password(){

        return view("Admin.index.password");

    }

    function home(){

        return view("Admin.index.home");

    } 
    
    function image(Request $req){

        $data = Good::select(['id','goods_name'])->where('shop_id',session()->get('admin_id'))->get();

        $img_data = DB::table('goods_images')  
        ->leftjoin('goods', 'goods_images.goods_id', '=', 'goods.id')
        ->select('goods_images.goods_id','goods.goods_name','goods_images.id','goods_images.logo','goods_images.imgs')
        ->where('goods_images.admin_id',session()->get('admin_id'))
        ->paginate(1);
        
        return view("Admin.index.goods_image",['data'=>$data,'img_data'=>$img_data,'req'=>$req]);

    }

    function add_image(ImageRequest $req){

        if( $req->img==null){

            return back()->withInput()->with('error_img','至少上传一张样式图');
        }

        $goods_id = $req->goods_id;

        $images_info = Goods_image::where('goods_id',$goods_id)->first();

        if($images_info){

            return back()->withInput()->with('error_goods','这个商品已经存在logo');

        }

        $logo = $req->logo;

        $imgs = $req->img;

        $date = date('Y-m-d');

        $img = [];

        $img = $this -> imgs($imgs,$date,$img);//样式图的上传;

        $logo_dir = $this->logo($req,$date);//logo的上传

        $goods_image = new Goods_image;

        $goods_image->goods_id = $req->goods_id;

        $goods_image->imgs = json_encode($img);

        $goods_image->logo =$logo_dir;

        $goods_image->admin_id = session()->get('admin_id');

        $goods_image->save();

        return "<script>if(confirm('添加成功,是否继续添加?')){location.href='Admin_image';}else{location.href='Admin_image'}</script>";

    }

    function make_img($pic,$title, $date){

        $picture = Image::make("uploads/".$pic);

        $picture -> resize(400,400);

        $picture -> save("uploads/".$pic);

        $picture -> resize(800,800);

        if(!is_dir("uploads/big/{$title}_".$date."/")){

            mkdir("uploads/big/{$title}_".$date,0777,true);

        }

        $picture -> save("uploads/big/".$pic);

    }

    function imgs($imgs,$date,$img){

        foreach($imgs as $v){
            
           $img_dir = $v->store('img_'.$date);  

           $img[]=$img_dir;

        }

        foreach($img as $pic){

            $this->make_img($pic,'img',$date);

        }

        return $img;


    }

    function logo($req,$date){

        if($req->has('logo')&&$req->logo->isValid()){

            $logo_dir = $req->logo->store("logo_".$date);

            $this->make_img($logo_dir,'logo', $date);

        }

        return $logo_dir;


    }

    function edit_image(){

        $id = $_GET['id'];

        $image_info = Goods_image::find($id);

        $data = Good::select(['id','goods_name'])->get();

        return view("Admin.index.image_edit",['data'=>$data,'image_info'=>$image_info,'imgs'=>json_decode($image_info->imgs)]);

    }


    function update_image(Request $req){

        $id = $_GET['id'];

        $image = new Goods_image;

        $image_info = $image -> find($id);

        $goods_id = $req->goods_id;

        $del_arr = explode(',',$req->del);

        $img = json_decode($image_info->imgs);

        $date = date('Y-m-d');

        // dd($img);

        if($del_arr!=null){

            foreach($del_arr as $k=>$v){

                if($v==''){

                    continue ;

                }

                if(in_array($v,$img)){

                    Storage::delete($v);

                    Storage::delete("big/".$v);

                    unset($img[$k-1]);

                }

            }

        }

        $logo_dir = $image_info->logo;

        if($req->logo!=null){

            Storage::delete($logo_dir);

            Storage::delete("big/".$logo_dir);

            $logo_dir =$this->logo($req,$date);//logo的上传
            
        }

        if($req->img!=null){

            $img_arr = $this -> imgs($req->img,$date,$img);//img的上传

            $imgs = json_encode($img_arr);

        }else{

            $imgs = json_encode($img);

        }

        $image->where('id',$id)->update(['goods_id'=>$goods_id,'logo'=>$logo_dir,'imgs'=>$imgs]);

        return "<script>if(confirm('修改成功,是否继续修改?')){location.href='Admin_image';}else{location.href='Admin_image'}</script>";

    }

        function del_image(){

            $id = $_GET['id'];

            $image_info = Goods_image::find($id);

            $logo = $image_info->logo;

            if($logo!=null){

                Storage::delete($logo);

                Storage::delete('big/'.$logo);
            
            }

            $imgs = $image_info->imgs;

            if($imgs!=null){

                $imgs_arr = json_decode($imgs);

                foreach($imgs_arr as $img){  

                    Storage::delete($img);

                    Storage::delete('big/'.$img);
                    
                }

            }

            Goods_image::where('id',$id)->delete();

       
        return "<script>if(confirm('删除成功,是否继续删除?')){location.href='Admin_image';}else{location.href='Admin_image'}</script>";
    }
}
