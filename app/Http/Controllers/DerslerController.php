<?php

namespace App\Http\Controllers;

use App\Dersler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class DerslerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('admin')->except('dersler');
    }

    public function home(){
        $dersler=Dersler::orderBy('adi')->get();
        return view('dashboard.dersler.home')->with('dersler',$dersler);
    }
    public function dersler(){
        $dersler=Dersler::orderBy('adi')->get();
        return response()->json(['dersler' => $dersler]);
    }

    public function store(Request $request){

        try {
            $this->validate($request,[
                'kod'=>"required",
                'adi'=>"required",
                'kredi'=>"required|integer"
            ]);

            if (Auth::user()->role==2){
                return response()->json([
                    'status' => 'danger',
                    'message'    => ['Güvenlik nedeniyle ders ekleme özelliği pasif duruma getirilmiştir!'],
                ], 201);
            }

            $ders=new Dersler;
            $ders->kod=$request->kod;
            $ders->adi=$request->adi;
            $ders->kredi=$request->kredi;
            $ders->save();

            return response()->json([
                'status' => 'success',
                'message'    => ['Ders ekleme işlemi başarıyla tamamlandı.'],
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

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request,[
                'kod'=>"required",
                'adi'=>"required",
                'kredi'=>"required|integer"
            ]);

            if (Auth::user()->role==2){
                return response()->json([
                    'status' => 'danger',
                    'message'    => ['Güvenlik nedeniyle ders güncelleme özelliği pasif duruma getirilmiştir!'],
                ], 201);
            }


            $ders=Dersler::find($id);
            $ders->kod=$request->kod;
            $ders->adi=$request->adi;
            $ders->kredi=$request->kredi;
            $ders->save();

            return response()->json([
                'status' => 'success',
                'message'    => ['Ders güncelleme işlemi başarıyla tamamlandı.'],
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
                    'message'    => ['Güvenlik nedeniyle ders silme özelliği pasif duruma getirilmiştir!'],
                ], 201);
            }

            $ders=Dersler::find($id);
            $ders->delete();



            return response()->json([
                'status' => 'success',
                'message'    => 'Ders silme işlemi başarıyla tamamlandı.',
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
