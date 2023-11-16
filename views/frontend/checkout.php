<?php 

if(isset($_REQUEST['now']))
{
    require_once 'views/frontend/checkout-now.php' ;
}
else
{
    require_once 'views/frontend/checkout-cart.php' ;
}