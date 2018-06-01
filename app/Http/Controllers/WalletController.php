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
    $table_data = Wallet::where('id_users','=',$id)->first();

    return response()
      ->json([
        'model' => $table_data
      ]);
  }

  public static function createWallet($id_users)
  {
    $kelas = new Wallet;

    $kelas->id_users = $id_users;
    $kelas->no_wallet = str_random(12);
    $kelas->balance = '0';

    $kelas->save();
    
  }

  public function checkWalletNo(Request $request)
  {
    $no_wallet_origin = $request->no_wallet_origin;
    $no_wallet_destination = $request->no_wallet_destination;
        
    // check if no_wallet_origin not equal no_wallet_destination
    if($no_wallet_origin == $no_wallet_destination){
      return response()
        ->json([
            'status' => false,
            'message' => 'Maaf tidak bisa melakukan transfer ke dompet sendiri'
        ]);  
    }

    $table_data = Wallet::with('user')->where('no_wallet',$no_wallet_destination)->select('id','id_users')->get();

    // check if no_wallet_destination exist
    if($table_data == null){
      return response()
        ->json([
            'status' => false,
            'message' => 'Maaf No. Dompet tidak ditemukan, mohon diperiksa lagi.'
        ]);  
    }

    return response()
      ->json([
        'status' => true,
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
    $no_wallet_origin = $request->no_wallet_origin;
    $no_wallet_destination = $request->no_wallet_destination;
    $amount = $request->amount;

    // update origin wallet balance
    $origin = Wallet::where('no_wallet',$no_wallet_origin)->first();

    // check if origin wallet is not less than amount
    if($origin->balance < $amount){
      return response()
        ->json([
            'saved' => false,
            'message' => 'Transfer gagal, saldo tidak cukup'
        ]);  
    }

    $origin_balance = $origin->balance - $amount;
    $origin->update([
        'balance' => $origin_balance
    ]);
    
    // store new transaction
    $no_trans = TransactionController::store('',$no_wallet_origin, 'CREDIT', $request->note, $amount);

    // update destination wallet balance
    $destination = Wallet::where('no_wallet',$no_wallet_destination)->first();
    $destination_balance = $destination->balance + $amount;
    $destination->update([
        'balance' => $destination_balance
    ]);

    // store new transaction with same no_trans from transaction above
    TransactionController::store($no_trans,$no_wallet_destination, 'DEBIT', $request->note, $amount);
    
    return response()
        ->json([
            'saved' => true,
            'message' => 'transfer berhasil dilakukan'
        ]);    
  }
}
