<?php
use App\Models\Post;

$id=$_REQUEST['id'];
$post=Post::find($id);

if($post==NULL)
{
    header('location:index.php?option=page');
}
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Chi tiết sản phẩm</h1>
                  </div>
               </div>
            </div>
         </section>

         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header text-right">
                  <a href="index.php?option=page" class="btn btn-sm btn-info">
                     <i class="fa fa-arrow-left" aria-hidden="true"></i>
                     Về danh sách
                  </a>
               </div>
               <div class="card-body p-2">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th style="width:30%">Tên trường</th>
                           <th>Giá trị</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th>ID</th>
                           <td><?=$post->id;?></td>
                        </tr>
                        <tr>
                           <th>Topic_id</th>
                           <td><?=$post->topic_id;?></td>
                        </tr>
                        <tr>
                           <th>Title</th>
                           <td><?=$post->title;?></td>
                        </tr>
                        <tr>
                           <th>Slug</th>
                           <td><?=$post->slug;?></td>
                        </tr>
                        <tr>
                           <th>Detail</th>
                           <td><?=$post->detail;?></td>
                        </tr>
                        <tr>
                           <th>Hình ảnh</th>
                           <td>
                              <img width="125px" height="125px" src="../public/images/post/<?=$post->image;?>" alt="<?=$post->image; ?>">
                           </td>
                        </tr>
                        <tr>
                           <th>Type</th>
                           <td><?=$post->type;?></td>
                        </tr>
                        <tr>
                           <th>Description</th>
                           <td><?=$post->description;?></td>
                        </tr>
                        <tr>
                        <tr>
                           <th>Created_at</th>
                           <td><?=$post->created_at;?></td>
                        </tr>
                        <tr>
                           <th>Created_by</th>
                           <td><?=$post->created_by;?></td>
                        </tr>
                        <tr>
                           <th>Updated_at</th>
                           <td><?=$post->updated_at;?></td>
                        </tr>
                        <tr>
                           <th>Updated_by</th>
                           <td><?=$post->updated_by;?></td>
                        </tr>
                        <tr>
                           <th>Status</th>
                           <td><?=$post->status;?></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </section>
      </div>
      <!-- END CONTENT-->
<?php require_once "../views/backend/footer.php" ?>