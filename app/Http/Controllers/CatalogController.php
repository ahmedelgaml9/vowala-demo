<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Catalog;
use App\Product;
use App\Subcat;
use App\Brand;
use App\ProductGalary;
use App\Specific;
use Maatwebsite\Excel\Facades\Excel;
use App;

class CatalogController extends Controller
{

    public function __construct(Request $request, Catalog $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/catalog/';
         $data=\App\Main::find(1);
        $lang =$data->setlang;
        if ($lang == 1) {

            App::setLocale('en');
        }

        else{

            App::setLocale('ar');
        }    
        
    }

        public function index()
        {
           $cats = Subcat::all();
        if (is_null($this->request->value)) {
            $rows = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $rows = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
          $rows->setPath('catalog');
          if ($this->request->ajax()) {
              return response()->json(view($this->view . 'loop', compact('c', 'sections'))->render());
          }
               return View($this->view . 'index', compact('rows','cats'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
      {
        $cats = Subcat::all();
        $brands = Brand::all()->pluck('name', 'id');
        return View($this->view . 'create', compact('cats', 'brands'));
    }

   
    public function store(Request $request )
    {
        $request->validate([
            
            'photo'=>'required|image',
            'name' => 'required|min:3',
            'name_ar' => 'required|min:3',
            'model' => 'required|min:3',
            'sku' => 'required|min:3',
            'desc' => 'required|min:3',
            'desc_ar' => 'required|min:3',
          ]);
   
        $insert = $this->model->create($this->request->all());      
          if ($insert) {
            if ($request->hasFile('gallary')) {
                //Product Gallary
                $gallary = $request->file('gallary');
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
           
            \Session::flash('flash_message', 'catalogs successfully added.'); //<--FLASH MESSAGE
            return redirect('admin/ourcatalog');
        } else {
            \Session::flash('flash_message', 'Adding catalogs not complete, Try agin later '); //<--FLASH MESSAGE
        
            return redirect('admin/ourcatalog');
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

  
         public function Exportcatalogs()
          {

             $data =Catalog::select('id','name','name_ar','cat_id','photo','weight','model','sku','brand_id')->get()->toArray();
                 return Excel::create('Catalog Sheet', function($excel) use ($data) {

             $excel->sheet('mySheet', function($sheet) use ($data)
            {
               $sheet->fromArray($data);
            });

           })->download('xls');
      }
    
    
    public function getImportExcel()
    {
       return view($this->view . 'importexcel');
    }


    public function importExcel(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $file = $request->file('import_file');
            Excel::load($file, function ($reader) {
                foreach ($reader->toArray() as $row) {
                    $catalog = new Catalog;
                    $catalog['name']    = $row['name'];
                    $catalog['name_ar']  = $row['name_ar'];
                    $catalog['cat_id']   = $row['cat_id'];
                    $catalog['brand_id'] = $row['brand_id'];
                    $catalog['weight']    = $row['weight'];
                    $catalog['model']     = $row['model'];
                    $catalog['sku']       = $row['sku'];
                    $catalog->save();
                 }
              });
              
              \Session::flash('flash_message',  'import files sucessfuly'); 
               return redirect('/admin/catalogs');
               
        }
        
        
    }
    
    
    
    public function edit($id)
     {
        $cats = Subcat::all();
        $brands = Brand::all()->pluck('name', 'id');
        $product = $this->model->where('id', $id)->first();
        if ($product) {
            return View($this->view . 'edit', compact('product', 'cats', 'brands', 'blocks'));
        } else {
            abort(404);
        }
    }

  
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
               return redirect('/admin/ourcatalog');
               } else {
            \Session::flash('flash_message', 'Adding resellers not complete, Try agin later '); 
       
            return redirect('/admin/ourcatalog');
        }
    }
    

   public function search()
    {
        $rows= Catalog::where('cat_id',$this->request->category_sort)->get();
        if ($rows) {
            return View($this->view . 'search', compact('product','cats','rows'));
        } else {
            abort(404);
        }
    }
   
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
