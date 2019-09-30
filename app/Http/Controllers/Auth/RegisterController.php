<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response'=>'required',
            'phone' => 'required',

      ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
      {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>$data['password'],
            'phone' => $data['phone'],
             'status'=> 1,
             'active'=> 1
          ]);
    }


        public function redirectToProvider()
        
            {
                return  Socialite::driver('facebook')->redirect();
            }
        
        
         public function handleProviderCallback()
            {
                
          try{
                 $socialuser = Socialite::driver('facebook')->user();
             }  
        
          catch(exception $e){
        
            return redirect('/');
        
          }
        
        $user=User::where('facebook_id',$socialuser->getid())->first();
        
        if(!$user)
           $user = User::create([
             'facebook_id'=>$socialuser->getid(),
             'email'=>$socialuser->getemail(),
             'name'=>$socialuser->getname(),
            ]);
        
               auth()->login($user);
              return redirect()->to('/');
            }
    
}
