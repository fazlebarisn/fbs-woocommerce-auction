<?php

namespace Fbs\Auction\Frontend;

class Templates{

    function __construct()
    {
        add_action( 'woocommerce_locate_template', [$this, 'override_single_product_template'], 10, 3 );
        add_filter( 'woocommerce_single_product_summary', [$this, 'auction_area'], 25 );
    }

    /**
     * Here we will override the default single page template
     * All template will be in templates/woocommerce folder
     *
     * @return void
     * @since 1.0.1
     * @author Fazle Bari <fazlebarisn@gmail.com>
     */
    public function override_single_product_template( $template, $template_name, $template_path ){
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

    /**
     * include fbs-bid.php file from templates/woocommerce/single-product folder 
     * this will show 'Product Type', 'Bid Closing Time'
     */
    public function auction_area(){
		global $product;
		
		if( method_exists( $product, 'get_type') && $product->get_type() == 'fbsauction' ){
            wc_get_template( 'single-product/fbs-bid.php' );
        }	
    }
}