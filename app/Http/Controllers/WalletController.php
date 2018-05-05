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

  public function checkWalletNo(Request $request)
  {
    $wallet_no = $request->wallet_no;

    $table_data = Wallet::with('users')->where('wallet_no',$wallet_no)->select('id','id_user')->first();

    return response()
      ->json([
        'model' => $table_data
      ]);
  }

  public function transferBalance(Request $request)
  {
    $originId = $request->originId;
    $destinationId = $request->destinationId;
    $balance = $request->balance;

    $origin = Wallet::findOrFail($originId);
    $destination = Wallet::findOrFail($destinationId);

    $originBalance = $origin->balance - $balance;
    $destinationBalance = $destination->balance + $balance;
    
    $origin->update([
        'balance' => $originBalance
    ]);

    $destination->update([
        'balance' => $destinationBalance
    ]);
    
    return response()
        ->json([
            'saved' => true,
            'message' => 'transfer berhasil dilakukan',
            'id' => $kelas->id
        ]);    
  }
}
