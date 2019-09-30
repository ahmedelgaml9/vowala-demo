<?php

namespace App\Http\Controllers\Seller;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Catalog;
use App\Product;
use App\Http\Requests\CatalogRequest;
use App\Subcat;
use App\Brand;
use App\ProductGalary;
use App\Specific;
use Excel;


class CatalogController extends Controller
{

    //=======  request and model and view file =============//
    public function __construct(Request $request, Catalog $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'seller/catalog/';
    }

       public function index()
       {
        if (is_null($this->request->value)) {
            $rows = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $rows = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $rows->setPath('catalogs');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('c', 'sections'))->render());
        }
        return View($this->view . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        $cats = Subcat::get()->pluck('name', 'id');
        $brands = Brand::all()->pluck('name', 'id');
        return View($this->view . 'create', compact('cats','brands','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request )
    {
        $this->request->validate([
            'name' => 'required|min:3',
            'name_ar' => 'required|min:3',
            'model' => 'required|min:3',
          
         ]);

        $insert = Product::create($this->request->all());
          if ($insert) {
            if ($request->has('spec')) {
                $specifications = $request['spec'];
                $ar_specifications = $request['spec_ar'];
                $values = $request['value'];
                $ar_values = $request['value_ar'];

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
             
            \Session::flash('flash_message', 'catalogs successfully added.'); //<--FLASH MESSAGE
            return redirect('/seller/catalog');
        } else {
            \Session::flash('flash_message', 'Adding catalogs not complete, Try agin later '); //<--FLASH MESSAGE
        
            return redirect('seller/catalog');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->model->find($id);
        if (empty($product)) {
            abort(404);
        }
        return View($this->view . 'show', compact('product'));
    }

    /**
     * Import Catalog from Excel Sheet
     *
     * @param  int  $id
     * @return Response
     */

    public function getImportExcel()
    {
        return view($this->view . 'importExcel');
    }


    public function importExcel(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $file = $request->file('import_file');
            Excel::load($file, function ($reader) {
                foreach ($reader->toArray() as $row) {
                    // Catalog::firstOrCreate($row);
                    // dd($row);
                    $catalog = new Catalog;
                    $catalog['name']    = $row['name'];
                    $catalog['ar_name']  = $row['ar_name'];
                    $catalog['cat_id']   = $row['cat_id'];
                    $catalog['brand_id'] = $row['brand_id'];
                    $catalog['return_policy']   = $row['return_policy'];
                    $catalog['ar_return_policy']          = $row['ar_return_policy'];
                    $catalog['shourtcut']                 = $row['shourtcut'];
                    $catalog['ar_shourtcut']              = $row['ar_shourtcut'];
                    $catalog['desc']                      = $row['desc'];
                    $catalog['ar_desc']                   = $row['ar_desc'];
                    $catalog['weight']                    = $row['weight'];
                    $catalog['model']                     = $row['model'];
                    $catalog['sku']                       = $row['sku'];
                    $catalog->save();
                }
                //$results = $reader->all();
            });
            if ($request->ajax()) {
                return response()->json(array('status' => 'true', 'message' => "Add Catalog Done Sucessfully"));
                return redirect()->back()->with('success', "Add Continent Done Sucessfully");
            } else {
                if ($request->ajax()) {
                    return response()->json(array('status' => 'false', 'message' => trans('Error')));
                }
                return redirect()->back()->with('failed', trans('lang.Error'));
            }
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $cats = Subcat::get()->pluck('name', 'id');
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
    public function update($id)
    {
       
        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
            if ($this->request->hasFile('gallary')) {
                //Product Gallary
                $gallary = $this->request->file('gallary');
                foreach ($gallary as $photo) {
                    $name = str_random(6) . '_' . $photo->getClientOriginalName();
                    $extension = strtolower($photo->getClientOriginalExtension());
                    if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {
                        $galary = new ProductGalary();
                        $galary->photo = $name;
                        $galary->catalog_id = $id;
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
                $ar_values = $this->request['ar_value'];

                for ($i = 0; $i < count($specifications); $i++) {
                    if (!empty($specifications[$i]) && !empty($ar_specifications[$i])) {
                        $new = new Specific();
                        $new->catalog_id = $id;
                        $new->spec = $specifications[$i];
                        $new->ar_spec = $ar_specifications[$i];
                        $new->value = $values[$i];
                        $new->ar_value = $ar_values[$i];
                        $new->save();
                    }
                }
            }
             
            \Session::flash('flash_message',  'catalogs added successfully'); 
               return redirect('/seller/catalog');
               } else {
            \Session::flash('flash_message', 'Adding resellers not complete, Try agin later '); 
       
            return redirect('/seller/catalog');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $delete = $this->model->destroy($id);
        if ($delete) {
            
            $deleteproject= Product::where('catalog_id',$id)->delete();
            if ($this->request->ajax()) {
                return response()->json(array('status' => 'true', 'message' => trans('lang.deletedsuccessfully')));
            }

                return redirect()->back()->with('failed', trans('lang.deletedsuccessfully'));
         } else {
              if ($this->request->ajax()) {
                    return response()->json(array('status' => 'false', trans('lang.deletedfailed')));
            }
                 return redirect()->back()->with('failed', trans('lang.deletedfailed'));
        }
    }
}
