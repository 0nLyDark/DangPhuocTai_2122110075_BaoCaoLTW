<?php
use App\Models\Category;
$list=Category::leftjoin('category AS category_2','category.parent_id','=','category_2.id')
->where('category.status','=',0)->orderby('id','DESC')
->select(['category.id','category.name','category.slug','category.parent_id','category.sort_order',
'category.image','category.description','category.status','category_2.name AS name_parent',])->get();
$cout_all=Category::where('status','!=',0)->count();
$cout_trash=Category::where('status','=',0)->count();
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Thùng Rác</h1>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header">
                  <div class="row">
                     <div class="col-md-6">
                        <a href="index.php?option=category">Tất cả (<?=$cout_all;?>)</a> |
                        <a href="index.php?option=category&cat=trash">Thùng rác (<?=$cout_trash;?>)</a>
                     </div>
                     <div class="col-md-6 text-right">
                     <a href="index.php?option=category" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                     </a>
                     </div>
                  </div>
               </div>
               <div class="card-body">
               <?php require_once '../views/backend/message.php'?>
                  <div class="row">
                     <div class="col-md-12">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center" style="width:30px;">
                                    <input type="checkbox">
                                 </th>
                                 <th class="text-center" style="width:130px;">Hình ảnh</th>
                                 <th>Tên thương hiệu</th>
                                 <th>Danh mục cha</th>
                                 <th>Tên slug</th>
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
                                    <img  width="125px" height="125px" src="../public/images/category/<?=$item->image; ?>" alt="<?=$item->image; ?>">
                                 </td>
                                 <td>
                                    <div class="name">
                                       <?=$item->name ?>
                                    </div>
                                    <div class="function_style">
                                       <a class ="btn btn-primary btn-xs" href="index.php?option=category&cat=restore&id=<?=$item->id ;?>">
                                       <i class="fas fa-undo"></i>Khôi phục</a> |
                                       <a class ="btn btn-danger btn-xs" href="index.php?option=category&cat=destroy&id=<?=$item->id ;?>">
                                       <i class="fas fa-trash"></i>Xoá vĩnh viễn</a>
                                    </div>
                                 </td>
                                 <td><?= $item->name_parent;?></td>
                                 <td><?=$item->slug ?></td>
                              </tr>
                              <?php endforeach; ?>
                              <?php endif; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <!-- END CONTENT-->
<?php require_once "../views/backend/footer.php" ?>