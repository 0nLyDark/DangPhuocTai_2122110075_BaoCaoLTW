<?php
use App\Models\Menu;
$list =Menu::where('status','=',0)->get();
$cout_all=Menu::where('status','!=',0)->count();
$cout_trash=Menu::where('status','=',0)->count();
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Thùng rác menu</h1>
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
                        <a href="index.php?option=menu">Tất cả (<?=$cout_all;?>)</a> |
                        <a href="index.php?option=menu&cat=trash">Thùng rác (<?=$cout_trash;?>)</a>
                     </div>
                  </div>
               </div>
               <div class="card-body p-2">
               <?php require_once '../views/backend/message.php'?>
                 <div class="row">
                     <div class="col-md-12">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center" style="width:30px;">
                                    <input type="checkbox">
                                 </th>
                                 <th>Tên menu</th>
                                 <th>Liên kết</th>
                                 <th>Vị trí</th>
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
                                    <div class="name">
                                       <?=$item->name;?>
                                    </div>
                                    <div class="function_style">
                                       <a class ="btn btn-primary btn-xs" href="index.php?option=menu&cat=restore&id=<?=$item->id ;?>">
                                       <i class="fas fa-undo"></i>Khôi phục</a> |
                                       <a class ="btn btn-danger btn-xs" href="index.php?option=menu&cat=destroy&id=<?=$item->id ;?>">
                                       <i class="fas fa-trash"></i>Xoá vĩnh viễn</a>
                                    </div>
                                 </td>
                                 <td><?=$item->link;?></td>
                                 <td><?=$item->position;?></td>
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