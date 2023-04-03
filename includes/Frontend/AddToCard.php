<?php

namespace Fbs\Auction\Frontend;

class AddToCard{

    public $product_id;

    function __construct()
    {
        //add_action( 'woocommerce_single_product_summary', [$this, 'display_product_type'] );
    }

    public function display_product_type(){

        $this->product_id = get_the_ID();

        // get current product
        $product = wc_get_product( $this->product_id );

        // get product type
        $product_type = $product->get_type();

        //if( 'fbsauction' !== $product_type ) return;

        $priduct_type = get_post_meta( $this->product_id, 'fbs_product_type', true ) ?? '';

        dd($priduct_type);
    }
}