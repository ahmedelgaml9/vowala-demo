<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\User;
use App\Http\Requests\UserRequest;
use App\Country;
use App\Shipmentaddress;
use App\Zone;
use App;




class UsersController extends Controller
{

   
    public function __construct(Request $request, User $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/users/';
        
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
            $users = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $users = $this->model->where('name', 'like', "%{$this->request->value}%")->where('email', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $users->setPath('users');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('users'))->render());
        }
            return View($this->view . 'index', compact('users'));
    }

    public function managers()
    {
            $users = $this->model->where('permission','!=',0)->paginate(25);
            $cities = Zone::all()->pluck('name', 'id');
        return View($this->view . 'managerusers', compact('users','cities'));
    }
   
   
    public function sellers()
      {
        $users = $this->model->where('permission',2)->paginate(25);
        $cities = Zone::all()->pluck('name', 'id');

            return View($this->view . 'selleruser', compact('cities','users'));
      }
   
         public function  clients()
        {
          $users = $this->model->where('permission','=',0)->paginate(25);
          $cities = Zone::all()->pluck('name', 'id');
             return View($this->view . 'managerusers', compact('users','cities'));
        }
   
    public function create()
    {
        $countries = Country::all()->pluck('name', 'id');
        $cities = Zone::all()->pluck('name', 'id');

        return View($this->view . 'create', compact('countries','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
          public function store()
          
        {

         $this->request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users',
            'f_name' => 'required|min:3',
            'l_name' => 'required|min:3',
            'address'=> 'required|min:3',
             'city' => 'required',
            'phone'=> 'required|min:11',
             'password' => 'required',
             'password_confirmation' =>'required|same:password',
       ]);

        $insert = $this->model->create($this->request->all());
         if ($insert) {
                
            \Session::flash('flash_message', 'users add successfully '); 
            return redirect('admin/users');
        } else {
            \Session::flash('flash_message', 'users not add successfully ');
            return redirect()->back();
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
        $status = 0;
        if ($id == "admin") {
            $status = 1;
        }
        if ($id == "support") {
            $status = 3;
        }
        if ($id == "productCoordinator") {
            $status = 4;
        }
        if ($id == "sellers") {
            $status = 2;
        }
        if ($id == "buyers") {
            $status = 0;
        }
        if (is_null($this->request->value)) {
            $users = $this->model->where('permission', $status)->paginate(25);
        } else {
            // $this->request->flash();
            $users = $this->model->where('permission', $status)->where('name', 'like', "%{$this->request->value}%")->where('email', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $users->setPath($id);
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('users'))->render());
        }
        return View($this->view . 'index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->model->where('id', $id)->first();
        if ($user) {
            $countries = Country::all()->pluck('name', 'id');
            $cities = Zone::all()->pluck('name', 'id');

            return View($this->view . 'edit', compact('user', 'countries','cities'));
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
    public function update($id,Request $request)
    {

        $this->request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'f_name' => 'required|min:3',
            'l_name' => 'required|min:3',
            'address'=> 'required|min:3',
             'city' => 'required',
             'phone'=> 'required|min:11',
             'password' => 'required',
             'password_confirmation' => 'required|same:password',
            ]);  

          $update = $this->model->find($id)->update($this->request->all());
          if ($update) {
            
            \Session::flash('flash_message', 'users  updated successfully '); //<--FLASH MESSAGE
            return redirect('admin/users');
        } else {
            \Session::flash('flash_message',  'users not updated successfully '); //<--FLASH MESSAGE
            return redirect()->back();
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
            if ($this->request->ajax()) {
                return response()->json(array('status' => 'true', 'message' => trans('lang.deletedsuccessfully')));
            }

                return redirect()->back()->with('failed', trans('lang.deletedsuccessfully'));
           }else{
            if ($this->request->ajax()) {
                return response()->json(array('status' => 'false', trans('lang.deletedfailed')));
            }
            return redirect()->back()->with('failed', trans('lang.deletedfailed'));
        }
    }

    public function information()
    {
        $admin = Admin::where('permission', 1)->pluck('name', 'id');
        return View($this->view . 'information', compact('admin'));
    }
}
