<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $fillable = ['nama','alamat','email','hp', 'image'];

    protected $hidden = ['created_at','updated_at'];
}
