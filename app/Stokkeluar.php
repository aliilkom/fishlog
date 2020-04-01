<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stokkeluar extends Model
{
    protected $table = 'stokkeluar';

    protected $fillable = ['gudang_id','barang_id','pembeli_id','kuantitas', 'pembayaran', 'tanggal'];

    protected $hidden = ['created_at','updated_at'];

    
    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
    
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }
}