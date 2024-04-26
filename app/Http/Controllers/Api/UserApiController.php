<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use DB;
use Hash;
use URL;
use Arr;
use App\Models\User;
use Auth;


class UserApiController extends Controller
{
     /*
     * @function loginAction
     *
     * login
     *
     * @param
     * null
     *
     * @return
     * view
     *
     * @author
     * Monish K M
     */

    public function loginAction(Request $request)
    {
        $data = array(      
                'email' => strip_tags($request->email),
                'password' => strip_tags($request->password)
            );

         $validator = Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            
            $yourData =['status' => false, 'data' => null, 'message' => $validator->errors()->first()];

            return response()->json($yourData, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $userData = User::where('id', $user->id)->first();
            $token = $user->createToken('MyApp')->accessToken;

            $data = array('token' =>$token, 'userData' => $userData);
            return response()->json(['status' => true, 'data' => $data, 'message' => 'login successfully']);
                
            
        } else {
            return response()->json(['status' => false, 'data' => 'Unauthorised', 'message' => 'Login Failed']);
        }
    }


}
