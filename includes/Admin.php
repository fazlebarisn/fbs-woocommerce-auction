<?php

namespace Fbs\Auction;

class Admin{

    function __construct()
    {
        new Admin\Enqueue();
        new Admin\AdminNotice();
        new Admin\RegisterProductType();
    }
    
}
