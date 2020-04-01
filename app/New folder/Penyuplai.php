<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyuplai extends Model
{
    protected $fillable = ['nama','alamat','email','hp', 'image'];

    protected $hidden = ['created_at','updated_at'];
}
