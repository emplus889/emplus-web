<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use Response;

class TransactionController extends Controller
{
  public function index($no_wallet)
  {
    $table_data = Transaction::where('no_wallet',$no_wallet)->get();

    return response()
    ->json([
      'model' => $table_data
    ]);
  }

  public static function store($no_trans,$no_wallet,$type,$note,$amount)
  {
    $kelas = new Transaction;

    if($no_trans == ''){
      $no_trans = static::generate_no_trans($no_wallet);
    }
    
    $kelas->no_trans = $no_trans;
    $kelas->no_wallet = $no_wallet;
    $kelas->type = $type;
    $kelas->note = $note;
    $kelas->amount = $amount;
    
    $kelas->save();

    return $no_trans;
  }

  private static function generate_no_trans($no_wallet)
  {
    $sub_no_wallet = substr($no_wallet,-3);
    $random = str_random(4);
    $date = date('Ymd');

    return $sub_no_wallet . $random . $date;
  }
}
