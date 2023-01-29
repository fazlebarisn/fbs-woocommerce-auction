<?php

namespace Fbs\Auction\Admin;

class AdminNotice{
    public function __construct(){

        if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            add_action( 'admin_notices', [ $this, 'woocommercePluginMissing' ] );
        }  
    }

    public function woocommercePluginMissing(){
        $class = 'notice notice-error';
        $message = __( "Fbs WooCommerce Auction Requires WooCommerce to be Activated", "fbs-woocommerce-auction" );
     
        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    }
}
