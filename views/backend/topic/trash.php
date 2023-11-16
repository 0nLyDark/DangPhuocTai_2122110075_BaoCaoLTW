<?php

use App\Models\Topic;
$list=Topic::leftjoin('topic AS topic_2','topic.parent_id','=','topic_2.id')
->where('topic.status','=',0)->orderby('parent_id','ASC')
->select(['topic.id','topic.name','topic.slug','topic.parent_id','topic.sort_order',
'topic.description','topic.status','topic_2.name AS name_parent',])
->get();
$cout_all=Topic::where('status','!=',0)->count();
$cout_trash=Topic::where('status','=',0)->count();
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <form action="index.php?option=topic&cat=process" method="post" enctype="multipart/form-data">
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả chủ đề</h1>
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
                        <a href="index.php?option=topic">Tất cả (<?=$cout_all;?>)</a> |
                        <a href="index.php?option=topic&cat=trash">Thùng rác (<?=$cout_trash;?>)</a>
                     </div>
                     <div class="col-md-6 text-right">
                        <button class="btn btn-sm btn-success" type="submit" name="THEM">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Lưu
                        </button>
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
                                 <th>Tên chủ đề</th>
                                 <th>Chủ đề cha</th>
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
                                    <div class="name">
                                       <?=$item->name ?>
                                    </div>
                                    </div>
                                    <div class="function_style">
                                       <a class ="btn btn-primary btn-xs" href="index.php?option=topic&cat=restore&id=<?=$item->id ;?>">
                                       <i class="fas fa-undo"></i>Khôi phục</a> |
                                       <a class ="btn btn-danger btn-xs" href="index.php?option=topic&cat=destroy&id=<?=$item->id ;?>">
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
      </form>
      <!-- END CONTENT-->
<?php require_once "../views/backend/footer.php" ?>