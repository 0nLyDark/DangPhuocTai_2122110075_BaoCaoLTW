<?php
use App\Models\Post;
use App\Models\Topic;
$list = Post::join('topic', 'post.topic_id', '=', 'topic.id')
    ->where([['post.status', '!=', 0],['type','=','post']])
    ->select(['post.id','title','post.slug','topic_id','image','post.status', 'topic.name AS topic_name'])
    ->get();
$cout_all=Post::where([['status','!=',0],['type', '=','post']])->count();
$cout_trash=Post::where([['status','=',0],['type', '=','post']])->count();
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả bài viết</h1>
                     <a href="index.php?option=post&cat=create" class="btn btn-sm btn-primary">Thêm bài viết</a>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header p-2">
               <div class="row">
                     <div class="col-md-12">
                        <a href="index.php?option=post">Tất cả (<?=$cout_all;?>)</a> |
                        <a href="index.php?option=post&cat=trash">Thùng rác (<?=$cout_trash;?>)</a>
                     </div>
                  </div>
               </div>
               <div class="card-body p-2">
               <?php require_once '../views/backend/message.php'?>
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th class="text-center" style="width:30px;">
                              <input type="checkbox">
                           </th>
                           <th class="text-center" style="width:130px;">Hình ảnh</th>
                           <th>Tiêu đề bài viết</th>
                           <th>Tên chủ đề</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(count($list)>0): ?>
                        <?php foreach($list as $item): ?>
                        <tr class="datarow">
                           <td>
                              <input type="checkbox">
                           </td>
                           <td>
                              <img width="125px" height="125px" src="../public/images/post/<?=$item->image?>" alt="<?=$item->image?>">
                           </td>
                           <td>
                              <div class="name">
                                 <?=$item->title?>
                              </div>
                              <div class="function_style">
                                 <?php if($item->status == 1): ?>
                                    <a class ="btn btn-success btn-xs" href="index.php?option=post&cat=status&id=<?=$item->id;?>">
                                    <i class="fas fa-toggle-on"></i>Hiện</a> |
                                 <?php else: ?>
                                    <a class ="btn btn-warning btn-xs" href="index.php?option=post&cat=status&id=<?=$item->id;?>">
                                    <i class="fas fa-toggle-off"></i>Ẩn</a> |
                                 <?php endif; ?>
                                    <a class ="btn btn-secondary btn-xs" href="index.php?option=post&cat=edit&id=<?=$item->id ;?>">
                                    <i class="fas fa-edit"></i>Chỉnh sửa</a> |
                                    <a class ="btn btn-primary btn-xs" href="index.php?option=post&cat=show&id=<?=$item->id ;?>">
                                    <i class="fas fa-eye"></i>Chi tiết</a> |
                                    <a class ="btn btn-danger btn-xs" href="index.php?option=post&cat=delete&id=<?=$item->id ;?>">
                                    <i class="fas fa-trash"></i>Xoá</a>
                              </div>
                           </td>
                           <td>
                              <?=$item->topic_name?>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </section>
      </div>
      <!-- END CONTENT-->
<?php require_once "../views/backend/footer.php" ?>