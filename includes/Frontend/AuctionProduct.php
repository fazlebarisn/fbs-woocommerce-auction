<?php

namespace Fbs\Auction\Frontend;

class AuctionProduct{

    public $product_id;

    function __construct()
    {
        $product_id = get_the_ID();
        //add_filter( 'woocommerce_get_price_html', [$this, 'display_price'] );
    }

    function display_price ( $price ) {
        //wc_price();
        //dd($id);
        //return $price;
        

    }
    
}