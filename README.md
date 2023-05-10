# stripe-product-initiator-package
## To Install use
```composer require doublybear/stripe-product-initiator-package```
## Usage, params and usage
```
<?php
require('../vendor/autoload.php');

use Doublybear\StripeProductInitiatorPackage\InitiateProducts;

$products = new InitiateProducts();
$json_data = file_get_contents('src/business-plan.json');

$keys = $products->createProduct(
    '<stripe secret key>',
    json_decode($json_data, true)
);

echo   implode(',', $keys);
```

## Json format example
### with Tiers example
```
[
  {
    "product" : {
      "name" : "Test Business Unlimited Plan",
      "metadata" : {
        "plan_name": "business"
      }
    },
    "prices": [
      {
        "currency": "USD",
        "billing_scheme": "tiered",
        "tiers_mode": "graduated",
        "recurring": {
          "interval": "year",
          "interval_count": 1
        },
        "tiers":[
          {
            "up_to": 5,
            "flat_amount_decimal": 948.00
          },
          {
            "up_to": "inf",
            "unit_amount_decimal": 228.00
          }
        ],
        "default_price": true
      },
      {
        "currency": "USD",
        "billing_scheme": "tiered",
        "tiers_mode": "graduated",
        "recurring": {
          "interval": "year",
          "interval_count": 1
        },
        "tiers":[
          {
            "up_to": 5,
            "flat_amount_decimal": 708.00
          },
          {
            "up_to": "inf",
            "unit_amount_decimal": 168.00
          }
        ]
      },
      {
        "currency": "USD",
        "billing_scheme": "tiered",
        "tiers_mode": "graduated",
        "recurring": {
          "interval": "month",
          "interval_count": 1
        },
        "tiers":[
          {
            "up_to": 5,
            "flat_amount_decimal": 99.00
          },{
            "up_to": "inf",
            "unit_amount_decimal": 29.00
          }
        ]
      }
    ]
  }
]
```
### with-out Tiers example
```
[
  {
    "product": {
      "name": "Test Starter Plan",
      "metadata": {
        "plan_name": "starter"
      }
    },
    "prices": [
      {
        "currency": "USD",
        "billing_scheme": "per_unit",
        "unit_amount": 16800,
        "recurring": {
          "interval": "year",
          "interval_count": 1
        },
        "default_price": true
      },
      {
        "currency": "USD",
        "billing_scheme": "per_unit",
        "unit_amount": 11700,
        "recurring": {
          "interval": "year",
          "interval_count": 1
        }
      },
      {
        "currency": "USD",
        "billing_scheme": "per_unit",
        "unit_amount": 0,
        "recurring": {
          "interval": "year",
          "interval_count": 1
        }
      },
      {
        "currency": "USD",
        "billing_scheme": "per_unit",
        "unit_amount": 2900,
        "recurring": {
          "interval": "month",
          "interval_count": 1
        }
      },
      {
        "currency": "USD",
        "unit_amount": 6700
      }
    ]
  }
]
```
