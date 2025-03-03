<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang',);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user',)->withDefault([
            'name' => 'User tidak diketahui'
        ]);
    }
}
