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

    public function activeWebPixel(): void
    {
        $graphQLBody = [
            'query' => 'mutation {
              webPixelCreate(webPixel: { settings: "{\"accountID\":\"123\"}" }) {
                userErrors {
                  code
                  field
                  message
                }
                webPixel {
                  settings
                  id
                }
              }
            }',
        ];

        $store = Store::query()->find(1);
        $domain = env('SHOP_DOMAIN');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('post', "$domain/admin/api/2025-07/graphql.json", [
            'headers' => [
                'X-Shopify-Access-Token' => $store['access_token'],
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($graphQLBody)
        ]);

        dd($response->getBody()->getContents());
    }
}
