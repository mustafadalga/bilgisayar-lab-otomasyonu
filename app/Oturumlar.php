<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oturumlar extends Model
{
    protected $table='oturumlar';
    public function laboratuvarlar(){
        return $this->belongsTo('App\Laboratuvarlar');
    }

    public function oturumMevcutMu($lab,$gun,$saat){
        $oturum=Oturumlar::where([['lab_id',"=",$lab],['gun', '=', $gun],['saat', '=', $saat]])->get();
        if ($oturum->count()==0){
            return true;
        }else{
            return false;
        }
    }
}
