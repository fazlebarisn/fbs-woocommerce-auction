<?php

/**
 * This function will only register fbs_auction type product
 * all other function is inside include/Admin/RegisterProductType class
 * I will arrange this code later
 *
 * @return void
 */
function fbs_register_auction_product_type() {
  class Fbs_Auction_Product extends WC_Product {
            
    public function __construct( $product ) {
        $this->product_type = 'fbs_auction';
        parent::__construct( $product );
    }
  }
}

add_action( 'init', 'fbs_register_auction_product_type' );
