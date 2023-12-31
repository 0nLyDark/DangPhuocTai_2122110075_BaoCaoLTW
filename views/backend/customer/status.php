<?php 
use App\Models\User;
use App\Libraries\MyClass;

$id=$_REQUEST['id'];
$customer=User::find($id);

if($customer==NULL)
{
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
    header('location:index.php?option=customer');
}

$customer->status=($customer->status == 1)?2:1;

$customer->updated_at=date('Y-m-d H:i:s');
$customer->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

$customer->save();
MyClass::set_flash('message',['msg'=>'Thay đổi trạng thái thành công','type'=>'success']);
header('location:index.php?option=customer');

?>