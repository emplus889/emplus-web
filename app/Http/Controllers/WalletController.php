<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Wallet;
use Response;

class WalletController extends Controller
{
  public function getBalance($id)
  {
      $table_data = Wallet::where('id_users','=',$id)->select('id','balance')->first();

  return response()
    ->json([
      'model' => $table_data
    ]);
  }
}
