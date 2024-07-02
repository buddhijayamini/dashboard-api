<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $table = 'dashboard';

    protected $fillable = [
        'timestamp',
        'temperature',
        'left_off_length',
        'right_off_length',
        'width',
        'tr_no',
        'started_no',
        'end_time',
        'operation_time',
        'current_status',
        'pt_vs_art'
    ];
}
