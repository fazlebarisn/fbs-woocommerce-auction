<?php

defined( 'ABSPATH' ) || exit;

global $product;

if( method_exists( $product, 'get_type') && !$product->get_type() == 'fbsauction'  ){
	return;
}

if ( ! $product->is_purchasable() || !$product->is_sold_individually() ) {
	// return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);
		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>
		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

		<button type="submit" class="single_add_to_cart_button button alt">
		<?php echo apply_filters('single_add_to_cart_text',sprintf(__( 'Buy Now %s', 'ultimate-woocommerce-auction' ),wc_price($product->get_regular_price())), $product); ?></button>
		
		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
        <!-- <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" /> -->

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
