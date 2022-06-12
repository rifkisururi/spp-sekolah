<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppModel extends Model
{
    use HasFactory;
    
    protected $table = 'spp';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kelas','tanggal_pembayaran', 'id_siswa', 'id_periode', 'biaya', 'status'];
    public $timestamps = false;
}
