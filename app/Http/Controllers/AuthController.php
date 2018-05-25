<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\User;
use Response;

class AuthController extends Controller
{
	// user registration
	public function register(Request $request) 
	{ 
		$validator = Validator::make($request->all(), [ 
				'name' => 'required', 
				'email' => 'required|email', 
				'mobile' => 'required', 
				'password' => 'required', 
				'c_password' => 'required|same:password', 
		]);
		if ($validator->fails()) { 
				return response()->json(['error'=>$validator->errors()], 401);            
		}
		$input = $request->all(); 
		$input['password'] = bcrypt($input['password']); 
		$user = User::create($input); 

		// Send an internal API request to get an access token
    $data = [
				'grant_type' => 'password',
				'client_id' => env('CLIENT_ID'),
				'client_secret' => env('CLIENT_SECRET'),
				'username' => request('email'),
				'password' => request('password'),
		];

		$request = Request::create('/oauth/token', 'POST', $data);

		$response = app()->handle($request);

		// Check if the request was successful
		if ($response->getStatusCode() != 200) {
				return response()->json([
						'message' => 'Wrong email or password',
						'status' => 422
				], 422);
		}

		// Get the data from the response
		$data = json_decode($response->getContent());

		// Format the final response in a desirable format
		return response()->json([
				'token' => $data->access_token,
				'user' => $user,
				'status' => 200
		]);
	}

	// login user
	public function login()
	{
		// Check if a user with the specified email exists
    $user = User::whereEmail(request('email'))->first();

    if (!$user) {
        return response()->json([
            'message' => 'Wrong email or password',
            'status' => 422
        ], 422);
    }

    // If a user with the email was found - check if the specified password
    // belongs to this user
    if (!Hash::check(request('password'), $user->password)) {
        return response()->json([
            'message' => 'Wrong email or password',
            'status' => 422
        ], 422);
    }

    // Send an internal API request to get an access token
    $data = [
        'grant_type' => 'password',
        'client_id' => env('CLIENT_ID'),
				'client_secret' => env('CLIENT_SECRET'),
        'username' => request('email'),
        'password' => request('password'),
    ];

    $request = Request::create('/oauth/token', 'POST', $data);

    $response = app()->handle($request);

    // Check if the request was successful
    if ($response->getStatusCode() != 200) {
        return response()->json([
            'message' => 'Wrong email or password',
            'status' => 422
        ], 422);
    }

    // Get the data from the response
    $data = json_decode($response->getContent());

    // Format the final response in a desirable format
    return response()->json([
        'token' => $data->access_token,
        'user' => $user,
        'status' => 200
    ]);
	}

	// check user
	public function getUser()
	{
		return auth()->user();
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
