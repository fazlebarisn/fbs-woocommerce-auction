<?php

namespace Fbs\Auction\Frontend;

class AuctionProduct{

    function __construct()
    {
        add_action( 'woocommerce_before_add_to_cart_form', [$this, 'auction_product_front'] );
    }

    function auction_product_front () {
        global $product;
        
        if ( 'fbs_auction' == $product->get_type() ) {      
            echo( get_post_meta( $product->get_id(), 'auction_product_info' )[0] );
            // var_dump($product);

        }
    }
    
}