<?php

use App\Libraries\MyClass;
use App\Models\Post;

 if(isset($_POST['THEM']))
 {
    $post= new Post();
    $post->title=$_POST['title'];
    $post->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['title']);
    if(strlen($_POST['description'])>0):
      $post->description=$_POST['description'];
    endif;
    $post->detail=$_POST['detail'];
    $post->topic_id=$_POST['topic_id'];
    $post->status=$_POST['status'];


    if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/post/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {
         $file_name=$post->slug.'.'.$extension;
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $post->image=$file_name;
      }
    }
    
    $post->created_at=date('Y-m-d H:i:s');
    $post->created_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    $post->save();
    MyClass::set_flash('message',['msg'=>'Thêm thành công','type'=>'success']);
    header("location:index.php?option=post");
 }
 if(isset($_POST['CAPNHAT']))
 {
  $id=$_POST['id'];
  $post= Post::find($id);
  if($post==NULL)
  {
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
     header("location:index.php?option=post");
  }

  $post->title=$_POST['title'];
  $post->slug=(strlen($_POST['slug'])>0)?$_POST['slug']:MyClass::str_slug($_POST['title']);
  $post->detail=$_POST['detail'];
  $post->topic_id=$_POST['topic_id'];
  $post->status=$_POST['status'];
  if(strlen($_POST['description'])>0)
    {
      $post->description=$_POST['description'];
    }
    else
    {
      if(strlen($_POST['description'])==0)
      {
        $post->description=NULL;
      }
    }
  
    $post->status=$_POST['status'];

    if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/post/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(strlen($post->image)>0)
      {
        unlink("../public/images/post/".$post->image);
      }
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {
         $file_name=$post->slug.'.'.$extension;
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $post->image=$file_name;
      }
    }
    
    $post->updated_at=date('Y-m-d H:i:s');
    $post->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    $post->save();
    MyClass::set_flash('message',['msg'=>'Cập nhật thành công','type'=>'success']);
    header("location:index.php?option=post");
    
 }
?>