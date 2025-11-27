<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SafetyStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_safety_work_days',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'date',
    ];
}