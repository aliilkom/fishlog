<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['warehouse_id','category_id','merk_id','nama','sku','jumlah', 'jumlahsrent', 'tagihan', 'satuan', 'spesifikasi','image'];

    protected $hidden = ['created_at','updated_at'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class);
    }
    
}
