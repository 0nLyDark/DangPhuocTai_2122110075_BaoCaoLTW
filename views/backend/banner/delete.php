<?php 
use App\Models\Banner;
use App\Libraries\MyClass;

$id=$_REQUEST['id'];
$banner=Banner::find($id);

if($banner==NULL)
{
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
    header('location:index.php?option=banner');
}

$banner->status=0;

$banner->updated_at=date('Y-m-d H:i:s');
$banner->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

$banner->save();
MyClass::set_flash('message',['msg'=>'Xóa thành công','type'=>'success']);
header('location:index.php?option=banner');

?>