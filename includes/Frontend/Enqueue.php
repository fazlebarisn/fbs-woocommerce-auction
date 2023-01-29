<?php

namespace Fbs\Auction\Frontend;

class Enqueue{

    function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue'] );
    }

	function enqueue(){
		wp_enqueue_style('fbs-auction-style', FBS_AUCTION_URL . '/assets/css/fbs-auction.css', [], '1.1', 'all');
		wp_enqueue_script('fbs-auction-script', FBS_AUCTION_URL . '/assets/js/fbs-auction.js' , [ 'jquery' ], time(), true );
    }
    
}