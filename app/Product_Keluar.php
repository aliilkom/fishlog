<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Keluar extends Model
{
    protected $table = 'product_keluar';

    protected $fillable = ['user_id', 'product_id','customer_id','jumlah', 'pembayaran','tanggal'];

    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
