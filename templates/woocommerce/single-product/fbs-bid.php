<?php

global $product;

if(!(method_exists( $product, 'get_type') && $product->get_type() == 'fbsauction')){
	return;
}

// Get product type from database
$product_type = get_post_meta( $product->get_ID(), 'fbs_product_type', true ) ?? '';
$fbs_bid_closing_date = get_post_meta( $product->get_ID(), 'fbs_bid_closing_date', true ) ?? '';

?>

<div class="fbs-bid-area">
    <p><strong>Product Type: </strong> <?php echo esc_html( ucfirst($product_type) ); ?> </p>
    <p><strong>Bid Closing Time: </strong> <?php echo esc_html( $fbs_bid_closing_date ); ?> </p>
</div>