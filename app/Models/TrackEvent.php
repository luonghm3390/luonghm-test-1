<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackEvent extends Model
{
    protected $table = 'track_events';

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];
}
