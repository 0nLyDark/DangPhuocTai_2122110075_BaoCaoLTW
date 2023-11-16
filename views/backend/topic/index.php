<?php

use App\Models\Topic;
$list=Topic::leftjoin('topic AS topic_2','topic.parent_id','=','topic_2.id')
->where('topic.status','!=',0)->orderby('parent_id','ASC')
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
                     <div class="col-md-4">
                        <div class="mb-3">
                           <label>Tên chủ đề (*)</label>
                           <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text" name="slug" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <input type="text" name="description" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Chủ đề cha (*)</label>
                           <select name="parent_id" class="form-control">
                              <option value="">None</option>
                              <?php foreach($list as $item) :?>
                                 <option value="<?=$item->id?>"><?=$item->name?></option>
                              <?php endforeach ;?>
                           </select>
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1">Xuất bản</option>
                              <option value="2">Chưa xuất bản</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-8">
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
                                       <?php if($item->status == 1): ?>
                                          <a class ="btn btn-success btn-xs" href="index.php?option=topic&cat=status&id=<?=$item->id;?>">
                                            <i class="fas fa-toggle-on"></i>Hiện</a> |
                                       <?php else: ?>
                                          <a class ="btn btn-warning btn-xs" href="index.php?option=topic&cat=status&id=<?=$item->id;?>">
                                          <i class="fas fa-toggle-off"></i>Ẩn</a> |
                                       <?php endif; ?>
                                       <a class ="btn btn-secondary btn-xs" href="index.php?option=topic&cat=edit&id=<?=$item->id ;?>">
                                       <i class="fas fa-edit"></i>Chỉnh sửa</a> |
                                       <a class ="btn btn-primary btn-xs" href="index.php?option=topic&cat=show&id=<?=$item->id ;?>">
                                       <i class="fas fa-eye"></i>Chi tiết</a> |
                                       <a class ="btn btn-danger btn-xs" href="index.php?option=topic&cat=delete&id=<?=$item->id ;?>">
                                       <i class="fas fa-trash"></i>Xoá</a>
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