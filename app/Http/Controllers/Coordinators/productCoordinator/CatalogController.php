<?php

namespace App\Http\Controllers\Coordinators\productCoordinator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Catalog;
use App\Http\Requests\CatalogRequest;
use App\Subcat;
use App\Brand;
use App\ProductGalary;
use App\Specific;
use Excel;

//use Auth;

class CatalogController extends Controller {

    //=======  request and model and view file =============//
    public function __construct(CatalogRequest $request, Catalog $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'coordinators/productCoordinator/catalog/';
    }

    public function index() {
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
    public function create() {
        $cats = Subcat::get()->lists('name', 'id');
        $brands = Brand::all()->lists('name', 'id');
        return View($this->view . 'create', compact('cats', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $insert = $this->model->create($this->request->all());
        if ($insert) {
            /**
             *  upload product galary
             */
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
                $ar_specifications = $this->request['ar_spec'];
                $values = $this->request['value'];
                $ar_values = $this->request['ar_value'];

                for ($i = 0; $i < count($specifications); $i++) {
                    if (!empty($specifications[$i]) && !empty($ar_specifications[$i])) {
                        $new = new Specific();
                        $new->catalog_id = $insert->id;
                        $new->spec = $specifications[$i];
                        $new->ar_spec = $ar_specifications[$i];
                        $new->value = $values[$i];
                        $new->ar_value = $ar_values[$i];
                        $new->save();
                    }
                }
            }
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => "Add Catalog Done Sucessfully"));
            return redirect()->back()->with('success', "Add Continent Done Sucessfully");
        }
        else {
            if ($this->request->ajax())
                return response()->json(array('status' => 'false', 'message' => trans('Error')));
            return redirect()->back()->with('failed', trans('lang.Error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $product = $this->model->find($id);
        if (empty($product)) {
            abort(404);
        }
        return View($this->view . 'show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $cats = Subcat::get()->lists('name', 'id');
        $brands = Brand::all()->lists('name', 'id');
        $product = $this->model->where('id', $id)->first();
        if ($product) {
            return View($this->view . 'edit', compact('product', 'cats', 'brands', 'blocks'));
        } else {
            abort(404);
        }
    }

    /**
     * Import Catalog from Excel Sheet
     *
     * @param  int  $id
     * @return Response
     */

    public function getImportExcel()
    {
      return view ($this->view . 'importExcel');
    }


    public function importExcel(Request $request)
     {

          if ($this->request->hasFile('import_file')) {
                $file = $this->request->file('import_file');
                Excel::load($file, function ($reader) {
                   foreach ($reader->toArray() as $row) {
                        // Catalog::firstOrCreate($row);
                        // dd($row);
                        $catalog = New Catalog;
                        $catalog['name']                      = $row['name'];
                        $catalog['ar_name']                   = $row['ar_name'];
                        $catalog['cat_id']                    = $row['cat_id'];
                        $catalog['brand_id']                  = $row['brand_id'];
                        $catalog['return_policy']             = $row['return_policy'];
                        $catalog['ar_return_policy']          = $row['ar_return_policy'];
                        $catalog['shourtcut']                 = $row['shourtcut'];
                        $catalog['ar_shourtcut']              = $row['ar_shourtcut'];
                        $catalog['desc']                      = $row['desc'];
                        $catalog['ar_desc']                   = $row['ar_desc'];
                        $catalog['weight']                    = $row['weight'];
                        $catalog->save();
                   }
                  //$results = $reader->all();

                });
                if ($this->request->ajax()){
                    return response()->json(array('status' => 'true', 'message' => "Add Catalog Done Sucessfully"));
                return redirect()->back()->with('success', "Add Continent Done Sucessfully");
            }
            else {
                if ($this->request->ajax())
                    return response()->json(array('status' => 'false', 'message' => trans('Error')));
                return redirect()->back()->with('failed', trans('lang.Error'));
            }
          }
     }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
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
                $ar_specifications = $this->request['ar_spec'];
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
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => 'Update Catalog Done'));
            return redirect()->back()->with('success', 'Update Continent Done');
        }else {
            if ($this->request->ajax())
                return response()->json(array('status' => 'false', 'message' => 'Update Faild'));

            return redirect()->back()->with('failed', 'Update Faild');
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

}
