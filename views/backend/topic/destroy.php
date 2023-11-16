<?php 
use App\Models\Topic;
use App\Libraries\MyClass;

$id=$_REQUEST['id'];
$topic=Topic::find($id);

if($topic==NULL)
{
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);

    header('location:index.php?option=topic&cat=trash');
}

$topic->delete();
MyClass::set_flash('message',['msg'=>'Xóa vĩnh viễn thành công','type'=>'success']);
header('location:index.php?option=topic&cat=trash');

?>