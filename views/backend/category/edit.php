<?php
use App\Models\Category;
$id=$_REQUEST['id'];
$category=Category::leftjoin('category AS category_2','category.parent_id','=','category_2.id')
->select(['category.id','category.name','category.slug','category.parent_id','category.sort_order',
'category.image','category.description','category.status','category_2.name AS name_parent',])
->find($id);
$list=Category::where('category.status','!=',0)->orderby('id','DESC')->get();

if($category==NULL)
{
    header('location:index.php?option=category');
}

?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <form action="index.php?option=category&cat=process" method="post" enctype="multipart/form-data">
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật Danh mục</h1>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header text-right">
                  <a href="index.php?option=category" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                  </a>
                  <button class="btn btn-sm btn-success" type="submit" name="CAPNHAT">
                     <i class="fa fa-save" aria-hidden="true"></i>
                     Lưu
                  </button>
               </div>
               <div class="card-body">
               <?php require_once '../views/backend/message.php'?>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="mb-3">
                           <input type="hidden" name="id" value="<?=$category->id;?>" >
                           <label>Tên thương hiệu (*)</label>
                           <input type="text" value="<?=$category->name;?>" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text" value="<?=$category->slug;?>" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Danh mục cha (*)</label>
                           <select name="parent_id" class="form-control">
                              <option value="0">None</option>
                              <?php foreach($list as $item) :?>
                                 <option value="<?=$item->id?>"<?=($item->id==$category->parent_id)?'selected':'';?>><?=$item->name?></option>
                              <?php endforeach ;?>
                           </select>
                        </div>
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <textarea name="description" class="form-control"><?=$category->description;?></textarea>
                        </div>
                        <div class="mb-3">
                           <label>Hình đại diện</label>
                           <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1" <?=($category->status)==1?'selected':'';?>>Xuất bản</option>
                              <option value="2" <?=($category->status)==2?'selected':'';?>>Chưa xuất bản</option>
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