<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    
    protected $fillable = ['user_id','nama','pemilik','hp','lokasi', 'ruang', 'kapasitas', 'image'];

    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

