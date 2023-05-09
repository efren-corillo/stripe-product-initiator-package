<?php

namespace Doublybear\StripeProductInitiatorPackage;

use AllowDynamicProperties;
use Stripe;
use Stripe\Exception\ApiErrorException;

#[AllowDynamicProperties] class InitiateProducts
{
    protected Stripe\StripeClient $stripe;

    /**
     * this will check if what plan to create
     * @param string $key Stripe Secret Key
     * @param array $products
     * @return array An array of product keys.
     * @throws ApiErrorException
     */
    public function createProduct(string $key, array $products)
    {
        var_dump($key, $products);

        $this->stripe = new Stripe\StripeClient($key);

        $productIds = [];

        foreach ($products as $key => $product) {
            // Create a Product
            $productIds[$key] = $prodRes = $this->stripe->products->create($product['product']);

            // using the product id create a price for the product.
            foreach ($product['prices'] as $price) {
                // add product id.
                array_unshift($price, ["product" => $prodRes->id]);
                // check if the price is set to default.
                if (in_array("default_price", $price)) {
                    // pop the default_price
                    array_pop($price);

                    // create price
                    $priceRes = $this->stripe->prices->create($price);
                    // using price_id update the product for the default price.
                    $this->stripe->products->update(
                        $prodRes->id,
                        ['default_price' => $priceRes->id]
                    );

                } else {
                    // just create price.
                    $priceRes = $this->stripe->prices->create($price);
                }

                $productIds[$key]["price"] = $priceRes;
            }
        }

        return $productIds;
    }
}