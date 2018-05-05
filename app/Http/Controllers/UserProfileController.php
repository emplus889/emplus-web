<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User_profile;
use Response;

class UserProfileController extends Controller
{
    protected $imagepath = 'images/fotoProfil/';

    public function getFotoProfil($id)
    {
        $table_data = User_profile::where('id_users','=',$id)->select('id','foto_profil')->first();

		return response()
			->json([
				'model' => $table_data
			]);
    }

    public function storeFotoProfil(Request $request)
    {
        if(!empty($request->gambar))
			$fileName = ImageProcessing::image_processing($this->imagepath,'300','200',$request,$kelas);
		else
            $fileName = '';
            
        $kelas = User_profile::create([
            'foto_profil' => $fileName
        ]);
        
        return response()
            ->json([
                'saved' => true,
                'message' => 'Foto profil berhasil ditambah',
                'id' => $kelas->id
            ]);    
    }

    public function updateFotoProfil(Request $request)
    {
        $kelas = User_profile::findOrFail($id);

        if(!empty($request->gambar))
			$fileName = ImageProcessing::image_processing($this->imagepath,'300','200',$request,$kelas);
		else
            $fileName = '';
            
        $kelas->update([
            'foto_profil' => $fileName
        ]);
        
        return response()
            ->json([
                'saved' => true,
                'message' => 'Foto profil berhasil diubah',
                'id' => $kelas->id
            ]);    
    }

    public function destroyFotoProfil($id)
    {
        $kelas = User_profile::findOrFail($id);

        if(!empty($kelas->foto_profil)){
			File::delete($path . $kelas->foto_profil . '.jpg');
			File::delete($path . $kelas->foto_profil . 'n.jpg');
		}
            
        $kelas->update([
            'foto_profil' => ''
        ]);
        
        return response()
            ->json([
                'saved' => true,
                'message' => 'Foto profil berhasil dihapus',
                'id' => $kelas->id
            ]);    
    }
}
