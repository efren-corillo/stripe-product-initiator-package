<?php
require('../vendor/autoload.php');

use Doublybear\StripeProductInitiatorPackage\InitiateProducts;

$products = new InitiateProducts();
$json_data = file_get_contents('src/business-plan.json');

$keys = $products->createProduct(
    'sk_test_51MwMM4FCyzb6jRYBLoJ2XOlS7x2CydZfyBEnqNb3Bi4pDXOP9qxsjhkQCoII5NDJAv6Pph9aH8ZiO781nPZPjKYS00LlX4xRI3',
    json_decode($json_data, true)
);

echo   implode(',', $keys);