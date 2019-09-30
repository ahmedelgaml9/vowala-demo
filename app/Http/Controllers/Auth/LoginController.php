<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App;
class LoginController extends Controller
{
    
    use AuthenticatesUsers;

  
    protected $redirectTo = '/';

  
    public function __construct()
    {
        
        
         $data=\App\Main::find(1);
        $lang =$data->setlang;
        if ($lang == 1) {

            App::setLocale('en');
        }

        else{

            App::setLocale('ar');
        }
        
        $this->middleware('guest')->except('logout');
    }
    
      protected function credentials(\Illuminate\Http\Request $request)
    {
        //return $request->only($this->username(), 'password');
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'active' => 1];
    }
}
