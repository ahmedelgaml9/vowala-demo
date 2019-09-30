<?php

namespace App\Http\Controllers;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Subcat;
use App\Brand;
use App\ProductGalary;
use App\ProductSize;
use App\ProductColor;
use App\Block;
use App\Specific;
use App\Catalog;
use App\Related;
use App;
class ProductController extends Controller {

    public function __construct(Request $request, Product $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/products/';
        
         $data=\App\Main::find(1);
        $lang =$data->setlang;
        if ($lang == 1) {

            App::setLocale('en');
        }

        else{

            App::setLocale('ar');
        }    
        
        
    }
    public function index() {
        if (is_null($this->request->value)) {
            $products = $this->model->paginate(25);
        } else {
            // $this->request->flash();            
            $products = $this->model->Where('sku','like', "{$this->request->value}%")
                                    ->orWhere('title', 'like', "%{$this->request->value}%")
                                    ->orWhere('title_ar', 'like', "%{$this->request->value}%")
                                    ->paginate(25);
        }
        $products->setPath('cartproducts');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('products',''))->render());
        }
        return View($this->view . 'index', compact('products','cats'));
    }

     public function myproducts() {
       
          $products = $this->model->where('user_id',auth()->user()->id)->paginate(25);
      
          return View($this->view .'myproducts', compact('products'));
     }
   
   
    public function create() {
        $blocks = Block::all()->pluck('title', 'id');
        $ob = new Block();
        $ob->title = "No Block";
        $ob->id = 0;
        $blocks = array_add($blocks, $ob->id, $ob->title);
        $blocks = $blocks->sortBy('id');
        $cats = Subcat::all();
        $brands = Brand::all()->pluck('name', 'id');
        $colors= \App\Colors::all();
        $sizes= \App\Sizes::all();
        return View($this->view . 'create', compact('cats', 'shipments', 'blocks','brands','sizes','colors'));
    }

    public function createcatalog() {
        $blocks = Block::all()->pluck('title', 'id');
        $ob = new Block();
        $ob->title = "No Block";
        $ob->id = 0;
        $blocks = array_add($blocks, $ob->id, $ob->title);
        $blocks = $blocks->sortBy('id');
        $brands = Brand::all()->pluck('name', 'id');
        $cats = Catalog::get()->pluck('name', 'id');
        return View($this->view . 'create2', compact('cats', 'shipments', 'blocks', 'brands'));
    }
    
    

           public function store(Request $request) {
                 $request->validate([
                    'photo'=>'required|image',
                    'name' => 'required|min:3',
                    'name_ar' => 'required|min:3',
                    'model' => 'required|min:3',
                    'sku' => 'required|min:3',
                    'desc' => 'required|min:3',
                    'desc_ar' => 'required|min:3',
                    'custom_url' => 'required|unique:products',
                    'custom_url_ar' => 'required|unique:products',
                    'weight' => 'required',
                    'price' => 'required',
            
                  ]);
        
             $insert = Catalog::create($this->request->all());
            if ($insert) {
                $this->request['catalog_id'] = $insert->id;
                $this->request['brand_id'] = $insert->brand_id;
                $catalog_tax = $insert->tax;
                $insert2 = $this->model->create($this->request->all());
                 if ($this->request->hasFile('gallary')) {
                     $gallary = $this->request->file('gallary');
                      foreach ($gallary as $photo) {
                          $name = str_random(6) . '_' . $photo->getClientOriginalName();
                          $extension = strtolower($photo->getClientOriginalExtension());
                         if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {
                             $galary = new ProductGalary();
                             $galary->photo = $name;
                             $galary->catalog_id = $insert->id;
                             $galary->save();
                             $dest = 'admin-assets/images/products/';
                             $photo->move($dest, $name);
                         }
                      }
                    }
                
                if ($this->request->has('size')) {
                    $sizes = $this->request['size'];
                    $qu = $this->request['qu'];
                    for ($i = 0; $i < count($sizes); $i++) {
                        if (!empty($sizes[$i])) {
                            $new = new ProductSize();
                            $new->product_id = $insert2->id;
                            $new->size = $sizes[$i];
                            $new->qu = $qu[$i];
                            $new->save();
                        }
                    }
                }

                       if ($this->request->has('color')) {
                           $colors = $this->request['color'];
                            $qu = $this->request['qu2'];
                          for ($i = 0; $i < count($colors); $i++) {
                            if (!empty($colors[$i])) {
                                $new = new ProductColor();
                                $new->product_id = $insert2->id;
                                $new->color = $colors[$i];
                                $new->qu2 = $qu[$i];

                                $new->save();
                             }
                           }
                         }
                           if ($this->request->has('relatedproduct')) {
                                $relatedproducts = $this->request['relatedproduct'];
                                for ($i = 0; $i < count( $relatedproducts); $i++) {
                                    if (!empty($relatedproducts[$i])) {
                                        $new = new Related();
                                        $new->product_id= $relatedproducts[$i];
                                        $new->save();
                                    }
                                }
                            }
                     \Session::flash('flash_message', 'products successfully added.'); 
                       return redirect('/admin/cartproducts');
                   }
          
                  else {
                       \Session::flash('flash_message', 'Adding catalogs not complete, Try agin later '); 
                       return redirect('/admin/cartproducts');
                    }
                }


          public function storecatalog() {
            $catalog_tax = Catalog::find($this->request->catalog_id)->tax;

           if($catalog_tax != 0){
               $this->request['price'] += ($this->request->price/100) * $catalog_tax;
           }
    
            $insert = $this->model->create($this->request->all());
            if ($insert) {
          
            if ($this->request->has('size')) {
                $sizes = $this->request['size'];
                $qu = $this->request['qu'];
                for ($i = 0; $i < count($sizes); $i++) {
                    if (!empty($sizes[$i])) {
                        $new = new ProductSize();
                        $new->product_id = $insert->id;
                        $new->size = $sizes[$i];
                        $new->qu = $qu[$i];
                        $new->save();
                    }
                }
            }
            
        
                
            \Session::flash('flash_message', 'catalogs successfully added.'); 
            return redirect('/admin/cartproducts');
        } else {
            \Session::flash('flash_message', 'Adding catalogs not complete, Try agin later '); 
        
            return redirect('/admin/cartproducts');
        }
    }

 
    public function show($id) {
        $status = 5;
        if ($id == "Publish") {
            $status = 1;
        } else if ($id == "Sold") {
            $status = 0;
        } else if ($id == "Hidden") {
            $status = 2;
        }
        if ($status == 5) {
            $product = Product::find($id);
            if (empty($product)) {
                abort(404);
            }
            return View($this->view . 'show', compact('product'));
        } else {
            if (is_null($this->request->value)) {
                $products = $this->model->where('status', $status)->paginate(25);
            } else {
                $this->request->flash();
                $products = $this->model->where('status', $status)->where('name', 'like', "%{$this->request->value}%")
                        ->paginate(25);
            }
            $products->setPath('catproducts');
            if ($this->request->ajax()) {
                return response()->json(view($this->view . 'loop', compact('products'))->render());
            }
            return View($this->view . 'index', compact('products'));
        }
    }

  
    public function edit($id) {

        $blocks = Block::all()->pluck('title', 'id');
        $ob = new Block();
        $ob->title = "No Block";
        $ob->id = 0;
        $blocks = array_add($blocks, $ob->id, $ob->title);
        $blocks = $blocks->sortBy('id');
        $cats = Subcat::all();
        $brands = Brand::all()->pluck('name', 'id');
        $product = $this->model->where('id', $id)->first();
          $colors=\App\Colors::all();
        $sizes= \App\Sizes::all();
        if ($product) {
            return View($this->view . 'edit', compact('product', 'cats', 'brands', 'blocks','sizes','colors'));
        } else {
            abort(404);
        }
    }

   public function createcopyproducts($id){

        $blocks = Block::all()->pluck('title', 'id');
        $ob = new Block();
        $ob->title = "No Block";
        $ob->id = 0;
        $blocks = array_add($blocks, $ob->id, $ob->title);
        $blocks = $blocks->sortBy('id');
        $cats = Subcat::all();
        $brands = Brand::all()->pluck('name', 'id');
        $product = $this->model->where('id', $id)->first();
          $colors= \App\Colors::all();
        $sizes= \App\Sizes::all();
        if ($product) {
            return View($this->view . 'productcopy', compact('product', 'cats', 'brands', 'blocks','sizes','colors'));
        } else {
            abort(404);
        }
    }
    
    
 
 
        public function update($id , Request $request){
           
            $update= Product::find($id);
            $update->price=$request->price;
            $update->cat_id=$request->cat_id;
            $update->name=$request->name;
            $update->name_ar =$request->name_ar;
            $update->desc=$request->desc;
            $update->desc_ar=$request->desc_ar;
            $update->return_policy =$request->return_policy;
            $update->return_policy_ar =$request->return_policy_ar;
            $update->status=$request->status;
            $update->custom_url=$request->custom_url;
            $update->custom_url_ar=$request->custom_url_ar;
            $update->meta_description=$request->meta_description;
            $update->meta_description_ar=$request->meta_description_ar;
            $update->duration=$request->duration;
            $update->meta_keyword=$request->meta_keyword;
            $update->meta_keyword_ar=$request->meta_keyword_ar;
            $update->meta_title=$request->meta_title;
            $update->meta_title_ar=$request->meta_title_ar;
            $update->catalog_id=$request->catalog_id;
            $update->offer=$request->offer;
            $update->model=$request->model;
            $update->sku=$request->sku;
            $update->weight=$request->weight;
            $update->type=$request->type;
            $update->save();
          
              if ($update) {
               if ($this->request->hasFile('gallary')) {
                    $delete = ProductGalary::where('catalog_id',$update->catalog_id)->delete();
        
                     $gallary = $this->request->file('gallary');
                      foreach ($gallary as $photo) {
                          $name = str_random(6) . '_' . $photo->getClientOriginalName();
                          $extension = strtolower($photo->getClientOriginalExtension());
                         if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {
                             $galary = new ProductGalary();
                             $galary->photo = $name;
                             $galary->catalog_id= $update->catalog_id;
                             $galary->save();
                             $dest = 'admin-assets/images/products/';
                             $photo->move($dest, $name);
                         }
                      }
                    }

          
                 if ($this->request->has('size')) {
                         $sizes = $this->request['size'];
                         $qu = $this->request['qu'];
                        for ($i = 0; $i < count($sizes); $i++) {
                          if (!empty($sizes[$i])) {
                            $new = new ProductSize();
                            $new->product_id = $id;
                            $new->size = $sizes[$i];
                            $new->qu = $qu[$i];
                            $new->save();
                        }
                    }
                }

                       if ($this->request->has('color')) {
                           $colors = $this->request['color'];
                            $qu = $this->request['qu2'];
                          for ($i = 0; $i < count($colors); $i++) {
                            if (!empty($colors[$i])) {
                                $new = new ProductColor();
                                $new->product_id =$id;
                                $new->color = $colors[$i];
                                $new->qu2 = $qu[$i];

                                $new->save();
                             }
                           }
                         }
                         
                            if ($this->request->has('relatedproduct')) {
                                $relatedproducts = $this->request['relatedproduct'];
                                for ($i = 0; $i < count( $relatedproducts); $i++) {
                                 if (!empty($relatedproducts[$i])) {
                                  $new = new Related();
                                  $new->product_id = $relatedproducts[$i];
                                  $new->save();
                               }
                            }
                          }
                
                        \Session::flash('flash_message', 'products successfully  updated.'); 
                          return redirect('/admin/cartproducts');
                       } else {
                         \Session::flash('flash_message', 'products   not  updated. Try agin later ');
                            return redirect('/admin/cartproducts');
                       }
                    }

   
                public function destroy($id) {
                    $delete = $this->model->destroy($id);
                    if ($delete) {
                        if ($this->request->ajax())
                            return response()->json(array('status' => 'true', 'message' => trans('lang.deletedsuccessfully')));
            
                        return redirect()->back()->with('failed', trans('lang.deletedsuccessfully'));
                    }
                    else {
                        if ($this->request->ajax())
                            return response()->json(array('status' => 'false', trans('lang.deletedfailed')));
                        return redirect()->back()->with('failed', trans('lang.deletedfailed'));
                    }
                }

      public function delgal($id) {
        $photo = ProductGalary::find($id);
        $image = 'admin-assets/images/products/' . $photo->photo;
        if (file_exists($image) && !empty($photo->photo)) {
            unlink($image);
        }
        $photo->delete();
        return redirect()->back();
    }

    public function delsize($id) {
        $photo = ProductSize::find($id);
        $photo->delete();
        return redirect()->back();
    }
    
     public  function   relateproducts(Request $request){

         $products=  Product::where('cat_id',$request->id)->get();
         $data = view('productsrelated',compact('products'))->render();
        
              return response()->json(['options'=>$data]);
     }
 
    public function delcolor($id) {
        $photo = ProductColor::find($id);
        $photo->delete();
        return redirect()->back();
    }
 
}
