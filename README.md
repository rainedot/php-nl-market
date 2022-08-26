# NeverLose Market API wrapper

Comfortable NeverLose API wrapper for PHP. 

## Requirements

- PHP 8.1 and later

## Composer

```bash
composer require stripe/stripe-php
```

## Dependencies

- [`curl`](https://secure.php.net/manual/en/book.curl.php)

## Getting started

```php
require('vendor/autoload.php');
$api = new \Rainedot\PhpNlMarket\MarketAPI('YOUR_API_KEY', 1);
echo $api->getBalance();
```

## ENUMS

### Product

```php
use \Rainedot\PhpNlMarket\Enums\Product;
echo Product::CSGO;     // "csgo"
echo Product::TF2;      // "tf2"
echo Product::DOTA2;    // "dota2"
```

### Count
    
```php
use \Rainedot\PhpNlMarket\Enums\Count;
echo Count::MONTHLY;        // 0
echo Count::QUARTERLY;      // 1
echo Count::HALF_YEARLY;    // 2
echo Count::YEARLY;         // 3
```

## Methods

### getBalance(): int

```php
$api = new \NeverLose\Market\API('YOUR_API_KEY', 1);
echo $api->getBalance();
```


### checkIfUserExists(string $username): bool
```php
$api = new \Rainedot\PhpNlMarket\MarketAPI('YOUR_API_KEY', 1);
var_dump( $api->checkIfUserExists('USERNAME') );
```

### getProductPrices(\Rainedot\PhpNlMarket\Enum\Products $product): array

```php
$api = new \Rainedot\PhpNlMarket\MarketAPI('YOUR_API_KEY', 1);
print_r( $api->getProductPrices(\Rainedot\PhpNlMarket\Enums\Product::CSGO) );
```

### giftProduct(int $transaction_id, string $username, \Rainedot\PhpNlMarket\Enum\Products $product, Rainedot\PhpNlMarket\Enum\Counts $count): void

```php
$api = new \Rainedot\PhpNlMarket\MarketAPI('YOUR_API_KEY', 1);
$api->giftProduct(1, \Rainedot\PhpNlMarket\Enums\Product::CSGO, \Rainedot\PhpNlMarket\Enums\Count::MONTHLY);
```

### transferBalance(int $transaction_id, string $username, int $amount): void
```php
$api = new \Rainedot\PhpNlMarket\MarketAPI('YOUR_API_KEY', 1);
$api->transferBalance(1, 'USERNAME', 1);
```

### giveForFree(int $transaction_id, string $username, int $item_code): void

```php
$api = new \Rainedot\PhpNlMarket\MarketAPI('YOUR_API_KEY', 1);
$api->giveForFree(1, 'USERNAME', 'item_code');
```

## Callback

### Callback validation
    
```php
$api = new \Rainedot\PhpNlMarket\MarketAPI('YOUR_API_KEY', 1);
$api->validateRequest(array $request); // Returns true if request is valid
```



