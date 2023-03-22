<?php

namespace Fbs\Auction\Admin;

class RegisterProductType{

    function __construct()
    {
        add_action('product_type_selector', [$this, 'add_auction_product_type'] );
        add_action('woocommerce_product_data_tabs', [$this, 'auction_product_tab'] );
        add_action('woocommerce_product_data_panels', [$this, 'auction_product_tab_content'] );
    }

    /**
     * Product type registered in functions.php file
     * This will display 'Auction Product' type in Product data dropdown menu
     * 
     * @param [type] $types
     * @return type array
     * @author Fazle Bari <fazlebarisn@gmail.com>
     * @since 1.0.0
     */
    public function add_auction_product_type( $types ){
        $types[ 'fbsauction' ] = __( 'Auction Product', 'fbs-woocommerce-auction' );
    
        return $types;    
    }

    /**
     * This will add 'Auction Product' Tab 
     *
     * @param [type] $tabs
     * @return $tabs array
     * @author Fazle Bari <fazlebarisn@gmail.com>
     * @since 1.0.0
     */
    public function auction_product_tab( $product_data_tab ) {
            
        $apt_tabs['fbs_auction'] = array(
            'label'     => __( 'Auction Product', 'fbs-woocommerce-auction' ),
            'target'    => 'fbs_ap_options',
            'class'     => ['show_if_fbs_auction','hide_if_grouped', 'hide_if_external','hide_if_variable','hide_if_simple'],
        );

        $position = 1; // Change this for desire position 
        $tabs = array_slice( $product_data_tab, 0, $position, true ); // First part of original tabs 
        $tabs = array_merge( $tabs, $apt_tabs ); // Add new 
        $tabs = array_merge( $tabs, array_slice( $product_data_tab, $position, null, true ) ); // Glue the second part of original 
        return $tabs;
    }

    /**
     * This is panel section
     *  fields added in includes/Admin/AddFields.php
     * @return $tabs array
     * @author Fazle Bari <fazlebarisn@gmail.com>
     * @since 1.0.0
     */
    public function auction_product_tab_content() {
    ?>
        <div id='fbs_ap_options' class='panel woocommerce_options_panel'>
            <div class='options_group'>
                <?php do_action( 'fbs_ap_add_fields' ); ?>
            </div>
        </div>
    <?php
    }

}
