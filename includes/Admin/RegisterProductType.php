<?php

namespace Fbs\Auction\Admin;

class RegisterProductType{

    function __construct()
    {
        add_action('product_type_selector', [$this, 'add_auction_product_type'] );
        add_action('woocommerce_product_data_tabs', [$this, 'auction_product_tab'] );
        add_action('woocommerce_product_data_panels', [$this, 'auction_product_tab_content'] );
        add_action('woocommerce_process_product_meta', [$this, 'save_auction_product_settings'] );
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
    public function auction_product_tab( $product_data_tab ) {
            
        $apt_tabs['fbs_auction'] = array(
            'label'     => __( 'Auction Product', 'fbs-woocommerce-auction' ),
            'target' => 'fbs_auction_product_options',
            'class'  => ['show_if_fbs_auction','hide_if_grouped', 'hide_if_external','hide_if_variable','hide_if_simple'],
        );

        $position = 1; // Change this for desire position 
        $tabs = array_slice( $product_data_tab, 0, $position, true ); // First part of original tabs 
        $tabs = array_merge( $tabs, $apt_tabs ); // Add new 
        $tabs = array_merge( $tabs, array_slice( $product_data_tab, $position, null, true ) ); // Glue the second part of original 
        return $tabs;
    }


    public function auction_product_tab_content() {

    ?>
        <div id='fbs_auction_product_options' class='panel woocommerce_options_panel'>
            <div class='options_group'><?php
                            
                woocommerce_wp_text_input(
                    array(
                        'id' => 'auction_product_info',
                        'label' => __( 'Auction Product Spec', 'fbs-woocommerce-auction' ),
                        'placeholder' => '',
                        'desc_tip' => 'true',
                        'description' => __( 'Enter Auction product Info.', 'fbs-woocommerce-auction' ),
                        'type' => 'text'
                    )
                );

                ?>
            </div>
        </div>
    <?php
    }

    
    public function save_auction_product_settings( $post_id ){
            
        $auction_product_info = $_POST['auction_product_info'];
            
        if( !empty( $auction_product_info ) ) {

        update_post_meta( $post_id, 'auction_product_info', esc_attr( $auction_product_info ) );
        }
    }
    

}
