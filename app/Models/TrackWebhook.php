<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackWebhook extends Model
{
    protected $table = 'track_webhooks';

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];
}
