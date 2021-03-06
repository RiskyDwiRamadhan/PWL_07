<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa_MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    protected $fillable = [
        'mahasiswa_id',
        'kelas_id',
        'nilai'
    ];
}
