<?php

namespace Fbs\Auction\Frontend;

class AuctionProduct{

    public $product_id;

    function __construct()
    {
        add_filter( 'woocommerce_get_price_html', [$this, 'display_price'] );
    }

    function display_price ( $price ) {
        // Get the product id
        $this->product_id = get_the_ID();
        // get current product
        $product = wc_get_product( $this->product_id );
        // get product type
        $product_type = $product->get_type();
        // set opening price for auction product
        if( 'fbsauction' == $product_type ){
            // get price from database
            $opening_price = get_post_meta( $this->product_id, 'fbs_opening_price', true );
            $price = 'Opening Price ' . wc_price( $opening_price );
        }  
        return $price;
    }
    
}