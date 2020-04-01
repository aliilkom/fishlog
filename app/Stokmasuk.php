<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stokmasuk extends Model
{
    protected $table = 'stokmasuk';

    protected $fillable = ['gudang_id','barang_id','penyuplai_id','kuantitas', 'pembayaran', 'tanggal'];

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
        return $this->belongsTo(Penyuplai::class);
    }
}
