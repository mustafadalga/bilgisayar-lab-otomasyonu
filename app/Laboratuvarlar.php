<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Laboratuvarlar extends Model
{
    protected $table='laboratuvarlar';
    public function oturumlar(){
        return $this->hasMany('App\Oturumlar','lab_id');
    }

    public function delete()
    {
        $this->oturumlar()->delete();
        return parent::delete();
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
        return Laboratuvarlar::select('slug')->where('slug', 'like',$slug.'%')->get();
    }
}
