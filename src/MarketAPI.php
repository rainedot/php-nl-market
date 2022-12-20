<?php

namespace Rainedot\PhpNlMarket;

use Rainedot\PhpNlMarket\Enums\Count;
use Rainedot\PhpNlMarket\Enums\Product;

class MarketAPI
{

    const BASE_URL = 'https://neverlose.cc/api/market/';

    private string $market_secret;
    private int $user_id;

    public function __construct(string $market_secret, int $user_id, $options = [])
    {
        $this->market_secret = $market_secret;
        $this->user_id = $user_id;
    }

    protected function arrayToString(array $array): string
    {
        $string = '';
        foreach ($array as $key => $value) {
            $string .= $key . $value;
        }
        return $string;
    }

    public function makeSignature(array $request): string
    {
        ksort($request);
        $string = $this->arrayToString($request) . $this->market_secret;
        return hash('sha256', $string);
    }

    public function validateRequest(array $request): bool
    {
        $signature = $request[ 'signature' ];
        unset($request[ 'signature' ]);
        return $signature == $this->makeSignature($request);
    }

    /**
     * @throws \Exception
     */
    protected function makeRequest(string $method, array $request): array
    {
        // make curl request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::BASE_URL . $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        //json
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        $request[ 'user_id' ] = $this->user_id;
        $request[ 'signature' ] = $this->makeSignature($request);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request));
        $response = json_decode(curl_exec($curl), true);

        if (!$response['success'] || !$response['succ'])
            throw new \Exception($response['error'] ?? 'unknown error');

        curl_close($curl);
        return $response;
    }

    /**
     * @throws \Exception
     */
    public function getBalance(): int
    {
        return $this->makeRequest('get-balance', [])[ 'balance' ];
    }

    /**
     * @throws \Exception
     */
    public function checkIfUserExists(string $username): bool
    {
        $request = [
            'username' => $username
        ];
        $response = $this->makeRequest('is-user-exists', $request);
        return $response[ 'user_exists' ];
    }

    /**
     * @throws \Exception
     */
    public function getProductPrices(Product $product): array
    {
        $request = [
            'product' => $product->value,
        ];
        return $this->makeRequest('get-prices', $request)[ 'prices' ];
    }

    /**
     * @throws \Exception
     */
    public function giftProduct(int $transaction_id, string $username, Product $product, Count $count): void
    {
        $request = [
            'id' => $transaction_id,
            'product' => $product->value,
            'username' => $username,
            'cnt' => $count->value,
        ];
        $this->makeRequest('gift-product', $request);
    }

    /**
     * @throws \Exception
     */
    public function transferBalance(int $transaction_id, string $username, float $amount): void
    {
        $request = [
            'id' => $transaction_id,
            'username' => $username,
            'amount' => $amount
        ];
        $this->makeRequest('transfer-money', $request);
    }

    /**
     * @throws \Exception
     */
    public function giveForFree(int $transaction_id, string $username, string $item_code): void
    {
        $request = [
            'id' => $transaction_id,
            'username' => $username,
            'code' => $item_code,
        ];
        $this->makeRequest('give-for-free', $request);
    }
}
