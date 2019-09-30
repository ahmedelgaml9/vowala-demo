<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests\UsersRequest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class UsersController extends Controller
{
    public $successStatus = 200;
    
    
   public function login(){
       
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['id'] =  $user->id;
            return response()->json(['success' => $success], $this->successStatus);
        }
           else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

      public function getbankmasrapi(){
     
       $client = new Client();
       $credentials = base64_encode('merchant.WAFFARNA_EGP:7428e163cd6fdb1fce97dc96bae4b0a2');
       $response = $client->post('https://banquemisr.gateway.mastercard.com/api/rest/version/52/merchant/WAFFARNA_EGP/session',

          [
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
            ],
        ]);
      
           $items = json_decode($response->getBody(), true);
            foreach ($items['session'] as $key => $item) {
              if($key == 'id'){
                  $specificId = $item;
                    return  $specificId ;

              }
           }
      }

           
       public function register(Request $request)
        {
          $validator = Validator::make($request->all(), [
             'email' => 'required|email|unique:users',
             'password' => 'required',
             'password_confirmation' => 'required|same:password',
             'phone' => 'required|numeric',
             'name' => 'required',
             'country' => 'required',
             
         ]);
        
         if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
         }
            $input = $request->all();
           // $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            $success['id'] =  $user->id;

          return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = auth()->user();
        // return response()->json(['success' => $user], $this->successStatus);
        return response([
         "success" => true,
         "message" => "The users information",
         'info' => $user
       ], 200);
    }
}
