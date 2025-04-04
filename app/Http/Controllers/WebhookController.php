<?php
namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPShopify\ShopifySDK;

class WebhookController extends Controller
{
    public function subscription()
    {
        $store = Store::query()->find(1);
        $config = array(
            'ShopUrl' => env('SHOP_DOMAIN'),
            'AccessToken' => $store['access_token'],
        );

        $shopify = ShopifySDK::config($config);
        $webhook = $shopify->Webhook()->post([
            'address' => env('WEBHOOK_CALLBACK_URL'),
            'topic' => 'carts/update',
            'format' => 'json',
        ]);

        dd($webhook);
//        $shopify->Webhook(1358835712140)->delete();
//        $webhooks = $shopify->Webhook()->get();
//        dd($webhooks);
//        echo "delete";
    }

    public function webhook(Request $request)
    {
        Log::info('Webhook received:', $request->all());
    }
}
