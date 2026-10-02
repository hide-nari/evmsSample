<?php

namespace App\Models;

use Database\Factories\TrackFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model
{
    /** @use HasFactory<TrackFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable
        = [
            'project_id',
            'worker_id',
            'workTime',
            'workDay',
        ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

    protected function casts(): array
    {
        return [
            'workDay' => 'date',
        ];
    }
}
