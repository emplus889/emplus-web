<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User_profile;
use Response;

class UserProfileController extends Controller
{
    public function getFotoProfil($id)
    {
        $table_data = User_profile::where('id_users','=',$id)->select('id','foto_profile')->first();

		return response()
			->json([
				'model' => $table_data
			]);
    }
}
