<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['users_id','nama','pemilik','hp','lokasi', 'ruang', 'kapasitas', 'image'];

    protected $hidden = ['created_at','updated_at'];

    
}
