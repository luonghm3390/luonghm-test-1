<?php
namespace App\Http\Controllers;

use App\Models\TrackEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrackEventController extends Controller
{
    public function trackEvent(Request $request)
    {
        TrackEvent::query()->create([
            'actions' => $request->get('action'),
            'data' => $request->all(),
        ]);
        Log::info('Event received:', $request->all());
    }
}
