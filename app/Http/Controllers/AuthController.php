<?php
namespace App\Http\Controllers;

use App\Models\Store;
use PHPShopify\AuthHelper;
use PHPShopify\ShopifySDK;

class AuthController extends Controller
{
    public function auth(): object
    {
        $config = array(
            'ShopUrl' => env('SHOP_DOMAIN'),
            'ApiKey' => env('SHOPIFY_API_KEY'),
            'SharedSecret' => env('SHOPIFY_API_SECRET'),
        );
        ShopifySDK::config($config);

        $scope = ['read_products', 'write_products'];
        $return['url'] = AuthHelper::createAuthRequest($scope, env('REDIRECT_URI'), null, null, true);
        return (object) $return;
    }

    public function callback() {
        $config = array(
            'ShopUrl' => env('SHOP_DOMAIN'),
            'ApiKey' => env('SHOPIFY_API_KEY'),
            'SharedSecret' => env('SHOPIFY_API_SECRET'),
        );
        ShopifySDK::config($config);

        $accessToken = AuthHelper::getAccessToken();

        $config = array(
            'ShopUrl' => env('SHOP_DOMAIN'),
            'AccessToken' => $accessToken,
        );

        $shopify = ShopifySDK::config($config);
        // get shop info
        $shop = $shopify->Shop()->get();
        Store::query()->updateOrCreate(['title' => $shop['name']], ['access_token' => $accessToken]);
        echo 'store done';
    }
}
