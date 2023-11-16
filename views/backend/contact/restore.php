<?php 
use App\Models\Contact;
use App\Libraries\MyClass;

$id=$_REQUEST['id'];
$contact=Contact::find($id);

if($contact==NULL)
{
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
    header('location:index.php?option=contact&cat=trash');
}

$contact->status=2;

$contact->updated_at=date('Y-m-d H:i:s');
$contact->updated_by=(isset($_SESSION['contact_id']))?$_SESSION['contact_id']:1;

$contact->save();
MyClass::set_flash('message',['msg'=>'Khôi phục thành công','type'=>'success']);
header('location:index.php?option=contact&cat=trash');

?>