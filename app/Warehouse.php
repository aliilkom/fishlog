<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['user_id','nama','pemilik','hp','lokasi', 'ruang', 'kapasitas', 'bysewa', 'bybongkar', 'bymuat', 'image'];

    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
