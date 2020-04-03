<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockrentin extends Model
{
    protected $fillable = ['product_id','renter_id','jumlahsrent', 'pembayaran','tanggal'];

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
