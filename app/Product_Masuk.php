<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Masuk extends Model
{
    protected $table = 'product_masuk';

    protected $fillable = ['user_id', 'product_id','supplier_id','jumlah', 'pembayaran','tanggal'];

    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
