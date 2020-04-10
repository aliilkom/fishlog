<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockrentin extends Model
{
    protected $fillable = ['user_id', 'product_id','renter_id','jumlah', 'pembayaran','tanggal', 'keterangan'];

    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function renter()
    {
        return $this->belongsTo('App\Renter');
    }
}
