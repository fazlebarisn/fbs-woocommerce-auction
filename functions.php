<?php

/**
 * This is only for developer
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */
if( !function_exists('dd')){
  function dd( $val ){
    echo '<pre>';
      var_dump( $val );
    echo '</pre>';
  }
}

/**
 * This function will only register fbs_auction type product
 * all other function is inside include/Admin/RegisterProductType class
 * I will arrange this code later
 *
 * @return void
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */
function fbs_register_auction_product_type() {
  class WC_Product_Fbsauction extends WC_Product {
            
    public function __construct( $product ) {
        $this->product_type = 'fbsauction';
        parent::__construct( $product );
    }
  }
}

add_action( 'init', 'fbs_register_auction_product_type' );

/**
 * Here we will override the default single page template
 * All template will be in templates/woocommerce folder
 *
 * @return void timezone
 * @since 1.0.1
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */
function get_fbs_wp_timezone() {	
	$fbs_time_zone = wp_timezone();
	return $fbs_time_zone;
} 

/**
 * Here we will override the default single page template
 * All template will be in templates/woocommerce folder
 *
 * @return void
 * @since 1.0.1
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */
function fbs_override_single_product_template( $template, $template_name, $template_path ){

  global $woocommerce;

  if (!$template_path) {				
    $template_path = $woocommerce->template_url;
  }
  $plugin_path = FBS_AUCTION_TEMPLATE.'woocommerce/';

  $template_locate = locate_template( array( $template_path . $template_name, $template_name ) );

  if (!$template_locate && file_exists($plugin_path . $template_name)) {
    return $plugin_path . $template_name;
  } else { 				
    return $template;
  }

}
add_filter( 'woocommerce_locate_template', 'fbs_override_single_product_template', 10, 3 );

