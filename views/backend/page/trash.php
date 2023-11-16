<?php
use App\Models\Post;
use App\Models\Topic;
$list = Post::join('topic', 'post.topic_id', '=', 'topic.id')
    ->where([['post.status', '=', 0],['type','=','page']])
    ->select(['post.id','title','post.slug','topic_id','image','post.status', 'topic.name AS topic_name'])
    ->get();
$cout_all=Post::where([['status','!=',0],['type', '=','page']])->count();
$cout_trash=Post::where([['status','=',0],['type', '=','page']])->count();
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Thùng rác bài viết</h1>
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
                        <a href="index.php?option=page">Tất cả (<?=$cout_all;?>)</a> |
                        <a href="index.php?option=page&cat=trash">Thùng rác (<?=$cout_trash;?>)</a>
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
                                 <a class ="btn btn-primary btn-xs" href="index.php?option=page&cat=restore&id=<?=$item->id ;?>">
                                 <i class="fas fa-undo"></i>Khôi phục</a> |
                                 <a class ="btn btn-danger btn-xs" href="index.php?option=page&cat=destroy&id=<?=$item->id ;?>">
                                 <i class="fas fa-trash"></i>Xoá vĩnh viễn</a>
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