<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Egitmenler extends Model
{
    protected $table="egitmenler";
    public function user(){
        return $this->hasMany('App\User','id');
    }

    public function kullaniciYetkiKontrol($user_id){
        if (Auth::user()->role==3){
            if (Auth::id()==$user_id){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
}
    public function kullaniciSil($id){
        $user = User::find($id);
        $user->delete();
    }
    public function emailDegistir($id,$email){
        $user = User::find($id);
        $user->email=$email;
        $user->save();
    }
    public function nameDegistir($id,$name){
        $user = User::find($id);
        $user->name=$name;
        $user->save();
    }
    public function resimSil($profil_resim){
        if (File::exists(public_path('images/egitmenler/'.$profil_resim))){
            File::delete(public_path('images/egitmenler/'.$profil_resim));
        }
    }

    public function resimYukle($file){
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
         $file->move(public_path('/images/egitmenler'), $filenameToStore);

        return $filenameToStore;
    }
    public function slugOlustur($title){
        $slug = Str::slug($title);
        $newslug=$slug;
        $slugs=$this->slugGetir($slug);
        $durum=true;
        $index=1;
        while ($durum){
            if ($slugs->contains('slug',$newslug)){
                $newslug = $slug . '-' . $index;
                $index++;
            }else{
                $durum=false;
            }
        }
        return $newslug;
    }
    public function slugGetir($slug){
        return Egitmenler::select('slug')->where('slug', 'like',$slug.'%')->get();
    }
}
