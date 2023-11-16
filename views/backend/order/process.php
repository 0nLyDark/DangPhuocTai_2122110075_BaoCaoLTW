<?php

use App\Models\Order;
use App\Libraries\MyClass;

 if(isset($_POST['THEM']))
 {
    $order= new Order();
    $order->user_id=$_POST['user_id'];
    if(strlen($_POST['deliveryname'])>0):
      $order->deliveryname=$_POST['deliveryname'];
    endif;
    if(strlen($_POST['deliveryphone'])>0):
      $order->deliveryphone=$_POST['deliveryphone'];
    endif;
    if(strlen($_POST['deliveryemail'])>0):
      $order->deliveryemail=$_POST['deliveryemail'];
    endif;
    if(strlen($_POST['deliveryaddress'])>0):
      $order->deliveryaddress=$_POST['deliveryaddress'];
    endif;
    if(strlen($_POST['note'])>0):
      $order->note=$_POST['note'];
    endif;

    $order->status=$_POST['status'];
    
    $order->created_at=date('Y-m-d H:i:s');

    $order->save();
    MyClass::set_flash('message',['msg'=>'Thêm thành công','type'=>'success']);
    header("location:index.php?option=order");
 }

 if(isset($_POST['CAPNHAT']))
 {
   $id=$_POST['id'];
   $order= Order::find($id);
   if($order==NULL)
   {
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
      header("location:index.php?option=order");
   }
   
   $order->user_id=$_POST['user_id'];
    if(strlen($_POST['deliveryname'])>0):
      $order->deliveryname=$_POST['deliveryname'];
    endif;
    if(strlen($_POST['deliveryphone'])>0):
      $order->deliveryphone=$_POST['deliveryphone'];
    endif;
    if(strlen($_POST['deliveryemail'])>0):
      $order->deliveryemail=$_POST['deliveryemail'];
    endif;
    if(strlen($_POST['deliveryaddress'])>0):
      $order->deliveryaddress=$_POST['deliveryaddress'];
    endif;
    if(strlen($_POST['note'])>0):
      $order->note=$_POST['note'];
    endif;

    $order->status=$_POST['status'];
    
   $order->updated_at=date('Y-m-d H:i:s');
   $order->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

   $order->save();
   MyClass::set_flash('message',['msg'=>'Cập nhật thành công','type'=>'success']);
   header("location:index.php?option=order");
 }
?>