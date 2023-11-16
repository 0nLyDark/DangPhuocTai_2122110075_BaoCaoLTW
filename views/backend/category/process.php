<?php

use App\Libraries\MyClass;
use App\Models\Category;

 if(isset($_POST['THEM']))
 {
  if(strlen($_POST['name']) > 0)
  {
    $category= new Category();
    $category->name=$_POST['name'];
    $category->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['name']);
    if(strlen($_POST['description'])>0):
      $category->description=$_POST['description'];
    endif;
    $category->status=$_POST['status'];
    if(($_POST['parent_id'])):
      $category->parent_id=$_POST['parent_id'];
    endif;


    if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/category/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {
         $file_name=$category->slug.'.'.$extension;
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $category->image=$file_name;
      }
    }
    
    $category->created_at=date('Y-m-d H:i:s');
    $category->created_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    $category->save();
    MyClass::set_flash('message',['msg'=>'Thêm thành công','type'=>'success']);
    header("location:index.php?option=category");
  }
  else
  {
    MyClass::set_flash('message',['msg'=>'Chưa nhập đủ thông tin','type'=>'danger']);
    header("location:index.php?option=category");
  }

 }

 if(isset($_POST['CAPNHAT']))
 {
  $id=$_POST['id'];
  $category= Category::find($id);
  if($category==NULL)
  {
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
    header("location:index.php?option=category");
  }
  if(strlen($_POST['name']) > 0)
  {
   $category->name=$_POST['name'];
   $category->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['name']);
   if(strlen($_POST['description'])>0)
   {
     $category->description=$_POST['description'];
   }
   else
   {
     if(strlen($_POST['description'])==0)
     {
       $category->description=NULL;
     }
   }
   $category->parent_id=$_POST['parent_id'];
   $category->status=$_POST['status'];

   if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/category/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {
        if(strlen($category->image)>0)
        {
          unlink("../public/images/category/".$category->image);
        }
         $file_name=$category->slug.'.'.$extension;
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $category->image=$file_name;
      }
    }
    
   $category->updated_at=date('Y-m-d H:i:s');
   $category->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

   $category->save();

   MyClass::set_flash('message',['msg'=>'Cập nhật thành công','type'=>'success']);
   header("location:index.php?option=category");
  }
  else
  {
    MyClass::set_flash('message',['msg'=>'Chưa nhập đủ thông tin','type'=>'danger']);
    header("location:index.php?option=category&cat=edit&id=".$id);
  }
 }
?>