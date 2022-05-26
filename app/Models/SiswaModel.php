<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;
    
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kelas','nama'];
    public $timestamps = false;
}
