<?php

use App\Models\Contact;
use App\Libraries\MyClass;

 if(isset($_POST['THEM']))
 {
    $contact= new Contact();
    $contact->name=$_POST['name'];
    $contact->phone=$_POST['phone'];
    $contact->email=$_POST['email'];
    $contact->title=$_POST['title'];
    $contact->content=$_POST['content'];

    $contact->status=$_POST['status'];

    $contact->created_at=date('Y-m-d H:i:s');

    $contact->save();
    MyClass::set_flash('message',['msg'=>'Thêm thành công','type'=>'success']);
    header("location:index.php?option=contact");
 }

 if(isset($_POST['CAPNHAT']))
 {
    $id=$_REQUEST['id'];
    $contact=contact::find($id);
    if($contact==NULL)
    {
     MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
     header("location:index.php?option=contact");
    }
 
    $contact->name=$_POST['name'];
    $contact->phone=$_POST['phone'];
    $contact->email=$_POST['email'];
    $contact->title=$_POST['title'];
    $contact->content=$_POST['content'];

    $contact->status=$_POST['status'];

    $contact->updated_at=date('Y-m-d H:i:s');
    $contact->updated_by=(isset($_SESSION['contact_id']))?$_SESSION['contact_id']:1;

    $contact->save();
    MyClass::set_flash('message',['msg'=>'Cập nhật thành công','type'=>'success']);
    header("location:index.php?option=contact");
 }
?>