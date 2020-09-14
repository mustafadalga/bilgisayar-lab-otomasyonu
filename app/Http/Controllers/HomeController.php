<?php

namespace App\Http\Controllers;

use App\Dersler;
use App\Egitmenler;
use App\Laboratuvarlar;
use App\Oturumlar;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role==3){
                return $next($request);
            }
            return redirect('/dashboard');
        });
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('egitmenler.home');
    }
    public function aktifProfil(){
        $user_id=Auth::id();
        $user=Egitmenler::where('user_id',$user_id)->firstOrFail();
        return response()->json(['egitmen'=>$user]);
    }
    public function profilShow($slug){
        $egitmen=Egitmenler::where('slug',$slug)->firstOrFail();
        $egitmen->egitim=unserialize($egitmen->egitim);
        return view('egitmenler.show')->with('egitmen',$egitmen);
    }
    public function profilEdit($slug){
        $egitmen=Egitmenler::where('slug',$slug)->firstOrFail();
        $egitmen->egitim=unserialize($egitmen->egitim);
        return view('egitmenler.edit')->with('egitmen',$egitmen);
    }
    public function settings(){
        return view('egitmenler.settings');
    }
    public function parolaDegistir(Request $request, $id){
        try {
            $uyari="";
            $status="success";
            $this->validate($request,[
                'parola' => 'required|min:6',
                'parola_onay' =>'required|min:6',
                'aktif_parola' => 'required|min:6',
            ]);

            if ($this->parolalarEsitMi($request)){
                $egitmen=User::findOrFail($id);
                if ($this->aktifParolaDogruMu($request->aktif_parola,$egitmen->password)){
                    $egitmen->password=Hash::make($request->parola);
                    $egitmen->save();
                    $uyari=["Eğitmen bilgileri güncelleme işlemi başarıyla tamamlandı."];
                }else{
                    $status="danger";
                    $uyari=["Aktif kullandığınız parola hatalı"];
                }
            }else{
                $status="danger";
                $uyari=["Parolalar eşleşmiyor"];
            }
            return response()->json([
                'status' => $status,
                'message'    => $uyari,
            ], 201);
        }
        catch (ValidationException $exception) {
            return response()->json([
                'status' => 'danger',
                'message'  => $exception->errors(),
            ], 422);
        }
    }
    public function aktifParolaDogruMu($girilen_parola,$aktif_parola){
        if (Hash::check($girilen_parola,$aktif_parola)){
            return true;
        }else{
            return false;
        }
    }
    public function parolalarEsitMi($request){
        if ($request->parola == $request->parola_onay){
            return true;
        }else{
            return false;
        }
    }
    public function hesapSil($id){
       $this->oturumlarSil($id);
       $this->egitmenSil($id);
       $this->kullaniciSil($id);
    }
    public function oturumlarSil($id){
        Oturumlar::where('egitmen_id',$id)->delete();
    }
    public function egitmenSil($id){
      $egitmen=Egitmenler::where('user_id',$id)->firstOrFail();
        $egitmen->kullaniciSil($egitmen->user_id);
      $egitmen->resimSil($egitmen->profil_resim);
        $egitmen->delete();
    }
    public function kullaniciSil($id){
        $user=User::findOrFail($id);
        $user->delete();
    }
    public function dersler(){
        $dersler=Dersler::all();
        return view('egitmenler.dersler')->with('dersler',$dersler);
    }
    public function egitmenler(){
        $egitmenler=Egitmenler::orderBy('adi','desc')->get();
        return view('egitmenler.egitmenler')->with('egitmenler',$egitmenler);
    }
    public function laboratuvarlar(){
        $labs=Laboratuvarlar::with('Oturumlar')->get();
        return view('egitmenler.laboratuvarlar')->with('laboratuvarlar',$labs);
    }
    public function laboratuvarShow($slug){
        $lab=Laboratuvarlar::where('slug',$slug)->firstOrFail();
        $aktif_egitmen=Egitmenler::where('user_id',auth()->id())->firstOrFail();
        return view('egitmenler.laboratuvarshow')->with(compact('lab','aktif_egitmen'));
    }
}
