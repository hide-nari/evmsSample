<?php

namespace App\Models;

use Database\Factories\WorkerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    /** @use HasFactory<WorkerFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable
        = [
            'name',
        ];
}
