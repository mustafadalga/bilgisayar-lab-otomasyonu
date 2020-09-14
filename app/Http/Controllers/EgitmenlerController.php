<?php

namespace App\Http\Controllers;

use App\Egitmenler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class EgitmenlerController extends Controller
{
public function __construct()
{
    $this->middleware(['auth', 'verified']);
    $this->middleware('admin')->except('update','egitmenler');
}
    public function home(){
        $egitmenler=Egitmenler::orderBy('adi','desc')->get();
        return view('dashboard.egitmenler.home')->with('egitmenler',$egitmenler);
    }
    public function egitmenler(){
        $egitmenler=Egitmenler::orderBy('adi','desc')->get();
        return response()->json(['egitmenler' => $egitmenler]);
}
    public function show($slug){
        $egitmen=Egitmenler::where('slug',$slug)->firstOrFail();
        $egitmen->egitim=unserialize($egitmen->egitim);
        return view('dashboard.egitmenler.show')->with('egitmen',$egitmen);
    }
    public function edit($slug){
        $egitmen=Egitmenler::where('slug',$slug)->firstOrFail();
        $egitmen->egitim=unserialize($egitmen->egitim);
        return view('dashboard.egitmenler.edit')->with('egitmen',$egitmen);
    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request,[
                'adi'=>"required",
                'email'=>"required",
                'profil_resim'=>'sometimes|nullable|mimes:jpeg,jpg,png,gif|max:1999'
            ]);

            if (Auth::user()->role==2){
                return response()->json([
                    'status' => 'danger',
                    'message'    => ['Güvenlik nedeniyle eğitmen bilgileri güncelleme özelliği pasif duruma getirilmiştir!'],
                ], 201);
            }


            $egitmen = Egitmenler::findOrFail($id);
            if ($egitmen->kullaniciYetkiKontrol($egitmen->user_id)){
                $egitmen->adi=$request->adi;
                $egitmen->nameDegistir($egitmen->user_id,$request->adi);
                $egitmen->hakkinda=$request->hakkinda;
                $egitmen->email=$request->email;
                $egitmen->emailDegistir($egitmen->user_id,$request->email);
                $egitmen->telefon=$request->tel;
                $egitmen->linkedin=$request->linkedin;
                $egitmen->website=$request->website;
                $egitmen->twitter=$request->twitter;
                $egitmen->egitim=serialize($request->egitim);
                if ($request->hasFile('profil_resim')){
                    $egitmen->resimSil($egitmen->profil_resim);
                    $file_name= $egitmen->resimYukle($request->file('profil_resim'));

                    $egitmen->profil_resim=$file_name;
                }else{
                    $egitmen->profil_resim=$egitmen->profil_resim;
                }
                $egitmen->slug=$egitmen->slugOlustur($egitmen->adi);
                $egitmen->save();

                return response()->json([
                    'status' => 'success',
                    'message'    => ['Eğitmen bilgileri güncelleme işlemi başarıyla tamamlandı.'],
                ], 201);
            }
            return response()->json([
                'status' => 'danger',
                'message'    => ['Eğitmen bilgileri güncellenemedi!'],
            ], 422);

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
                    'message'    => ['Güvenlik nedeniyle eğitmen silme özelliği pasif duruma getirilmiştir!'],
                ], 201);
            }

            $egitmen=Egitmenler::findOrFail($id);
            $egitmen->kullaniciSil($egitmen->user_id);
            $egitmen->resimSil($egitmen->profil_resim);
            $egitmen->delete();
            return response()->json([
                'status' => 'success',
                'message'    => 'Eğitmen silme işlemi başarıyla tamamlandı.',
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
