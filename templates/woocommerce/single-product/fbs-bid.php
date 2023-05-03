<?php

global $product;

if(!(method_exists( $product, 'get_type') && $product->get_type() == 'fbsauction')){
	return;
}

$product_type = 'New';
?>

<div class="fbs-bid-area">
    <p><strong>Product Type:</strong> <?php echo esc_html($product_type); ?> </p>
</div>