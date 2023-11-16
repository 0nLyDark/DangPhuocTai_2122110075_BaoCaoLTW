<?php
use App\Libraries\Cart;

if(isset($_POST['qty']))
{
    $arr_qty=$_POST['qty'];

    foreach($arr_qty as $id =>$qty)
    {
        Cart::updateCart($id,$qty);
        header('location:index.php?option=cart');
    }
}
else
{
    header('location:index.php?option=cart');
}
?>