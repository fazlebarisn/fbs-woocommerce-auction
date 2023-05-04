<?php

namespace Fbs\Auction\Frontend;

class AuctionProduct{

    public $product_id;

    function __construct()
    {
        add_filter( 'woocommerce_get_price_html', [$this, 'display_price'] );
    }

    function display_price ( $price ) {
        global $product;

        // Get the product id
        $this->product_id = get_the_ID();

        // set opening price for auction product
        if( method_exists( $product, 'get_type') && $product->get_type() == 'fbsauction'  ){
            // get price from database
            $opening_price = get_post_meta( $this->product_id, 'fbs_opening_price', true ) ?? '';
            $price = __('<span class="fbs-opening-price">Bid Stating:</span> ' , 'fbs-woocommerce-auction' ) . wc_price( $opening_price );
        }  
        return $price;
    }

}