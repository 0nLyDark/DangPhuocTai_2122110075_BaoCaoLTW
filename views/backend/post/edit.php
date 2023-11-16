<?php 
use App\Models\Post;
use App\Models\Topic;
$id=$_REQUEST['id'];
$post = Post::join('topic', 'post.topic_id', '=', 'topic.id')
    ->where([['post.status', '!=', 0],['type','=','post']])
    ->select(['post.id','title','post.slug','post.description','post.detail','topic_id','image','post.status', 'topic.name AS topic_name'])
    ->find($id);
$cout_all=Post::where([['status','!=',0],['type', '=','post']])->count();
$cout_trash=Post::where([['status','=',0],['type', '=','post']])->count();
$list=Topic::where('status','!=',0)->get();
if($post==NULL)
{
    header('location:index.php?option=post');
}

?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <form action="index.php?option=post&cat=process" method="post" enctype="multipart/form-data">
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật bài viết</h1>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               
               <div class="card-header text-right">
                  <a href="index.php?option=post" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                  </a>
                  <button class="btn btn-sm btn-success" type="submit" name="CAPNHAT">
                     <i class="fa fa-save" aria-hidden="true"></i>
                     Lưu
                  </button>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-9">
                        <div class="mb-3">
                           <input type="hidden" name="id" value="<?=$post->id;?>" >
                           <label>Tên sản phẩm(*)</label>
                           <input type="text" value="<?=$post->title;?>" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text" value="<?=$post->slug;?>" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <input type="text" name="description"  value="<?=$post->description;?>" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                           <label>Chi tiết (*)</label>
                           <textarea name="detail" rows="5" class="form-control"><?=$post->detail;?></textarea>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="mb-3">
                           <label>Chủ đề (*)</label>
                           <select name="topic_id" class="form-control">
                              <?php foreach($list as $item) :?>
                                 <option value="<?=$item->id?>"<?=($item->id==$post->topic_id)?'selected':'';?>><?=$item->name?></option>
                              <?php endforeach ;?>
                           </select>
                        </div>
                        <div class="mb-3">
                           <label>Hình đại diện</label>
                           <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1" <?=($post->status)==1?'selected':'';?>>Xuất bản</option>
                              <option value="2" <?=($post->status)==2?'selected':'';?>>Chưa xuất bản</option>
                           </select>
                           </div>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      </form>
      <!-- END CONTENT-->
<?php require_once "../views/backend/footer.php" ?>