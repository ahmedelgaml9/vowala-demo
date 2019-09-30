<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogCat;
use App\Blog;
use App\BlogGalary;
use App;

use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{

    public function __construct(Request $request, Blog $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/blogs/';
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
        if (is_null($this->request->value)) {
            $rows = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $rows = $this->model->where('title', 'like', "%{$this->request->value}%")->orwhere('ar_title', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $rows->setPath('blogs');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('rows'))->render());
        }
        return View($this->view . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cats = BlogCat::all()->pluck('name', 'id');
        return View($this->view . 'create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $insert = $this->model->create($this->request->all());
        if ($insert) {
  
            if ($request->hasFile('gallary')) {
                //Product Gallary
                $gallary = $request->file('gallary');
                foreach ($gallary as $photo) {
                    $name = str_random(6) . '_' . $photo->getClientOriginalName();
                    $extension = strtolower($photo->getClientOriginalExtension());
                    if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {
                        $galary = new BlogGalary();
                        $galary->photo = $name;
                        $galary->blog_id = $insert->id;
                        $galary->save();
                        $dest = 'admin-assets/images/blogs/';
                        $photo->move($dest, $name);
                    }
                }
            }
            
        
            
            \Session::flash('flash_message', 'blogs added successfully added.'); //<--FLASH MESSAGE
           
            return redirect('admin/blog');
        } else {
            \Session::flash('flash_message', 'Adding blogs not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect('admin/blog');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $row = $this->model->where('id', $id)->first();
        $cats = BlogCat::all()->pluck('name', 'id');

        if ($row) {
            return View($this->view . 'edit', compact('row', 'cats'));
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
                      $galary = new BlogGalary();
                        $galary->photo = $name;
                        $galary->blog_id = $insert->id;
                        $galary->save();
                        $dest = 'admin-assets/images/blogs/';
                        $photo->move($dest, $name);
                    }
                }
            }
            
            \Session::flash('flash_message', 'blogs updated successfully'); //<--FLASH MESSAGE
           
            return redirect('admin/blog');
        } else {
            \Session::flash('flash_message', 'update blogs not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect('admin/blog');
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
            \Session::flash('flash_message', 'blogs deleted successfully'); //<--FLASH MESSAGE
           
            return redirect('admin/blog');
        } else {
            \Session::flash('flash_message', 'delete blogs not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect('admin/blog');
        }
    }
}
