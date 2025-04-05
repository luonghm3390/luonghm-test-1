<?php
namespace App\Http\Controllers;

use App\Models\TrackEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrackEventController extends Controller
{
    public function trackEvent(Request $request)
    {
        $data = $request->all();
        unset($data['action']);
        unset($data['shop']);
        unset($data['event-id']);
        TrackEvent::query()->create(array(
            'actions' => $request->get('action'),
            'shop' => $request->get('shop'),
            'event_id' => $request->get('event-id'),
            'data' => $data,
        ));
    }
}
