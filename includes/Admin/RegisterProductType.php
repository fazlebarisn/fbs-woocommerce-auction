<?php

namespace Fbs\Auction\Admin;

class RegisterProductType{

    function __construct()
    {
        add_action('product_type_selector', [$this, 'add_auction_product_type'] );
    }

    /**
     * Product type registered in functions.php file
     *
     * @param [type] $types
     * @return type array
     */
    public function add_auction_product_type( $types ){
        $types[ 'fbs_auction' ] = __( 'Auction Product', 'fbs-woocommerce-auction' );
    
        return $types;    
    }

}
