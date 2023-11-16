<?php
use App\Models\Banner;
$list =Banner::where('status','=',0)->get();
$cout_all=Banner::where('status','!=',0)->count();
$cout_trash=Banner::where('status','=',0)->count();
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Thùng rác banner</h1>
                     <a href="index.php?option=banner&cat=create" class="btn btn-sm btn-primary">Thêm banner</a>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header">
               <div class="row">
                     <div class="col-md-12">
                        <a href="index.php?option=banner">Tất cả (<?=$cout_all;?>)</a> |
                        <a href="index.php?option=banner&cat=trash">Thùng rác (<?=$cout_trash;?>)</a>
                     </div>
                  </div>
               </div>
               <div class="card-body">
               <?php require_once '../views/backend/message.php'?>
                  <table class="table table-bordered" id="mytable">
                     <thead>
                        <tr>
                           <th class="text-center" style="width:30px;">
                              <input type="checkbox">
                           </th>
                           <th class="text-center" style="width:130px;">Hình ảnh</th>
                           <th>Tên banner</th>
                           <th>Liên kết</th>
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
                                    <img width="125px" height="125px" src="../public/images/banner/<?=$item->image; ?>" alt="<?=$item->image; ?>">
                                 </td>
                                 <td>
                                    <div class="name">
                                       <?=$item->name ?>
                                    </div>
                                    <div class="function_style">
                                       <a class ="btn btn-primary btn-xs" href="index.php?option=banner&cat=restore&id=<?=$item->id ;?>">
                                       <i class="fas fa-undo"></i>Khôi phục</a> |
                                       <a class ="btn btn-danger btn-xs" href="index.php?option=banner&cat=destroy&id=<?=$item->id ;?>">
                                       <i class="fas fa-trash"></i>Xoá vĩnh viễn</a>
                                    </div>
                                 </td>
                                 <td>
                                    <?=$item->link ?>
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