<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{

    protected $fillable = ['user_id', 'product1_id','product2_id', 'jumlah','tanggal', 'manajemen'];

    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function product1()
    {
        return $this->belongsTo('App\Product');
    }
    public function product2()
    {
        return $this->belongsTo('App\Product');
    }
}
