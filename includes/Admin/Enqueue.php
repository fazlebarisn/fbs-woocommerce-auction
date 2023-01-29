<?php

namespace Fbs\Auction\Admin;

class Enqueue{

    function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue'] );
    }

	function enqueue(){
		wp_enqueue_style('fbs-auction-admin-style', FBS_AUCTION_URL . '/assets/css/admin-fbs-auction.css', [], '1.1', 'all');
		wp_enqueue_script('fbs-auction-admin-script', FBS_AUCTION_URL . '/assets/js/admin-fbs-auction.js' , [ 'jquery' ], time(), true );
    }
    
}