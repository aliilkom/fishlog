<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_RKeluar extends Model
{
    protected $table = 'product_rkeluar';

    protected $fillable = ['user_id', 'product_id','renter_id','jumlah', 'pembayaran','tanggal'];

    protected $hidden = ['created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }
}
