<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalTemp extends Model
{
    use HasFactory;

    protected $table = 'approval_temps';

    protected $primaryKey = 'app_temp_id';
}
