<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id', 'warehouse_id','category_id','merk_id','nama','sku','jumlah', 'jumlahsrent', 'tagihan', 'satuan', 'spesifikasi','image'];

    protected $hidden = ['created_at','updated_at'];

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function merk()
    {
        return $this->belongsTo('App\Merk');
    }
    
}
