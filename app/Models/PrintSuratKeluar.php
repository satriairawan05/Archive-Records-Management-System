<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintSuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'print_surat_keluars';

    protected $primaryKey = 'ps_id';
}
