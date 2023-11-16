<?php

use App\Libraries\MyClass;
use App\Models\Product;

 if(isset($_POST['THEM']))
 {
  if(strlen($_POST['brand_id']) > 0 && strlen($_POST['category_id']) > 0 && strlen($_POST['name']) > 0)
  {
    $product= new Product();
    $product->brand_id=$_POST['brand_id'];
    $product->category_id=$_POST['category_id'];
    $product->name=$_POST['name'];
    $product->price=$_POST['price'];
    $product->pricesale=$_POST['pricesale'];
    $product->qty=$_POST['qty'];
    $product->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['name']);
    if(strlen($_POST['description'])>0):
      $product->description=$_POST['description'];
    endif;
    $product->detail=$_POST['detail'];
    $product->status=$_POST['status'];

    if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/product/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {
         $file_name=$product->slug.'.'.$extension;
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $product->image=$file_name;
      }
    }
    
    $product->created_at=date('Y-m-d H:i:s');
    $product->created_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    $product->save();

    MyClass::set_flash('message',['msg'=>'Thêm thành công','type'=>'success']);
    header("location:index.php?option=product");
  }
  else
  {
    MyClass::set_flash('message',['msg'=>'Chưa nhập đủ thông tin','type'=>'danger']);
    header("location:index.php?option=product&cat=create");
  }
 }

 if(isset($_POST['CAPNHAT']))
 {
  $id=$_POST['id'];
  $product= Product::find($id);
  if($product==NULL)
  {
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);

     header("location:index.php?option=product");
  }
  if(strlen($_POST['brand_id']) > 0 && strlen($_POST['category_id']) > 0 && strlen($_POST['name']) > 0)
  {
    $product->brand_id=$_POST['brand_id'];
    $product->category_id=$_POST['category_id'];
    $product->name=$_POST['name'];
    $product->price=$_POST['price'];
    $product->pricesale=$_POST['pricesale'];
    $product->qty=$_POST['qty'];
    $product->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['name']);
    if(strlen($_POST['description'])>0)
      {
        $product->description=$_POST['description'];
      }
      else
      {
        if(strlen($_POST['description'])==0)
        {
          $product->description=NULL;
        }
      }
    $product->detail=$_POST['detail'];
    $product->status=$_POST['status'];

    if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/product/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {
        if(strlen($product->image)>0)
        {
          unlink("../public/images/product/".$product->image);
        }
         $file_name=$product->slug.'.'.$extension;
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $product->image=$file_name;
      }
    }
    $product->updated_at=date('Y-m-d H:i:s');
    $product->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    $product->save();
    MyClass::set_flash('message',['msg'=>'Cập nhật thành công','type'=>'success']);
    header("location:index.php?option=product");
  }
  else
  {
    MyClass::set_flash('message',['msg'=>'Chưa nhập đủ thông tin','type'=>'danger']);
    header("location:index.php?option=product&cat=edit&id=".$product->id);
  }

 }
?>