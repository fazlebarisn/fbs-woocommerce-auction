<?php

namespace Fbs\Auction;

class Frontend{

    function __construct()
    {
        new Frontend\Enqueue();
        new Frontend\Templates();
        new Frontend\AuctionProduct();
    }

}