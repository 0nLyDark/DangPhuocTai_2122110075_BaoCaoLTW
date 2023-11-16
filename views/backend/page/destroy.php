<?php 
use App\Models\Post;
use App\Libraries\MyClass;

$id=$_REQUEST['id'];
$post=Post::find($id);

if($post==NULL)
{
    MyClass::set_flash('message',['msg'=>'Lỗi trang 404','type'=>'success']);

    header('location:index.php?option=page&cat=trash');
}

$post->delete();
MyClass::set_flash('message',['msg'=>'Xóa vĩnh viễn thành công','type'=>'success']);
header('location:index.php?option=page&cat=trash');

?>