<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['gudang_id','kategori_id','merek_id','nama','sku', 'satuan',  
    'spesifikasi', 'image'];

    protected $hidden = ['created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function merek()
    {
        return $this->belongsTo(Merek::class);
    }
}
