<?php
namespace App\Http\Controllers;

use App\Models\TrackEvent;
use Illuminate\Http\Request;

class TrackWebhookController extends Controller
{
    public function trackWebhook(Request $request)
    {
        TrackEvent::query()->create([
            'actions' => $request->get('action'),
            'data' => $request->all(),
        ]);
    }
}
