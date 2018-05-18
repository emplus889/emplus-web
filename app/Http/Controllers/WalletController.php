<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionController;
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

  public function createWallet(Request $request)
  {
    $this->validate($request,LaporanCu::$rules);

    $kelas = User_profile::create($request->all());
  
    return response()
      ->json([
          'saved' => true,
          'message' => 'Wallet berhasil dibuat',
          'id' => $kelas->id
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

  public function addBalance(Request $request)
  {
    $wallet_no = $request->wallet_no;

    $kelas = Wallet::with('users')->where('wallet_no',$wallet_no);

    $kelas->balance = $kelas->balance + $request->amount;
    $kelas->save();

    TransactionController::store($request->$origin_no, 'DEBIT','Top Up Saldo', $balance);

    return response()
      ->json([
          'saved' => true,
          'message' => 'Saldo berhasil ditambah',
          'kelas' => $kelas
      ]);  
  }

  public function transferBalance(Request $request)
  {
    $origin_no = $request->origin_no;
    $destination_no = $request->origin_no;
    $balance = $request->balance;

    // update origin wallet balance
    $origin = Wallet::where('wallet_no',$origin_no);
    $origin_balance = $origin->balance - $balance;
    $origin->update([
        'balance' => $origin_balance
    ]);
    
    // store new transaction
    $no_trans = TransactionController::store('',$request->$origin_no, 'CREDIT', $request->note, $balance);

    // update destination wallet balance
    $destination = Wallet::where('wallet_no',$destination_no);
    $destination_balance = $destination->balance + $balance;
    $destination->update([
        'balance' => $destination_balance
    ]);

    // store new transaction
    TransactionController::store($no_trans,$request->$destination_no, 'DEBIT', $request->note, $balance);
    
    return response()
        ->json([
            'saved' => true,
            'message' => 'transfer berhasil dilakukan'
        ]);    
  }
}
