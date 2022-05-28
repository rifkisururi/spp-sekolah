<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeModel extends Model
{
    use HasFactory;
    
    protected $table = 'periode';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','tanggal_jatuh_tempo'];
    public $timestamps = false;
}
