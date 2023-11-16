<?php
use App\Models\Topic;
$id=$_REQUEST['id'];
$topic=Topic::leftjoin('topic AS topic_2','topic.parent_id','=','topic_2.id')
->select(['topic.id','topic.name','topic.slug','topic.parent_id','topic.sort_order',
'topic.description','topic.status','topic_2.name AS name_parent',])
->find($id);
$list=topic::where('topic.status','!=',0)->orderby('id','DESC')->get();

if($topic==NULL)
{
    header('location:index.php?option=topic');
}

?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <form action="index.php?option=topic&cat=process" method="post" enctype="multipart/form-data">
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật chủ đề</h1>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header text-right">
                  <a href="index.php?option=topic" class="btn btn-sm btn-info">
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
                     <div class="col-md-12">
                        <div class="mb-3">
                           <input type="hidden" name="id" value="<?=$topic->id;?>" >
                           <label>Tên chủ đề (*)</label>
                           <input type="text" value="<?=$topic->name;?>" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text" value="<?=$topic->slug;?>" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Chủ đề cha (*)</label>
                           <select name="parent_id" class="form-control">
                              <option value="0">None</option>
                              <?php foreach($list as $item) :?>
                                 <option value="<?=$item->id?>"<?=($item->id==$topic->parent_id)?'selected':'';?>><?=$item->name?></option>
                              <?php endforeach ;?>
                           </select>
                        </div>
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <textarea name="description" class="form-control"><?=$topic->description;?></textarea>
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1" <?=($topic->status)==1?'selected':'';?>>Xuất bản</option>
                              <option value="2" <?=($topic->status)==2?'selected':'';?>>Chưa xuất bản</option>
                           </select>
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