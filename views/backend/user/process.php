<?php

use App\Models\User;
use App\Libraries\MyClass;

 if(isset($_POST['THEM']))
 {
    $user= new User();
    $user->name=$_POST['name'];
    $user->phone=$_POST['phone'];
    $user->email=$_POST['email'];
    $user->address=$_POST['address'];
    $user->username=$_POST['username'];
    $user->password=sha1($_POST['password']);
    $user->gender=$_POST['gender'];
    $user->roles=1;

    $user->status=$_POST['status'];

    if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/user/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {
         $file_name=basename($_FILES["image"]["name"]);
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $user->image=$file_name;
      }
    }
    $kq=true;
    $user->created_at=date('Y-m-d H:i:s');
    $user->created_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    if (filter_var($user->email, FILTER_VALIDATE_EMAIL))
    {
      if($_POST['password']==$_POST['password_re'])
      {
        $user->save();
      }
    }
    else{
      $kq=false;
    }
    MyClass::set_flash('message',['msg'=>'Thêm thành công','type'=>'success']);
    header("location:index.php?option=user");
 }

 if(isset($_POST['CAPNHAT']))
 {
    $id=$_REQUEST['id'];
    $user=User::find($id);
    if($user==NULL)
    {
     MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
     header("location:index.php?option=user");
    }
    $user->name=$_POST['name'];
    $user->phone=$_POST['phone'];
    $user->email=$_POST['email'];
    $user->address=$_POST['address'];
    $user->username=$_POST['username'];
    $user->password=sha1($_POST['password']);
    $user->gender=$_POST['gender'];
    $user->roles=1;

    $user->status=$_POST['status'];

    if(strlen($_FILES['image']['name'])>0)
    {
      $target_dir = "../public/images/user/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png','gif','webp']))
      {
        if(strlen($user->image)>0)
          {
            unlink("../public/images/user/".$user->image);
          }
         $file_name=$user->name.$user->id;
         move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$file_name);
         $user->image=$file_name;
      }
    }
    $kq=true;
    $user->updated_at=date('Y-m-d H:i:s');
    $user->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

    if (filter_var($user->email, FILTER_VALIDATE_EMAIL))
    {
      if($_POST['password']==$_POST['password_re'])
      {
        $user->save();
      }
    }
    else{
      $kq=false;
    }
    MyClass::set_flash('message',['msg'=>'Cập nhật thành công','type'=>'success']);
    header("location:index.php?option=user");
 }
?>