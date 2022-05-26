<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;
    
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kelas','nama', 'nis', 'jenis_kelamin','alamat','no_hp'];
    public $timestamps = false;
}
