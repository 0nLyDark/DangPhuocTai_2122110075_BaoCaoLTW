<?php
use App\Models\Product;
use App\Libraries\Cart;

if(isset($_REQUEST['addcart']))
{
   $id = $_GET['id'];
   $qty = $_GET['qty'];
   $product = Product::find($id);
   
   $cart_item=[
      'id' =>$id,
      'name' =>$product->name,
      'price' =>$product->price,
      'qty' =>$qty,
      'image' =>$product->image
   ];
   Cart::addCart($cart_item);
   echo count($_SESSION['cart']);
}