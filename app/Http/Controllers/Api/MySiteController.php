<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use  Auth;
use App\Main;
use App\Slider;
use App\Category;
use App\Subcat;
use App\Add;
use App\Block;
use App\Product;
use App\Faqs;
use App\Brand;
use App\BlogCat;
use App\Blog;
use App\Country;
use App\Wlist;
use App\Order;
use App\Code;
use App\Catalog;
use DB;
use App\User;
use App\Specific;
use App\ProductGalary;
use App\Comment;
use App\Rate;
use Validator;
use App\Shipmentaddress;
use App\Http\Controllers\Controller;

class  MySiteController extends Controller {

 

    public function check_code(Request $data) {
        $code = Code::Where('code',$data['code'])->first();
        if (!empty($code) && $code->status == 0 && date('d-m-Y', strtotime($code->expir)) > date('d-m-Y')) {
            $condition = $code->price;
            if ($condition > 0) {
                return response()->json(array('status' => 'true', 'message' => "Pormotion Code Is valid For Order More Than " . $condition . "$"));
            } else {

                return response()->json(array('status' => 'true', 'message' => "Pormotion Code Is valid For Order More Than"));
            }
        } else {
            return response()->json(array('status' => 'false', 'message' => "Sorry! this Pormotion Code Is not valid "));
        }
    }

        public function slider() {
            $slider = Slider::select('id','photo')->where('status', 1)->get();
            return response()->json(array('status' => 'Ok', 'SlideShow' => $slider));
        }
    
        public function root() {
              $catroot = Subcat::select('id','name', 'name_ar','photo','photoicons')->where('cat_id',0)->get();
              
              return response()->json(array('status' => 'Ok', 'rootcat' => $catroot));
        }
          

         public function rootchildren() {
             $catroot = Subcat::select('id', 'name','name_ar','photo','photoicons')->where('cat_id', 0)->get()->pluck('id');
             $rootchildren = Subcat::select('id', 'name', 'name_ar', 'photo','photoicons')->whereIn('cat_id', $catroot)->paginate(6);
             return response()->json(array('status' => 'Ok', 'rootchildren' => $rootchildren));
        }

         public function homecats() {
            $homecats = Subcat::select('id', 'name', 'name_ar', 'photo','photoicons')->where('home', 1)->paginate(4); //home
            return response()->json(array('status' => 'Ok', 'homecats' => $homecats));
        }

        public function children($id) {
            $cat = Subcat::find($id);
            if (empty($cat)) {
                return response()->json(array('status' => 'Ok', 'children' => []));
            }
               $children = Subcat::select('id', 'name', 'name_ar', 'photo', 'cat_id','photoicons')->where('cat_id', $cat->id)->paginate(6);
               return response()->json(array('status' => 'Ok', 'children' => $children));
            }

     public function brandproducts($id, Request $data) {
          
            $brand = Brand::find($id);
            $products= Product::with(['catalog' => function($query){
            $query->select('id', 'photo');
              }])>with(['brand' => function($query){
              $query->select('id','name');
             }])->with(['Seller' => function($query){
              $query->select('id', 'name');
               }])->select('id', 'name', 'name_ar', 'offer', 'price','weight','model','brand_id','catalog_id','user_id','brand_id')->where('brand_id',$brand->id)->orderBy('viewers', 'desc')->paginate(12);
            
            return response()->json(array('status' => 'Ok', 'products'=>$products));
            
        if (empty($products)) {
            return response()->json(array('status' => 'Ok', 'products' => []));
        
        }
        
     }
     
    
       public function allproducts(Request $data) {
           
          if (isset($data['sort']) && $data['sort'] == 'offer') {
                  $products=Product::with(['catalog' => function($query){
                 $query->select('id', 'photo');
                 }])->with(['Seller' => function($query){
                $query->select('id', 'name');
              }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id','brand_id')->where('offer','>',0)->orderby('offer','desc')->paginate(3);
               $products->setPath('?sort=offer');
             } elseif (isset($data['sort']) && $data['sort'] == 'popular') {
                 $products= Product::with(['catalog' => function($query){
                 $query->select('id', 'photo');
              }])->with(['Seller' => function($query){ 
                $query->select('id', 'name');
              }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id','brand_id')->orderby('viewers','desc')->paginate(3);
               $products->setPath('?sort=popular');
             } elseif (isset($data['sort']) && $data['sort'] == 'price') {
                $products= Product::with(['catalog' => function($query){
                $query->select('id', 'photo');
              }])->with(['Seller' => function($query){
                $query->select('id', 'name');
              }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id','brand_id')->orderby('price','desc')->paginate(3);
                 $products->setPath('?sort=price');

            /* foreach ($products as $pro) {
              $pro['total'] = $pro->price - ($pro->price * ($pro->offer / 100));
              } */
            // $products->orderBy('total','desc');
              } else {
                 $products= Product::with(['catalog' => function($query){
                $query->select('id', 'photo');
              }])->with(['Seller' => function($query){
                $query->select('id', 'name');
              }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id','return_policy','return_policy_ar','brand_id')->orderby('created_at')->paginate(8);
               }
                    return response()->json(array('status' => 'Ok', 'products' => $products));
                }

          public function search(Request $data) {
              $brandssearch = Brand::where('name', 'like', '%' . $data['keyword'] . '%')->orwhere('name_ar', 'like', '%' . $data['keyword'] . '%')->get()->pluck('id');
              $catssearch = Subcat::where('name', 'like', '%' . $data['keyword'] . '%')->orwhere('name_ar', 'like', '%' . $data['keyword'] . '%')->get()->pluck('id');
              $catalog = Catalog::where('name', 'like', '%' . $data['keyword'] . '%')->orwhere('name_ar', 'like', '%' . $data['keyword'] . '%')->get()->pluck('id');

                $products = Product::select('name', 'name_ar', 'custom_url', 'custom_url_ar','price', 'offer', 'id','catalog_id')
                         ->orderBy('price', 'asc')
                         ->orwhere('name', 'like', '%' . $data['keyword'] . '%')->where('status', '<>', 2)
                         ->orWhere('name_ar','like', '%' . $data['keyword'] . '%')->where('status', '<>', 2)->paginate(3);
                 foreach ($products as $p) {
                    $catalog = Catalog::where('id',$p->catalog_id)->first();
                    $brand = Brand::where('id',$catalog->brand_id)->first();
                    $p['brand'] = $brand->name;
                    $p['brand_ar'] = $brand->name_ar;
                    $p['photo'] =  $catalog->photoes;
                 }
    
                    return response()->json(array('status' => 'Ok', 'products' => $products));
                }

                   public function allbrands() {
                        $brands = Brand::select('id', 'name', 'name_ar', 'photo')->paginate(10);
                        return response()->json(array('status' => 'Ok', 'brands' => $brands));
                   }
 
                  public function product($id) {
                     $product = Product::where('id',$id)->first();
                       if (empty($product)) {
                         return response()->json(array('status' => 'Ok', 'product' => []));
                        }
                      $catalog = Catalog::where('id',$product->catalog_id)->first();
                      $products = array('product' => $product, 'catalog' => $catalog);
                        if (empty($products)) {
                              return response()->json(array('status' => 'Ok', 'product' => []));
                        }
                     $galary = $catalog->photoes;
                     $related = Product::with(['catalog' => function($query){
                     $query->select('id', 'photo');}])->select('id', 'name','name_ar', 'offer','price', 'weight','custom_url','catalog_id','viewers','user_id')->where('cat_id', $product->cat_id)->where('id', '<>', $product->id)->where('active',1)->get()->take('5');
                     $catalogs =Catalog::where('id',$product->catalog_id)->first();
                     $products= array(
                    "id"=>$product->id,
                    "custom_url"=>$product->custom_url,
                    "custom_url_ar"=>$product->custom_url_ar,
                    "name"=>$product->name,
                    "name_ar"=>$product->name_ar,
                    "meta_title"=>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $product->meta_title)), 
                    "meta_title_ar" =>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $product->meta_title_ar)),
                    "meta_description"=>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $product->meta_description)),
                    "meta_keyword"=>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $product->meta_keyword)),
                    "meta_description_ar"=>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $product->meta_description_ar)), 
                    "meta_keyword_ar"=>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $product->meta_keyword_ar)), 
                    "return_policy"=>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $product->return_policy)),
                    "return_policy_ar"=>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $product->return_policy_ar)), 
                    "status"=>$product->status,
                    "price" =>$product->price,
                    "offer"=>$product->offer,
                    "quantity" =>$product->quantity,
                    "user_id"=>$product->user_id,
                    "last_view"=>$product->last_view,
                    "viewers"=>$product->viewers,
                    "weight"=>$product->weight,
                    "model"=>$product->model,
                    "sku" =>$product->sku,
                    "catalog_id"=>$product->catalog_id,
                    "brand_id"=>$product->brand_id,
                    "link"=>'https://waffarnaa.com/public/product/'.$product->custom_url,

                   );
                           
                   $product_details = $products;
                   $product_details['images'] = $galary;
                   $product_details['sizes'] =  $product->Sizes;
                   $product_details['colors'] =  $product->colors;
                   $product_details['related_products'] = $related;
                   $product_details['review'] =$product->ratecount();
                   $product_details['rate']=$product->rate;
                    foreach( $product_details['rate']  as $f)
                    
                      {
                          
                       $f->user->name;
                          
                      }
            
                   $product_details['ratevalue']=$product->ratevalue();
                   $specific= array(
                    'desc'=>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $catalogs->desc)),
                    'desc_ar'=>strip_tags(str_replace(array("\"","\r","\n",'\r','\n',"\\/"),'', $catalogs->desc_ar)),
                    'name'=>$catalogs->name,
                    'name_ar'=>$catalogs->name_ar,
                    'photo'=>$catalogs->photo,
                    'weight'=>$catalogs->weight,
                    'model'=>$catalogs->model,
                    'cat_id'=>$catalogs->cat_id,
                    'brand_id'=>$catalogs->brand_id,
                    'sku'=>$catalogs->sku,
                    );
           
                    $product_details['specs'] = $specific;
                    $brand = Brand::select('name', 'name_ar', 'photo')->where('id', $catalog->brand_id)->get()->first();
                    $seller = User::select('name')->where('id', $product->user_id)->get()->first();
                    $all = array('product' => $product_details , 'brand' => $brand, 'seller' => $seller);
                    return response()->json(array('status' => 'Ok', 'product_details' => $all));
                  }
    
                 public function popular() {
                  
                   $products= Product::with(['catalog' => function($query){
                   $query->select('id', 'photo');
                    }])->with(['Seller' => function($query){ 
                    $query->select('id', 'name');
                    }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id','name', 'name_ar', 'offer','custom_url', 'price', 'weight','catalog_id','viewers','user_id','brand_id','quantity')->orderby('viewers','desc')->paginate(12);
                    
                    foreach($products as $product)
                    {
                        $product['link'] ='https://waffarnaa.com/public/product/'.$product->custom_url;
                    }
                    
                     return response()->json(array('status' => 'Ok', 'popular_products' =>   $products));
                 }

              public function catproducts($id) {
                $cat = Subcat::find($id);
                if (empty($cat)) {
                    return response()->json(array('status' => 'Ok', 'products' => []));
                }
            
              if (isset($data['sort']) && $data['sort'] == 'offer') {
                   $products= Product::with(['catalog' => function($query){
                     $query->select('id', 'photo');
                      }])->with(['Seller' => function($query){
                     $query->select('id', 'name');
                     }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id')->orderby('offer')->paginate(8);          
            
                 } elseif (isset($data['sort']) && $data['sort'] == 'popular') {
              $products= Product::with(['catalog' => function($query){
                $query->select('id', 'photo');
              }])->with(['Seller' => function($query){
                $query->select('id', 'name');
              }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id')->orderby('viewers')->paginate(8);        } 
                elseif (isset($data['sort']) && $data['sort'] == 'price') {
              $products= Product::with(['catalog' => function($query){
                $query->select('id', 'photo');
              }])->with(['Seller' => function($query){
                $query->select('id', 'name');
              }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id')->orderby('created_at')->paginate(8);
                  foreach ($products as $product) {
                    $catalog = Catalog::where('id', $product->catalog_id)->first();
                    $brand = Brand::where('id',$catalog->brand_id)->first();
                    $cat_id = Subcat::where('id',$catalog->cat_id)->first();
                    $photo = $catalog->photoes;

                    $product['brand'] = $brand->name;
                    $product['brand'] = $brand->name_ar;
                    $product['photo'] = $photo;
                    $product['cat_id'] = $cat_id;_id;
                  }
                }else{
                         $products= Product::with(['catalog' => function($query){
                           $query->select('id', 'photo');
                            }])->with(['Seller' => function($query){
                            $query->select('id', 'name');
                             }])->with(['brand' => function($query){
                           $query->select('id','name');
                            }])->select('id', 'name', 'name_ar', 'price', 'offer', 'viewers', 'weight','catalog_id','user_id','brand_id')->where('cat_id',$cat->id)->orderBy('created_at')->paginate(10);
                            }

                 foreach ($products as $product) {
                    $catalog = Catalog::where('id', $product->catalog_id)->first();
                    $brand = Brand::where('id',$catalog->brand_id)->first();
                    $cat_id = Subcat::where('id',$catalog->cat_id)->first();
             }
                  return response()->json(array('status' => 'Ok', 'products' => $products));
           }

          public function newest() {
                 $newest = Product::with(['catalog' => function($query){
                 $query->select('id', 'photo');
                      }])->with(['Seller' => function($query){
                  $query->select('id', 'name');
                  }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id', 'name','name_ar', 'offer','price', 'weight','custom_url','catalog_id','viewers','user_id','brand_id','quantity')->orderby('created_at', 'desc')->paginate(12);
                    foreach( $newest as $product)
                    {
                        $product['link'] ='https://waffarnaa.com/public/product/'.$product->custom_url;
                        
                    }
                       return response()->json(array('status' => 'Ok', 'newest_products' => $newest));
                   }

        public function offers(Request $data) {
             if (isset($data['sort']) && $data['sort'] == 'offer') {
              $products= Product::with(['catalog' => function($query){
                   $query->select('id', 'photo');
                    }])->with(['Seller' => function($query){ 
                    $query->select('id', 'name');
                    }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id','brand_id')->where('offer', '>', 0)->orderBy('offer')->paginate(2);
                } elseif (isset($data['sort']) && $data['sort'] == 'popular') {
                $products= Product::with(['catalog' => function($query){
                   $query->select('id', 'photo');
                    }])->with(['Seller' => function($query){ 
                    $query->select('id', 'name');
                    }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id','brand_id')->where('offer', '>', 0)->orderBy('viewers')->paginate(2);
               } elseif (isset($data['sort']) && $data['sort'] == 'price') {
                $products= Product::with(['catalog' => function($query){
                   $query->select('id', 'photo');
                    }])->with(['Seller' => function($query){ 
                    $query->select('id', 'name');
                    }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id','brand_id')->where('offer', '>', 0)->orderBy('price')->paginate(2);
            /* foreach ($products as $pro) {
              $pro['total'] = $pro->price - ($pro->price * ($pro->offer / 100));
              }
              $products->orderBy('total'); */
            } else {
              $products= Product::with(['catalog' => function($query){
                   $query->select('id', 'photo');
                    }])->with(['Seller' => function($query){ 
                    $query->select('id', 'name');
                    }])->with(['brand' => function($query){
                   $query->select('id','name');
                    }])->select('id','name', 'name_ar', 'offer', 'price', 'weight','catalog_id','viewers','user_id','brand_id')->where('offer', '>', 0)->orderBy('created_at')->paginate(2);
            }

             foreach ($products as $p) {
                    $catalog = Catalog::where('id',$p->catalog_id)->first();
                  // dd($catalog);
                    $brand = Brand::where('id',$catalog->brand_id)->first();
                    $photo = ProductGalary::where('catalog_id', $catalog->id)->get();
                     $p['brand'] = $brand->name;
                     $p['photo'] = $photo;

             }
                  return response()->json(array('status' => 'Ok', 'offers' => $products));
           } 

        public function fbrands() {
            $brands = Brand::select('id', 'photo', 'name', 'name_ar')->where('home',1)->paginate(12);
            return response()->json(array('status' => 'Ok', 'brands' => $brands));
        }

 
        public function countries() {
            $count = Country::select('id', 'name', 'name_ar','photo')->get();
            return response()->json(array('status' => 'Ok', 'countries' => $count));
        }

        
        public function user($id) {
            $user = User::find($id);
            if (empty($user)) {
                return response()->json(array('false' => 'Ok', 'user' => null));
            }
            $con = Country::select('id', 'name', 'name_ar')->where('id', $user->country)->first();
            if (!empty($con)) {
                $user['country_name'] = $con->name;
                $user['country_name_ar'] = $con->name_ar;
            }
            return response()->json(array('false' => 'Ok', 'user' => $user));
        }

    public function offerrange() {
        $max = 0;
        $min = 0;
        $offers = Product::select('id', 'price', 'offer')->where('offer', '>', 0)->get();
        foreach ($offers as $pro) {
            $pro['total'] = $pro->price - ($pro->price * ($pro->offer / 100));
        }
        if (count($offers) > 0) {
            $max = $offers->max('total');
            $min = $offers->min('total');
        }
            return response()->json(array('status' => 'Ok', 'max' => $max, 'min' => $min));
    }

    public function range() {
        $offers = Product::select('id', 'price', 'offer')->get();
        foreach ($offers as $pro) {
            $pro['total'] = $pro->price - ($pro->price * ($pro->offer / 100));
        }
        $max = $offers->max('total');
        $min = $offers->min('total');
        return response()->json(array('status' => 'Ok', 'max' => $max, 'min' => $min));
    }

    public function catrange($id) {
        $catalog = Catalog::where('cat_id', $id)->first();
        if (!empty($catalog)) {

              $offers = Product::select('id', 'price', 'offer')->where('catalog_id', $catalog->id)->get();

          foreach ($offers as $pro) {
              $pro['total'] = $pro->price - ($pro->price * ($pro->offer / 100));
          }
               $max = $offers->max('total');
               $min = $offers->min('total');
          if (!empty($max && $min)) {
                 return response()->json(array('status' => 'Ok', 'max' => $max, 'min' => $min));
          }

        }else {

              return response()->json(array('status' => 'Ok', 'max' => [], 'min' => []));
        }

    }

    public function currency() {
        
        $curr = \App\Currencies::all();
        return response()->json(array('status' => 'Ok', 'curr' => $curr));
    }

    public function brandrange($id) {
        $max = 0;
        $min = 0;
        $catalog = Catalog::where('brand_id', $id)->first();
          if (!empty($catalog)) {
            $offers = Product::select('id', 'price', 'offer')->where('catalog_id', $catalog->id)->get();
            foreach ($offers as $pro) {
              // dd($pro);
                $pro['total'] = $pro->price - ($pro->price * ($pro->offer / 100));
            }
            if (count($offers) > 0) {
                $max = $offers->max('total');
                $min = $offers->min('total');
            }
            return response()->json(array('status' => 'Ok', 'max' => $max, 'min' => $min));
          } else {
            return response()->json(array('status' => 'Ok', 'max' => [], 'min' => []));
          }
    }  
    
  
          public function updateprofile($id, Request $data) {
                $user = User::find($id);
                if (!empty($user)) {
                    $up = $user->update($data->all());
                    if ($up) {
                        return response()->json(array('status' => 'true', 'user' => $user));
                    } else {
                        return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
                    }
                } else {
                      return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
                }
          }
          
    
         public function submitaddress(Request $request) {
                $validator = Validator::make($request->all(),[
                    'title'=>'required',
                    'address' => 'required',
                    'city'=> 'required',
                    'user_id' => 'required',
                     'building_number' => 'required',
                     'street_name' => 'required',
                     'floor_number'=> 'required',
                     'flat_num' => 'required',
                     'country' =>  'required',

                    ]);
             
                if (!$validator->passes()) {
                      $messages = $validator->errors();
                          return response()->json(array('status' => 'false', 'message' => $messages->all()));
                }
                          
            $insert = new Shipmentaddress();
            $insert->title= $request->title;
            $insert->country= $request->country;
            $insert->city = $request->city;
            $insert->address =$request->address;
            $insert->street_name= $request->street_name;
            $insert->floor_number = $request->floor_number;
            $insert->address= $request->address;
            $insert->building_number = $request->building_number;
            $insert->flat_num = $request->flat_num;
            $insert->user_id =$request->user_id;
            $insert->code = $request->code;

            $insert->save();
              if ($insert) {
                      
                  return response()->json(array('status' =>'true', 'message'=>'insert shipment address  suceefully'));
              }
              
             else{
                return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
                 
             }
             
         }
             
        public function editaddress($id ,Request $request) {
            $insert =  Shipmentaddress::find($id);
              if(empty($insert))
            
            {
                
             return response()->json(array('status' => 'false', 'message' => "this id not found"));
                
            }
             
            $insert->title= $request->title;
            $insert->country= $request->country;
            $insert->city = $request->city;
            $insert->address =$request->address;
            $insert->street_name= $request->street_name;
            $insert->floor_number = $request->floor_number;
            $insert->building_number = $request->building_number;
            $insert->flat_num = $request->flat_num;
            $insert->code = $request->code;
            $insert->user_id =$request->user_id;
            $insert->save();
                if ($insert) {
                return response()->json(array('status' =>'true', 'message'=>'update  shipment address  suceefully'));              }
              
               else{
                   return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
                 
                }
           }
             
       
          public function editorder($id ,Request $data) {
              
                $order =Order::find($id);
                if (!empty($order)) {
                  $order->order_paid=1;
                  $order->save();
                  
                 if($order){
                        return response()->json(array('status' => 'true', 'order' => $order));
                    } else {
                        return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
                    }
                } else {
                      return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
                }
          }
          
          
               public function addcomment(Request $request) {
                      $validator = Validator::make($request->all(), [
                         'product_id' => 'required',
                         'text' => 'required',
                         'user_id'=>'required',
                         
                     ]);
                     
                   if (!$validator->passes()) {
                       $messages = $validator->errors();
                          return response()->json(array('status' => 'false', 'message' => $messages->all()));
                   }
                 
                $insert= new Comment();
                $insert->product_id= $request->product_id;
                $insert->text = $request->text;
                $insert->user_id =$request->user_id;
                $insert->save();
                if ($insert) {
                return response()->json(array('status' =>'true', 'message'=>'comments inserted   succesfully'));  
                }
              
               else{
                   return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
                 
              }
              
              }
             
           
               public function addrate(Request $request) {
                     $validator = Validator::make($request->all(), [
                         'product_id' => 'required',
                          'value' => 'required|numeric|max:5',
                         'user_id'=>'required',
                         'comment'=>'required',

                      ]);
                     
                   if (!$validator->passes()) {
                       $messages = $validator->errors();
                          return response()->json(array('status' => 'false', 'message' => $messages->all()));
                   }
                 
                   $ratess= Rate::where('product_id' , $request->product_id )->first();
                   if(empty($ratess)){
                
                $insert = new Rate() ;
                $insert->product_id= $request->product_id;
                $insert->value= $request->value;
                $insert->user_id =$request->user_id;
                $insert->comment =$request->comment;
                $insert->save();
                if ($insert) {
                return response()->json(array('status' =>'true', 'message'=>'sucess'));  
                }
              
               else{
                   return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
                 
              
                 }
                  }
                   
                 else{
                     
                $insert = Rate::where('product_id' , $request->product_id )->first();
                $insert->product_id= $request->product_id;
                $insert->value= $request->value;
                $insert->user_id =$request->user_id;
                $insert->comment =$request->comment;
                $insert->save();
                if ($insert) {
                return response()->json(array('status' =>'true', 'message'=>'sucess'));  
                }
              
               else{
                   return response()->json(array('status' => 'false', 'message' => "Sorry ,There's an Error"));
                 
              
               }
                  
                   
                     
                 }
              
              }
              
          public function shipments() {
        
            $shipments = \App\Shipment::select('id','name','name_ar','desc','desc_ar')->get();
            
           if (empty($shipments)) {
                return response()->json(array('status' => 'Ok', 'shipments' => []));

           }
              else {
                return response()->json(array('status' => 'Ok', 'shipments' =>  $shipments ));
           }
       }

      
        public function payments() {
            $payments=  \App\Payment::select('id','name')->get();
          
          if (empty ($payments)) {
                   return response()->json(array('status' => 'Ok', 'payments' => []));

            }
              else {
                return response()->json(array('status' => 'Ok', 'payments' => $payments ));
              }
        }
  
         public function cities($id) {
              $cities = \App\Zone::where('country_id',$id)->get();
              if (empty ($cities)) {
                   return response()->json(array('status' => 'Ok', 'cities' => []));
              }
                else {
                   return response()->json(array('status' => 'Ok', 'cities' => $cities));
           }
       }

     
        public function   findrate($product_id) {
        
             $check =  Rate::where('product_id', '=', $product_id)->first();
             if (count($check) >0) {
                return response()->json(array('status' => 'true','rate'=>$check));
             } else {
                return response()->json(array('status' => 'true', 'rate' =>[]));
             }
        }

  
        public function  showaddress($id) {
            $shipmentaddresses  = \App\Shipmentaddress::where('user_id',$id)->get();
          
          if (empty ( $shipmentaddresses)) {
                   return response()->json(array('status' => 'Ok', 'myadress' => []));
            }
              else {
                return response()->json(array('status' => 'Ok', 'myaddress' =>  $shipmentaddresses ));
              }
        }
  
  
         public function  deleteaddress($id){
             
            $shipmentaddresses  = \App\Shipmentaddress::where('user_id',Auth::user()->id)->where('id',$id)->delete();
            if (empty ( $shipmentaddresses)) {
                   return response()->json(array('status' => 'Ok', 'message'=> 'you can not delete this address' ));
            }
            else{
                return response()->json(array('status' => 'Ok', 'message' => 'delete address succefuly' ));
            
            }
            
         }
        
    public function like($user_id, $product_id) {
        $check = Wlist::where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->first();
        if (count($check) >= 1) {
            $check->delete();
            return response()->json(array('status' => 'true', 'message' => "Unliked"));
           } else {

            $item = new Wlist();
            $user = User::find($user_id);
            $product = Product::find($product_id);
            if (!empty($user) && !empty($product)) {
                $item->user_id = $user_id;
                $item->product_id = $product_id;
                $item->save();
            }
            return response()->json(array('status' => 'true', 'message' => "Liked"));
        }
    }

        public function checklike($user_id, $product_id) {
        
             $check = Wlist::where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->first();
             if (count($check) >= 1) {
                return response()->json(array('status' => 'true', 'value' => "true"));
             } else {
                return response()->json(array('status' => 'true', 'value' => "false"));
             }
        }

     public function wlist($user_id) {
        $list = Wlist::where('user_id', '=', $user_id)->pluck('product_id');
        $products = Product::select('id', 'name', 'name_ar', 'offer', 'price','catalog_id')->whereIn('id', $list)->paginate(3);

        foreach ($products as $product) {
            $catalog = Catalog::where('id', $product->catalog_id)->first();

            $brand = Brand::where('id',$catalog->brand_id)->first();
            $cat_id = Subcat::where('id',$catalog->cat_id)->first();
            $photo = ProductGalary::where('catalog_id', $product->catalog_id)->get();
            $product['brand'] = $brand->name;
            $product['brand_ar'] = $brand->name_ar;
            $product['photo'] = $photo;
            $product['cat_id'] = $cat_id;
        }
        return response()->json(array('status' => 'ok', 'products' => $products));
    }

    public function filter($min, $max, Request $data) {
        if (isset($data['brands']) && is_array($data['brands'])) {
            $cat_log = Catalog::where('brand_id', $data['brands'])->first();
               $products= Product::with(['catalog' => function($query){
                           $query->select('id', 'photo');
                            }])->with(['Seller' => function($query){
                            $query->select('id', 'name');
                             }])->with(['brand' => function($query){
                           $query->select('id','name');
                            }])->select('id', 'name', 'name_ar', 'offer', 'price', 'weight', 'catalog_id','user_id','brand_id')->whereIn($cat_log->brand_id, $data['brands'])->where('price', '>', $min)->where('price', '<', $max)->paginate(3);
                      } else {
                    $products= Product::with(['catalog' => function($query){
                           $query->select('id', 'photo');
                            }])->with(['Seller' => function($query){
                            $query->select('id', 'name');
                             }])->with(['brand' => function($query){
                           $query->select('id','name');
                              }])->select('id', 'name', 'name_ar', 'offer', 'price', 'weight', 'catalog_id','user_id','brand_id')->where('price', '>', $min)->where('price', '<', $max)->paginate(3);
        }

        foreach ($products as $product) {
            $catalog = Catalog::where('id', $product->catalog_id)->first();
            $brand = Brand::where('id',$catalog->brand_id)->first();
            $photo = ProductGalary::where('catalog_id', $product->catalog_id)->get();

            $product['brand'] = $brand->name;
            $product['photo'] = $photo;
          }
             return response()->json(array('status' => 'Ok', 'products' => $products));
       }

    public function brandsbycat($id) {
        $cat = Subcat::find($id); //el cat elly howa talbo
        if (empty($cat)) {
            return response()->json(array('status' => 'Ok', 'products' => []));
        }
        $firstlevel = $cat->children->lists('id'); //First Generation
        $selcondlevel = Subcat::whereIn('cat_id', $firstlevel)->get()->lists('id');

        $ids = Catalog::select('id', 'brand_id')->whereIn('cat_id', $firstlevel)->orwhereIn('cat_id', $selcondlevel)->orwhere('cat_id', $id)->get()->lists('brand_id');
        $brands = Brand::select('id', 'name', 'ar_name')->whereIn('id', $ids)->get();
        return response()->json(array('status' => 'Ok', 'brands' => $brands));
    }

    public function brandsoffer() {
        $products = Product::where('offer', '>', '0' )->get();
        foreach ($products as $product) {
           $ids = Catalog::select('id', 'brand_id')->where('id',$product->catalog_id)->lists('brand_id');
           $brands = Brand::select('id', 'name', 'ar_name')->whereIn('id', $ids)->get();
        
          return response()->json(array('status' => 'Ok', 'brands' => $brands));
        }
    }

         public function myorders($user_id) {
             
             $orders =  Order::select('id','address','total_price','phone','country','city','email','sales_tax','shipping_tax','status','delivery_date','shipment_id','payment_method','shipping_price')->where('order_paid',1)->where('user_id',$user_id)->get();
                 foreach($orders as $o)
                 {
                    $o['price'] = number_format($o->total_price ,2);
                    $o->shipmentmethod->name;
                    $o->paymentmethod->name;

                  foreach($o->order_details as $l)
                  {
                   
                    $l['product'] =$l->product->name;
                 
                  }
                 }
                     return response()->json(array('status' => 'ok', 'myorders' => $orders));
         }
         
         

    public function catfilter($id, $min, $max, Request $data) {
        $cat = Subcat::find($id); 
        if (empty($cat)) {
            return response()->json(array('status' => 'Ok', 'products' => []));
        }
           $firstlevel = $cat->children->pluck('id'); 
           $selcondlevel = Subcat::whereIn('cat_id', $firstlevel)->get()->pluck('id'); 
          if (isset($data['brands']) && is_array($data['brands'])) {
              $products = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'weight','catalog_id')
                    // ->where('cat_id', $id)
                    // ->orWhereIn('cat_id', $firstlevel)
                    // ->orWhereIn('cat_id', $selcondlevel)
                    ->where('price', '>', $min)
                    ->where('price', '<', $max)
                    // ->where('status', '<>', '2')->whereIn('brand_id', $data['brands'])
                    ->paginate(3);
                } else {
                $products = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'weight','catalog_id')
                    // ->where('cat_id', $id)->orWhereIn('cat_id', $firstlevel)->orWhereIn('cat_id', $selcondlevel)
                    ->where('price', '>', $min)
                    ->where('price', '<', $max)
                    ->where('status', '<>', '2')
                    ->paginate(3);
                }
           foreach ($products as $product) {
              $catalog = Catalog::where('id', $product->catalog_id)->first();
              $brand = Brand::where('id',$catalog->brand_id)->first();
              $photo = ProductGalary::where('catalog_id', $product->catalog_id)->get();

               $product['brand'] = $brand->name;
               $product['photo'] = $photo;
             }
                 return response()->json(array('status' => 'Ok', 'products' => $products ));
        }

         public function offerfilter($min, $max, Request $data) {
           if (isset($data['brands']) && is_array($data['brands'])) {
                $products = Product::select('id', 'name', 'name_ar', 'photo', 'offer', 'price', 'weight', 'catalog_id')
                    ->where('status', '<>', '2')
                    ->where('offer', '>', 0)
                    ->where('price', '>', $min)
                    ->where('price', '<', $max)
                    ->paginate(3);
             }else{
                  $products = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'weight', 'catalog_id')
                    ->where('status', '<>', '2')
                    ->where('offer', '>', 0)
                    ->where('price', '>', $min)
                    ->where('price', '<', $max)
                    ->paginate(3);
            }
          foreach ($products as $product) {
                $catalog = Catalog::where('id', $product->catalog_id)->first();
                $brand = Brand::where('id',$catalog->brand_id)->first();
                $photo = ProductGalary::where('catalog_id', $product->catalog_id)->get();
    
                $product['brand'] = $brand->name;
                $product['photo'] = $photo;
             }
 
               return response()->json(array('status' => 'Ok', 'products' => $products));
          }

       public function brandfilter($id, $min, $max) {
            $products = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'weight','catalog_id')
                ->where('status', '<>', '2')
                 ->where('brand_id', $id)
                ->where('price', '>', $min)
                ->where('price', '<', $max)
                ->paginate(3);
           foreach ($products as $product) {
                $catalog = Catalog::where('id', $product->catalog_id)->first();

              $brand = Brand::where('id',$catalog->brand_id)->first();
              $cat_id = Subcat::where('id',$catalog->cat_id)->first();
              $photo = ProductGalary::where('catalog_id', $product->catalog_id)->get();

              $product['brand'] = $brand->name;
              $product['photo'] = $photo;
             // $product['cat_id'] = $cat_id;
          }
              return response()->json(array('status' => 'Ok', 'products' => $products));
    }

}
