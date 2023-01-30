<?php

namespace Fbs\Auction\Admin;

class RegisterProductType{

    function __construct()
    {
        add_action('product_type_selector', [$this, 'add_auction_product_type'] );
        add_action('woocommerce_product_data_tabs', [$this, 'auction_product_tab'] );
    }

    /**
     * Product type registered in functions.php file
     * This will display 'Auction Product' type in Product data dropdown menu
     * 
     * @param [type] $types
     * @return type array
     */
    public function add_auction_product_type( $types ){
        $types[ 'fbs_auction' ] = __( 'Auction Product', 'fbs-woocommerce-auction' );
    
        return $types;    
    }

    /**
     * This will add 'Auction Product' Tab 
     *
     * @param [type] $tabs
     * @return $tabs array
     */
    public function auction_product_tab( $tabs) {
            
        $tabs['fbs_auction'] = array(
        'label'     => __( 'Auction Product', 'fbs-woocommerce-auction' ),
        'target' => 'fbs_auction_product_options',
        'class'  => 'show_if_fbs_auction_product',
        );
        return $tabs;
    }

}
