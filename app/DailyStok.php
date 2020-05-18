<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyStok extends Model
{
    protected $fillable = ['user_id', 'product_id','tanggal','dstok'];

    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
