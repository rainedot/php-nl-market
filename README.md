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
$api = new \NeverLose\Market\API('YOUR_API_KEY', 1);
echo $api->getBalance();
```

## Methods

### getBalance(): int

```php
$api = new \NeverLose\Market\API('YOUR_API_KEY', 1);
echo $api->getBalance();
```


### checkIfUserExists(string $username): bool
```php
$api = new \NeverLose\Market\API('YOUR_API_KEY', 1);
var_dump( $api->checkIfUserExists('USERNAME') );
```

### getProductPrices(\Rainedot\PhpNlMarket\Enum\Products $product): array

```php
$api = new \NeverLose\Market\API('YOUR_API_KEY', 1);
print_r( $api->getProductPrices(\Rainedot\PhpNlMarket\Enum\Products::CSGO) );
```

### giftProduct(int $transaction_id, string $username, \Rainedot\PhpNlMarket\Enum\Products $product, Rainedot\PhpNlMarket\Enum\Counts $count): void

```php
$api = new \NeverLose\Market\API('YOUR_API_KEY', 1);
$api->giftProduct(1, \Rainedot\PhpNlMarket\Enum\Products::CSGO, \Rainedot\PhpNlMarket\Enum\Counts::MONTHLY);
```

### transferBalance(int $transaction_id, string $username, int $amount): void
```php
$api = new \NeverLose\Market\API('YOUR_API_KEY', 1);
$api->transferBalance(1, 'USERNAME', 1);
```

### giveForFree(int $transaction_id, string $username, int $item_code): void

```php
$api = new \NeverLose\Market\API('YOUR_API_KEY', 1);
$api->giveForFree(1, 'USERNAME', 'item_code');
```



