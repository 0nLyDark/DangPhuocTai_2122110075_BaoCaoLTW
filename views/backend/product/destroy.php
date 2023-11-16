<?php 
use App\Models\Product;
use App\Libraries\MyClass;

$id=$_REQUEST['id'];
$product=Product::find($id);

if($product==NULL)
{
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);
    header('location:index.php?option=product&cat=trash');
}
if(strlen($product->image)>0)
{
unlink("../public/images/product/".$product->image);
}
$product->delete();
MyClass::set_flash('message',['msg'=>'Xóa vĩnh viễn thành công','type'=>'success']);
header('location:index.php?option=product&cat=trash');

?>