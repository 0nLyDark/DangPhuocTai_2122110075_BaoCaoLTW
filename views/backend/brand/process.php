<?php

use App\Libraries\MyClass;
use App\Models\Brand;

 if(isset($_POST['THEM']))
 {

    if(strlen($_POST['name']) > 0)
    {
      $brand= new Brand();
      $brand->name=$_POST['name'];
      $brand->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['name']);
      $brand->description=$_POST['description'];
      $brand->status=$_POST['status'];
  
      if(strlen($_FILES['image']['name'])>0)
      {
        $target_dir = "../public/images/brand/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(in_array($extension,['jpg','jpeg','png','gif','webp']))
        {
          
           $file_name=$brand->slug.'.'.$extension;
           move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
           $brand->image=$file_name;
        }
      }
      
      $brand->created_at=date('Y-m-d H:i:s');
      $brand->created_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;
  
      $brand->save();
      MyClass::set_flash('message',['msg'=>'Thêm thành công','type'=>'success']);
      header("location:index.php?option=brand");
    }
    else
    {
      MyClass::set_flash('message',['msg'=>'Chưa nhập đủ thông tin','type'=>'danger']);
      header("location:index.php?option=brand");
    }
    
 }

 if(isset($_POST['CAPNHAT']))
 {
   $id=$_POST['id'];
   $brand= Brand::find($id);
   if($brand==NULL)
   {
      MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
      header("location:index.php?option=brand");
   }
  if(strlen($_POST['name']) > 0)
  {
    $brand->name=$_POST['name'];
    $brand->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['name']);
    if(strlen($_POST['description'])>0)
    {
      $brand->description=$_POST['description'];
    }
    else
    {
      if(strlen($_POST['description'])==0)
      {
        $brand->description=NULL;
      }
    }
    $brand->status=$_POST['status'];

    if(strlen($_FILES['image']['name'])>0)
    {
        $target_dir = "../public/images/brand/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(in_array($extension,['jpg','jpeg','png','gif','webp']))
        {
          if(strlen($brand->image)>0)
          {
            unlink("../public/images/brand/".$brand->image);
          }
          $file_name=$brand->slug.'.'.$extension;
          move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
          $brand->image=$file_name;
        }
    }
      
    $brand->updated_at=date('Y-m-d H:i:s');
    $brand->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    $brand->save();
    MyClass::set_flash('message',['msg'=>'Cập nhật thành công','type'=>'success']);
    header("location:index.php?option=brand");
  }
  else
  {
    MyClass::set_flash('message',['msg'=>'Chưa nhập đủ thông tin','type'=>'danger']);
    header("location:index.php?option=brand&cat=edit&id=".$id);
  }
 }
?>