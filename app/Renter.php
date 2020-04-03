<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $fillable = ['user_id', 'nama', 'alamat', 'email', 'telepon', 'image'];

    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
