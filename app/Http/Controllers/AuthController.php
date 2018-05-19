<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	// user registration
	public function register(Request $request) 
	{ 
			$validator = Validator::make($request->all(), [ 
					'name' => 'required', 
					'email' => 'required|email', 
					'mobile' => 'required|mobile', 
					'password' => 'required', 
					'c_password' => 'required|same:password', 
			]);
			if ($validator->fails()) { 
					return response()->json(['error'=>$validator->errors()], 401);            
			}
			$input = $request->all(); 
			$input['password'] = bcrypt($input['password']); 
			$user = User::create($input); 
			$success['token'] =  $user->createToken('MyApp')-> accessToken; 
			$success['name'] =  $user->name;

			return response()->json(['status' => 201]);
	}

	// login user
	public function login()
	{
		// TODO: hide client_id and client_secret
		$data = [
				'grant_type' => 'password',
				'client_id' => env('CLIENT_ID'),
				'client_secret' => env('CLIENT_SECRET'),
				'username' => request('username'),
				'password' => request('password'),
		];

		$request = Request::create('/oauth/token', 'POST', $data);
		return app()->handle($request);
	}

	// logout user
	public function logout()
	{
		$accessToken = auth()->user()->token();

    $refreshToken = DB::table('oauth_refresh_tokens')
        ->where('access_token_id', $accessToken->id)
        ->update([
            'revoked' => true
        ]);

    $accessToken->revoke();

    return response()->json(['status' => 200]);
	}

}
