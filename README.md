# Shopia NowPayments for Filament

A Laravel package for NowPayments API integration with sandbox support.

## Installation

You can install the package via composer:

```bash
composer require shopia/nowpayments
```

## Configuration

### 1. Publish the configuration file and migrations:

```bash
php artisan vendor:publish --provider="Shopia\Nowpayments\NowpaymentsServiceProvider"
```

### 2. Database Configuration

This package uses the `payment_settings` table to store API keys and configuration. Make sure your table has the following columns:

- `sandbox_api_key` (string, nullable)
- `live_api_key` (string, nullable)
- `sandbox_mode` (boolean, default: true)
- `default_currency` (string, default: 'USD')

If you need to create the table, run:

```bash
php artisan migrate
```

### 3. Add Configuration to Database

Insert your API keys into the `payment_settings` table:

```php
use App\Models\PaymentSetting;

PaymentSetting::create([
    'sandbox_api_key' => 'your-sandbox-api-key',
    'live_api_key' => 'your-live-api-key',
    'sandbox_mode' => true,
    'default_currency' => 'USD'
]);
```

## Usage

```php
use Shopia\Nowpayments\Facades\Nowpayments;

// Create an invoice
$invoice = Nowpayments::createInvoice([
    'price_amount' => 100,
    'price_currency' => 'usd',
    'order_id' => 'ORDER-123',
    'order_description' => 'Test payment',
    'success_url' => 'https://your-site.com/success',
    'cancel_url' => 'https://your-site.com/cancel',
]);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
