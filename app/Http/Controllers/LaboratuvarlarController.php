<?php

namespace App\Http\Controllers;

use App\Laboratuvarlar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class LaboratuvarlarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('admin');
    }

   public function home(){
       $labs=Laboratuvarlar::orderBy('adi')->get();
       return view('dashboard.laboratuvarlar.home')->with('laboratuvarlar',$labs);
   }
   public function labs(){
       $labs=Laboratuvarlar::orderBy('adi')->get();
       return response()->json(['labs' => $labs]);
   }
   public function store(Request $request){
       try {
           $this->validate($request,[
               'adi'=>"required",
           ]);

           if (Auth::user()->role==2){
               return response()->json([
                   'status' => 'danger',
                   'message'    => ['Güvenlik nedeniyle laboratuvar ekleme özelliği pasif duruma getirilmiştir!'],
               ], 201);
           }


           $lab=new Laboratuvarlar;
           $lab->adi=$request->adi;
           $lab->slug=$lab->slugOlustur($request->adi);
           $lab->save();

           return response()->json([
               'status' => 'success',
               'message'    => ['Laboratuvar ekleme işlemi başarıyla tamamlandı.'],
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

   public function show($slug){
       $lab=Laboratuvarlar::where('slug',$slug)->firstOrFail();
       return view('dashboard.laboratuvarlar.show')->with('lab',$lab);
   }
    public function update(Request $request,$id){

        try {
            $this->validate($request,[
                'adi'=>"required",
            ]);
            if (Auth::user()->role==2){
                return response()->json([
                    'status' => 'danger',
                    'message'    => ['Güvenlik nedeniyle laboratuvar adı güncelleme özelliği pasif duruma getirilmiştir!'],
                ], 201);
            }


            $lab=Laboratuvarlar::find($id);
            $lab->adi=$request->adi;
            $lab->slug=$lab->slugOlustur($request->adi);
            $lab->save();

            return response()->json([
                'status' => 'success',
                'message'    =>  ['Laboratuvar adı başarıyla güncellendi.'],
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
                   'message'    => ['Güvenlik nedeniyle laboratuvar silme özelliği pasif duruma getirilmiştir!'],
               ], 201);
           }

           $lab=Laboratuvarlar::find($id);
           $lab->delete();

           return response()->json([
               'status' => 'success',
               'message'    => ['Laboratuvar silme işlemi başarıyla tamamlandı.'],
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
