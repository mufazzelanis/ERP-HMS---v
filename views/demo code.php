<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Order Review</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// Sample data
$products = [
    [
        'name' => 'Spirometer',
        'quantity' => 1,
        'subtotal' => '650.00',
    ],
];

$subtotal = '650.00';
$shippingMethods = [
    ['name' => 'Outside Dhaka', 'charge' => '130.00'],
    ['name' => 'Inside Dhaka', 'charge' => '60.00'],
];
$total = '710.00';
?>

<div class="checkout-order-review">
    <h3 id="order_review_heading">Your order</h3>
    <div id="order_review" class="woocommerce-checkout-review-order">
        <div class="wd-table-wrapper">
            <table class="shop_table woocommerce-checkout-review-order-table">
                <thead>
                    <tr>
                        <th class="product-name">Product</th>
                        <th class="product-total">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr class="cart_item">
                            <td class="product-name">
                                <span class="pisol_product_name"><?= $product['name'] ?></span>&nbsp;
                                <strong class="product-quantity">×&nbsp;<?= $product['quantity'] ?></strong>
                            </td>
                            <td class="product-total">
                                <span class="woocommerce-Price-amount amount">
                                    <bdi><?= $product['subtotal'] ?><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="cart-subtotal">
                        <th>Subtotal</th>
                        <td>
                            <span class="woocommerce-Price-amount amount">
                                <bdi><?= $subtotal ?><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi>
                            </span>
                        </td>
                    </tr>
                    <tr class="woocommerce-shipping-totals shipping">
                        <th>Shipping</th>
                        <td data-title="Shipping">
                            <ul id="shipping_method" class="woocommerce-shipping-methods">
                                <?php foreach ($shippingMethods as $method): ?>
                                    <li>
                                        <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_flat_rate<?= $method['charge'] ?>" value="flat_rate:<?= $method['charge'] ?>" class="shipping_method">
                                        <label for="shipping_method_0_flat_rate<?= $method['charge'] ?>">
                                            <?= $method['name'] ?> Delivery Charge: 
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi><?= $method['charge'] ?><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi>
                                            </span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                    <tr class="order-total">
                        <th>Total</th>
                        <td>
                            <strong>
                                <span class="woocommerce-Price-amount amount">
                                    <bdi><?= $total ?><span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi>
                                </span>
                            </strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- Additional content as needed -->
    </div>
</div>

<!-- Include your JavaScript and jQuery here if needed -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="scripts.js"></script>
</body>
</html>
