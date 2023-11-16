<?php

use App\Libraries\MyClass;
use App\Models\Topic;

 if(isset($_POST['THEM']))
 {
    $topic= new Topic();
    $topic->name=$_POST['name'];
    $topic->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['name']);
    if(strlen($_POST['description'])>0):
      $topic->description=$_POST['description'];
    endif;
    if(strlen($_POST['parent_id'])>0):
      $topic->parent_id=$_POST['parent_id'];
    endif;
    $topic->status=$_POST['status'];
    $topic->created_at=date('Y-m-d H:i:s');
    $topic->created_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    $topic->save();
    MyClass::set_flash('message',['msg'=>'Thêm thành công','type'=>'success']);
    header("location:index.php?option=topic");
 }
 if(isset($_POST['CAPNHAT']))
 {
   $id=$_POST['id'];
   $topic= Topic::find($id);
   if($topic==NULL)
   {
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
    header("location:index.php?option=topic");
   }
   $topic->name=$_POST['name'];
   $topic->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['name']);
   if(strlen($_POST['description'])>0)
   {
     $topic->description=$_POST['description'];
   }
   else
   {
     if(strlen($_POST['description'])==0)
     {
       $topic->description=NULL;
     }
   }
   $topic->parent_id=$_POST['parent_id'];
   $topic->status=$_POST['status'];
    
   $topic->updated_at=date('Y-m-d H:i:s');
   $topic->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

   $topic->save();
   MyClass::set_flash('message',['msg'=>'Cập nhật thành công','type'=>'success']);
   header("location:index.php?option=topic");
 }
?>