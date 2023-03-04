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

// // Make your custom product type stay selected in the product data drop-down menu
// add_filter( 'woocommerce_product_data_tabs', 'select_custom_product_type' );
// function select_custom_product_type( $tabs ) {
//   // dd($tabs);
//     global $post, $product_object;
//     if ( $product_object instanceof Fbs_Auction_Product ) {

//         $tabs['fbs_auction']['class'][] = 'active';
//         dd($product_object);
//     }
//     return $tabs;
// }

// add_filter( 'default_product_tabs', 'select_custom_product_type' );
// function select_custom_product_type( $tabs ) {
//     global $post, $product_object;
//     if ( $product_object instanceof Fbs_Auction_Product ) {
//         $tabs['fbs_auction'] = 1;
//     }
//     return $tabs;
// }

