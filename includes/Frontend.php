<?php

namespace Fbs\Auction;

class Frontend{

    function __construct()
    {
        new Frontend\Enqueue();
        new Frontend\AddToCard();
        new Frontend\AuctionProduct();
    }

}