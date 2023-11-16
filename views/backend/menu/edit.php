<?php 
use App\Models\Menu;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Topic;
use App\Models\Post;
$id=$_REQUEST['id'];
$menu =Menu::where('status','!=',0)->find($id);
$list=Menu::where('status','!=',0)->get();
$list_category =Category::where('status','!=',0)->get();
$list_brand =Brand::where('status','!=',0)->get();
$list_topic =Topic::where('status','!=',0)->get();
$list_page =Post::where([['status','!=',0],['type','=','page']])->get();
if($menu==NULL)
{
    header('location:index.php?option=menu');
}

$cout_all=Menu::where('status','!=',0)->count();
$cout_trash=Menu::where('status','=',0)->count();
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
   <form action="index.php?option=menu&cat=process" method="post" enctype="multipart/form-data">
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật menu</h1>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               
               <div class="card-header text-right">
                  <a href="index.php?option=menu" class="btn btn-sm btn-info">
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
                           <input type="hidden" name="id" value="<?=$menu->id;?>" >
                           <label>Tên Menu(*)</label>
                           <input type="text" value="<?=$menu->name;?>" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Link</label>
                           <input type="text" value="<?=$menu->link;?>" name="link" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Menu Cha</label>
                           <select name="parent_id" class="form-control">
                              <option value="0">None</option>
                              <?php foreach($list AS $item):?>
                                  <option value="<?=$item->id?>" <?=($menu->parent_id)==$item->id?'selected':'';?>><?=$item->name?></option>
                              <?php endforeach;?>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="mb-3">
                           <label>Vị trí</label>
                           <select name="position" class="form-control">
                              <option value="mainmenu" <?=($menu->position)=="mainmenu"?'selected':'';?>>Main Menu</option>
                              <option value="footermenu" <?=($menu->position)=="footermenu"?'selected':'';?>>Footer Menu</option>
                           </select>
                        </div>
                        <div class="mb-3">
                           <label>Kiểu Menu</label>
                           <select name="type" class="form-control">
                              <option value="category" <?=($menu->type)=="category"?'selected':'';?>>Category</option>
                              <option value="brand" <?=($menu->type)=="brand"?'selected':'';?>>Brand</option>
                              <option value="topic" <?=($menu->type)=="topic"?'selected':'';?>>Topic</option>
                              <option value="page" <?=($menu->type)=="page"?'selected':'';?>>Page</option>
                              <option value="custom" <?=($menu->type)=="custom"?'selected':'';?>>Custom</option>
                           </select>
                        </div>
                        <div class="mb-3">
                           <label>Thứ tự</label>
                           <input type="number" value="<?=$menu->sort_order;?>" min="0" name="sort_order" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1" <?=($menu->status)==1?'selected':'';?>>Xuất bản</option>
                              <option value="2" <?=($menu->status)==2?'selected':'';?>>Chưa xuất bản</option>
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