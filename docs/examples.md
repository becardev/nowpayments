# NowPayments Package Usage Examples

## Basic Usage

```php
use Shopia\Nowpayments\Nowpayments;

// Initialize the client
$nowpayments = new Nowpayments([
    'api_key' => env('NOWPAYMENTS_API_KEY'),
    'sandbox_mode' => env('NOWPAYMENTS_SANDBOX_MODE', false)
]);

// Get available currencies
$currencies = $nowpayments->getCurrencies();

// Get minimum payment amount
$minAmount = $nowpayments->getMinimumPaymentAmount('usd', 'btc');

// Get estimate for payment
$estimate = $nowpayments->getEstimate(100, 'usd', 'btc');

// Create an invoice
$invoice = $nowpayments->createInvoice([
    'price_amount' => 100,
    'price_currency' => 'usd',
    'order_id' => 'ORDER-123',
    'order_description' => 'Payment for Order #123'
]);

// Create a payment
$payment = $nowpayments->createPayment([
    'price_amount' => 100,
    'price_currency' => 'usd',
    'pay_currency' => 'btc',
    'order_id' => 'ORDER-123',
    'order_description' => 'Payment for Order #123'
]);

// Check payment status
$status = $nowpayments->getPaymentStatus($payment['payment_id']);
```

## Environment Variables

Make sure to set these variables in your `.env` file:

```env
NOWPAYMENTS_API_KEY=your-api-key-here
NOWPAYMENTS_SANDBOX_MODE=true
```

## Error Handling

The package includes built-in error logging. All API errors are logged to your Laravel log file. You can catch exceptions like this:

```php
try {
    $payment = $nowpayments->createPayment([
        'price_amount' => 100,
        'price_currency' => 'usd',
        'pay_currency' => 'btc'
    ]);
} catch (\Exception $e) {
    // Handle the error
    Log::error('Payment creation failed', ['error' => $e->getMessage()]);
}
```
