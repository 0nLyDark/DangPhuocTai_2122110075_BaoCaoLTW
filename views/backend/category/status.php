<?php 
use App\Models\Category;
use App\Libraries\MyClass;

$id=$_REQUEST['id'];
$category=Category::find($id);

if($category==NULL)
{
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
    header('location:index.php?option=category');
}

$category->status=($category->status == 1)?2:1;

$category->updated_at=date('Y-m-d H:i:s');
$category->updated_by=(isset($_SESSION['user_id']))?$_SESSION['user_id']:1;

$category->save();

MyClass::set_flash('message',['msg'=>'Cập nhật trạng thái thành công','type'=>'success']);
header('location:index.php?option=category');

?>