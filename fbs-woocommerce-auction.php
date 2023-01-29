<?php
/**
* Plugin Name: Fbs WooCommerce Auction
* Plugin URI: https://github.com/fazlebarisn/fbs-woocommerce-auction
* Description: Create an auction type product 
* Version: 1.0.0
* Author: Fazle Bari
* Author URI: https://www.chitabd.com/
* Requires PHP: 7.2
* Tested up to:         6.0.5
* WC requires at least: 3.0.0
* WC tested up to: 	 6.8.2
* Licence: GPL Or leater
* Text Domain: fbs-woocommerce-auction
* Domain Path: /languages/
* @package fbsauction
*/

defined('ABSPATH') or die('Nice Try!');

if( file_exists( dirname(__FILE__) . '/vendor/autoload.php') ){
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}


/**
 * The main class
 */

final class FbsAuction{

    /**
     * defien plugin version
     */
    const version = "1.0.0";

    /**
     * class constructor
     */
    private function __construct()
    {
        $this->defineConstants();

        register_activation_hook( __FILE__ , [ $this , 'activate'] );

        add_action( 'plugins_loaded' , [ $this , 'initPlugin'] );
    }

    /**
     * initilize a singileton 
     *
     * @return \FbsAuction class
     */
     public static function init(){

         static $instance = false;

         if( !$instance ){
             $instance = new self();
         }

         return $instance;
     }

     /**
      * Define plugin constants
      *
      * @return constants
      */
     public function defineConstants(){

         define( 'FBS_AUCTION_VERSION' , self::version );
         define( 'FBS_AUCTION_FILE' , __FILE__ );
         define( 'FBS_AUCTION_PATH' , __DIR__ );
         define( 'FBS_AUCTION_URL' , plugins_url( '' , FBS_AUCTION_FILE ) );
         define( 'FBS_AUCTION_ASSETS' , FBS_AUCTION_URL . '/assets' );
         define( 'FBS_AUCTION_BASENAME' , plugin_basename( __FILE__ ) );

     }

     /**
      * Initialize the plugin
      *
      * @return void
      */
     public function initPlugin(){

        if( is_admin() ){
            new \Fbs\Auction\Admin();
        }else{
            new \Fbs\Auction\Frontend();
        }
        
     }

     /**
      * do stuff when plugin install
      *
      * @return void
      */
     public function activate(){

        // when first install
        $installed = get_option( 'fbs_auction_installed' );
        if( !$installed ){
            update_option( 'fbs_auction_installed' , time() );
        }

        // what is the version number when first install
        update_option( 'fbs_auction_version' , FBS_AUCTION_VERSION ); 

     }

 }

 /**
  * Initializes the main plugin
  *
  * @return \FbsAuction class
  */
 function fbsAuction(){
     return FbsAuction::init();
 }

 // kick-off the plugin
 fbsAuction();

