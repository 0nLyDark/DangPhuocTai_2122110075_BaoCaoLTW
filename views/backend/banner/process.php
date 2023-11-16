<?php

use App\Models\Banner;
use App\Libraries\MyClass;

 if(isset($_POST['THEM']))
 {
   if(strlen($_POST['name']) == 0)
   {
      MyClass::set_flash('message',['msg'=>'Chưa nhập đủ thông tin','type'=>'danger']);
      header("location:index.php?option=banner&cat=create");
   }
    $banner= new Banner();
    $banner->name=$_POST['name'];
    $banner->link=$_POST['link'];
    $banner->position=$_POST['position'];
    $banner->sort_order=$_POST['sort_order'];

    $banner->status=$_POST['status'];

    if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/banner/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {

         $file_name=$banner->name.$banner->id;
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $banner->image=$file_name;
      }
    } 
    $banner->created_at=date('Y-m-d H:i:s');
    $banner->created_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    $banner->save();
    MyClass::set_flash('message',['msg'=>'Thêm thành công','type'=>'success']);
    header("location:index.php?option=banner");
 }

 if(isset($_POST['CAPNHAT']))
 {
   $id=$_POST['id'];
   $banner= Banner::find($id);
   if($banner==NULL)
   {
      MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
      header("location:index.php?option=banner");
   }
   $banner->name=$_POST['name'];
    $banner->link=$_POST['link'];
    $banner->position=$_POST['position'];
    $banner->sort_order=$_POST['sort_order'];

    $banner->status=$_POST['status'];

    if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/banner/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {
         if(strlen($banner->image)>0)
         {
            unlink("../public/images/banner/".$banner->image);
         }
         $file_name=basename($_FILES["image"]["name"]);
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $banner->image=$file_name;
      }
    } 
    
   $banner->updated_at=date('Y-m-d H:i:s');
   $banner->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

   $banner->save();
   MyClass::set_flash('message',['msg'=>'Cập nhật thành công','type'=>'success']);
   header("location:index.php?option=banner");
 }
?>