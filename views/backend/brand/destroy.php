<?php 
use App\Models\Brand;
use App\Libraries\MyClass;

$id=$_REQUEST['id'];
$brand=Brand::find($id);

if($brand==NULL)
{
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
    header('location:index.php?option=brand&cat=trash');
}

$brand->delete();

MyClass::set_flash('message',['msg'=>'Xóa vĩnh viễn thành công','type'=>'success']);
header('location:index.php?option=brand&cat=trash');

?>