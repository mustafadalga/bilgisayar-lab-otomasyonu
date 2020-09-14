<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('login','postLogin');
        $this->middleware('admin')->except('login','postLogin');

    }
    public function home(){
        return view('dashboard.home');
    }
    public function yoneticiler(){
        $yoneticiler=User::where('role',1)->orWhere('role',2)->get();
        return view('dashboard.yoneticiler.home')->with('yoneticiler',$yoneticiler);
    }
    public function yoneticiList(){
        $yoneticiler=User::where('role',1)->orWhere('role',2)->get();
        return response()->json(['yoneticiler'=>$yoneticiler]);
    }
    public function ayarlar(){
        return view('dashboard.yoneticiler.ayarlar');
    }
    public function ayarlarUpdate(Request $request, $id){
        try {
            $uyari="";
            $status="success";
            $statusCode=201;
            $this->validate($request,[
                'adi' => 'required',
                'email' => 'required|email',
                'parola' => 'sometimes|nullable|min:6',
                'parola_onay' => 'sometimes|nullable|min:6',
                'aktif_parola' => 'required|min:6',
            ]);
            $yonetici=User::findOrFail($id);
            $yonetici->name=$request->adi;
            $yonetici->email=$request->email;
            if ($this->yeniParolaVarMi($request)){
                if ($this->parolalarEsitMi($request)){
                    if ($this->aktifParolaDogruMu($request->aktif_parola,$yonetici->password)){
                        $yonetici->password=Hash::make($request->parola);
                        $yonetici->save();

                        $uyari=["Yönetici bilgileri güncelleme işlemi başarıyla tamamlandı."];
                    }else{
                        $statusCode=422;
                        $status="danger";
                        $uyari=["Aktif kullandığınız parola hatalı"];
                    }
                }else{
                    $status="danger";
                    $statusCode=422;
                    $uyari=["Parolalar eşleşmiyor"];
                }
            }else{
                if ($this->aktifParolaDogruMu($request->aktif_parola,$yonetici->password)){
                    $yonetici->save();
                    $uyari=["Yönetici bilgileri güncelleme işlemi başarıyla tamamlandı."];
                }else{
                    $status="danger";
                    $statusCode=422;
                    $uyari=["Aktif kullandığınız parola hatalı"];
                }
            }
            return response()->json([
                'status' => $status,
                'message'    => $uyari,
            ], $statusCode);
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
    public  function yeniParolaVarMi($request)  {
        if ($request->parola or $request->parola_onay){
                return true;
        }else{
            return false;
        }
    }
    public function destroy($id){
        $yonetici=User::find($id);
        $yonetici->delete();
    }
    public function yoneticiEkle(Request $request){

        try {
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
            if ($request->password!=$request->password_confirmation){
                return response()->json([
                    'status' => 'danger',
                    'message'    =>['Parolalar eşleşmiyor.'],
                ], 422);
            }
            $this->userCreate($request->all());
            return response()->json([
                'status' => 'success',
                'message'    =>['Yönetici ekleme işlemi başarıyla tamamlandı.'],
            ], 201);
        }
        catch (ValidationException $exception) {
            return response()->json([
                'status' => 'danger',
                'message'  => $exception->errors(),
            ], 422);
        }

    }
    public function userCreate(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role'=>2,
            'password' => Hash::make($data['password'])
        ]);
    }
    public function login(){
        if(Auth::check()){
            return \redirect('/dashboard');
        }
        return view('dashboard.login');
    }
    public function postLogin(Request $request){
        $uyari="";
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email',$request->email)->first();
        if ($user){
            if ($user->role==1 || $user->role==2){
                $credentials = $request->only('email', 'password');
                if(Auth::attempt($credentials)){
                    $uyari=["Başarıyla giriş yapıldı."];
                    return response()->json([
                        'message'    => $uyari,
                        'status'=>'success'
                    ], 201);
                }else{
                    $uyari= ["Bu kimlik bilgileri kayıtlarımızla eşleşmiyor."];
                }
            }else{
                $uyari= ["Bu kimlik bilgileri kayıtlarımızla eşleşmiyor."];
            }
        }else{
            $uyari=["Bu kimlik bilgileri kayıtlarımızla eşleşmiyor."];
        }
        return response()->json([
            'message'    => $uyari,
            'status'=>'danger'
        ], 422);
    }
}
