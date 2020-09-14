<?php

namespace App\Http\Controllers;

use App\Oturumlar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OturumlarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function store(Request $request){
        try {
            $this->validate($request,[
                'gun'=>"required",
                'saat'=>"required",
                'egitmen'=>"required",
                'egitmen_id'=>"required",
                'ders'=>"required",
                'derskod'=>"required",
                'lab'=>"required"
            ]);

            if (Auth::user()->role==2){
                return response()->json([
                    'status' => 'danger',
                    'message'    => ['Güvenlik nedeniyle ders oturumu ekleme özelliği pasif duruma getirilmiştir!'],
                ], 201);
            }


            $oturum=new Oturumlar;
            if ($oturum->oturumMevcutMu($request->lab,$request->gun,$request->saat)){
                $oturum->lab_id=$request->lab;
                $oturum->ders=$request->ders;
                $oturum->derskod=$request->derskod;
                $oturum->egitmen=$request->egitmen;
                $oturum->egitmen_id=$request->egitmen_id;
                $oturum->gun=$request->gun;
                $oturum->saat=$request->saat;
                $oturum->save();
                return response()->json([
                    'status' => 'success',
                    'message'    => ['Ders oturumu ekleme işlemi başarıyla tamamlandı.'],
                ], 201);
            }
            return response()->json([
                'status' => 'danger',
                'message'    => ['Bu oturum az önce başka bir eğitmen tarafından alındı.'],
            ], 201);

        }
        catch (ValidationException $exception) {
            return response()->json([
                'status' => 'danger',
                'message'  => $exception->errors(),
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function oturumlar($id){
        $oturumlar=Oturumlar::where('lab_id',$id)->get();
        return response()->json(['oturumlar' => $oturumlar]);
    }
    public function update(Request $request,$id){

        try {
            $this->validate($request,[
                'gun'=>"required",
                'saat'=>"required",
                'egitmen'=>"required",
                'egitmen_id'=>"required",
                'ders'=>"required",
                'derskod'=>"required",
                'lab'=>"required"
            ]);

            if (Auth::user()->role==2){
                return response()->json([
                    'status' => 'danger',
                    'message'    => ['Güvenlik nedeniyle ders oturumu güncelleme özelliği pasif duruma getirilmiştir!'],
                ], 201);
            }

            $oturum=Oturumlar::find($id);
            $oturum->lab_id=$request->lab;
            $oturum->ders=$request->ders;
            $oturum->derskod=$request->derskod;
            $oturum->egitmen=$request->egitmen;
            $oturum->egitmen_id=$request->egitmen_id;
            $oturum->gun=$request->gun;
            $oturum->saat=$request->saat;
            $oturum->save();

            return response()->json([
                'status' => 'success',
                'message'    => ['Ders oturumu başarıyla güncellendi.'],
            ], 201);
        }
        catch (ValidationException $exception) {
            return response()->json([
                'status' => 'danger',
                'message'  => $exception->errors(),
                'errors' => $exception->errors(),
            ], 422);
        }
    }


    public function destroy($id){
        try {

            if (Auth::user()->role==2){
                return response()->json([
                    'status' => 'danger',
                    'message'    => ['Güvenlik nedeniyle ders oturumu silme özelliği pasif duruma getirilmiştir!'],
                ], 201);
            }

            $lab=Oturumlar::find($id);
            $lab->delete();

            return response()->json([
                'status' => 'success',
                'message'    => ['Oturum silme işlemi başarıyla tamamlandı.'],
            ], 201);
        }
        catch (ValidationException $exception) {
            return response()->json([
                'status' => 'danger',
                'message'  => $exception->errors(),
                'errors' => $exception->errors(),
            ], 422);
        }
    }
}
