<?php

namespace App\Models;

use Database\Factories\SystemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
    /** @use HasFactory<SystemFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable
        = [
            'name',
            'worker_id',
        ];

    /**
     * @return BelongsTo<Worker, $this>
     */
    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }
}
