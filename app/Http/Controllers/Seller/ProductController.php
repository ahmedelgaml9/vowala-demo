<?php

namespace App\Http\Controllers\Seller;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Product;
use App\Subcat;
use App\Brand;
use App\ProductGalary;
use App\Http\Requests\ProductRequest;
use App\ProductSize;
use App\Block;
use App\Specific;
use App\Catalog;

class ProductController extends Controller {

    //=======  request and model and view file =============//
    public function __construct(Request $request, Product $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'seller/products/';
    }
    public function index() {
        if (is_null($this->request->value)) {
            $products = $this->model->where('user_id',auth()->user()->id)->paginate(25);
        } else {
            // $this->request->flash();            
            $products = $this->model->Where('sku','like', "{$this->request->value}%")
                                    ->orWhere('title', 'like', "%{$this->request->value}%")
                                    ->orWhere('title_ar', 'like', "%{$this->request->value}%")
                                    ->paginate(25);
        }
        $products->setPath('ourproducts');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('products'))->render());
        }
        return View($this->view . 'index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $blocks = Block::all()->pluck('title', 'id');
        $ob = new Block();
        $ob->title = "No Block";
        $ob->id = 0;
        $blocks = array_add($blocks, $ob->id, $ob->title);
        $blocks = $blocks->sortBy('id');
        $cats = Subcat::get()->pluck('name', 'id');
        $brands = Brand::all()->pluck('name', 'id');
        return View($this->view . 'create', compact('cats', 'shipments', 'blocks', 'brands'));
    }

    public function createcatalog() {
        $blocks = Block::all()->pluck('title', 'id');
        $ob = new Block();
        $ob->title = "No Block";
        $ob->id = 0;
        $blocks = array_add($blocks, $ob->id, $ob->title);
        $blocks = $blocks->sortBy('id');
        $cats = Catalog::get()->pluck('name', 'id');
        return View($this->view . 'create2', compact('cats', 'shipments', 'blocks', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
        public function store() {
           $insert = Catalog::create($this->request->all());
          if ($insert) {
            $this->request['catalog_id'] = $insert->id;
            $this->request['brand_id'] = $insert->brand_id;
            $catalog_tax = $insert->tax;
            if($catalog_tax != 0){
                $this->request['price'] += ($this->request->price/100) * $catalog_tax;
            }
            
            $insert2 = $this->model->create($this->request->all());
            if ($this->request->hasFile('gallary')) {
                //Product Gallary
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
            if ($this->request->has('spec')) {
                $specifications = $this->request['spec'];
                $ar_specifications = $this->request['spec_ar'];
                $values = $this->request['value'];
                $ar_values = $this->request['value_ar'];

                for ($i = 0; $i < count($specifications); $i++) {
                    if (!empty($specifications[$i]) && !empty($ar_specifications[$i])) {
                        $new = new Specific();
                        $new->catalog_id = $insert->id;
                        $new->spec = $specifications[$i];
                        $new->spec_ar = $ar_specifications[$i];
                        $new->value = $values[$i];
                        $new->value_ar = $ar_values[$i];
                        $new->save();
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

            \Session::flash('flash_message', 'products successfully added.'); //<--FLASH MESSAGE
            return redirect('/seller/ourproducts');
          }
          
          else {
            \Session::flash('flash_message', 'Adding catalogs not complete, Try agin later '); //<--FLASH MESSAGE
        
            return redirect('/seller/ourproducts');
        }
    }

    public function storecatalog() {
        $catalog_tax = Catalog::find($this->request->catalog_id)->tax;

        if($catalog_tax != 0){
            $this->request['price'] += ($this->request->price/100) * $catalog_tax;
        }

        $insert = $this->model->create($this->request->all());
        if ($insert) {
            /**
             *  upload product galary
             */
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
               
            \Session::flash('flash_message', 'catalogs successfully added.'); //<--FLASH MESSAGE
            return redirect('/admin/ourproducts');
        } else {
            \Session::flash('flash_message', 'Adding catalogs not complete, Try agin later '); //<--FLASH MESSAGE
        
            return redirect('/admin/ourproducts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $blocks = Block::all()->pluck('title', 'id');
        $ob = new Block();
        $ob->title = "No Block";
        $ob->id = 0;
        $blocks = array_add($blocks, $ob->id, $ob->title);
        $blocks = $blocks->sortBy('id');
        $cats = Catalog::get()->pluck('name', 'id');
        $brands = Brand::all()->pluck('name', 'id');
        $product = $this->model->where('id', $id)->first();
        if ($product) {
            return View($this->view . 'edit', compact('product', 'cats', 'brands', 'blocks'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function update($id , Request $request) {
             //  $update = $this->model->find($id)->update($this->request->all//());
            $update= Product::find($id);
            $update->price=$request->price;
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
             $update->save();
          
        if ($update) {
            if ($this->request->hasFile('gallary')) {
                $gallary = $this->request->file('gallary');
                foreach ($gallary as $photo) {
                    $name = str_random(6) . '_' . $photo->getClientOriginalName();
                    $extension = strtolower($photo->getClientOriginalExtension());
                    if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {
                        $galary = new ProductGalary();
                        $galary->photo = $name;
                        $galary->product_id = $id;
                        $galary->save();
                        $dest = 'admin-assets/images/products/';
                        $photo->move($dest, $name);
                    }
                }
            }

            if ($this->request->has('spec')) {
                $specifications = $this->request['spec'];
                $ar_specifications = $this->request['spec_ar'];
                $values = $this->request['value'];
                $ar_values = $this->request['value_ar'];

                for ($i = 0; $i < count($specifications); $i++) {
                    if (!empty($specifications[$i]) && !empty($ar_specifications[$i])) {
                        $new = new Specific();
                        $new->product_id = $id;
                        $new->spec = $specifications[$i];
                        $new->spec_ar = $ar_specifications[$i];
                        $new->value = $values[$i];
                        $new->value_ar = $ar_values[$i];
                        $new->save();
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

                
            \Session::flash('flash_message', 'products successfully  updated.'); //<--FLASH MESSAGE
            return redirect('/admin/cartproducts');
        } else {
            \Session::flash('flash_message', 'products   not  updated. Try agin later '); //<--FLASH MESSAGE
        
            return redirect('/admin/cartproducts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
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

    /*
     * Delete From Product Galary
     */

    public function delgal($id) {
        $photo = ProductGalary::find($id);
        $image = 'admin-assets/images/products/' . $photo->photo;
        if (file_exists($image) && !empty($photo->photo)) {
            unlink($image);
        }
        $photo->delete();
        return redirect()->back();
    }

    /*
     * Delete From Product Sizes
     */

    public function delsize($id) {
        $photo = ProductSize::find($id);
        $photo->delete();
        return redirect()->back();
    }

    /*
     * Delete From Product Specfication
     */

    public function delspec($id) {
        $photo = Specific::find($id);
        $photo->delete();
        return redirect()->back();
    }

}
