<?php
use App\Models\Order;

$list =Order::join('user', 'order.user_id', '=', 'user.id')->where('order.status','!=',0)
->select(['order.id','order.deliveryname','order.deliveryphone','order.deliveryemail',
'order.deliveryaddress','order.note','order.status', 'user.name'])
->get();
$cout_all=Order::where('status','!=',0)->count();
$cout_trash=Order::where('status','=',0)->count();
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả đơn hàng</h1>
                     <a href="index.php?option=order&cat=create" class="btn btn-sm btn-primary">Thêm đơn hàng</a>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header ">
                  <div class="row">
                     <div class="col-md-12">
                        <a href="index.php?option=order">Tất cả (<?=$cout_all;?>)</a> |
                        <a href="index.php?option=order&cat=trash">Thùng rác (<?=$cout_trash;?>)</a>
                     </div>
                  </div>
               </div>
               <div class="card-body p-2">
               <?php require_once '../views/backend/message.php'?>
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th class="text-center" style="width:30px;">
                              <input type="checkbox">
                           </th>
                           <th>Tên tài khoản</th>
                           <th>Tên người nhận</th>
                           <th>Số điện thoại</th>
                           <th>Email</th>
                           <th>Địa chỉ</th>
                           <th>Ghi chú</th>
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
                              <?=$item->name;?>
                           </td>
                           <td>
                              <div class="name">
                                 <?=$item->deliveryname ;?>
                              </div>
                              <div class="function_style">
                                 <?php if($item->status == 1): ?>
                                    <a class ="btn btn-success btn-xs" href="index.php?option=order&cat=status&id=<?=$item->id;?>">
                                    <i class="fas fa-toggle-on"></i>Hiện</a> |
                                 <?php else: ?>
                                    <a class ="btn btn-warning btn-xs" href="index.php?option=order&cat=status&id=<?=$item->id;?>">
                                    <i class="fas fa-toggle-off"></i>Ẩn</a> |
                                 <?php endif; ?>
                                    <a class ="btn btn-secondary btn-xs" href="index.php?option=order&cat=edit&id=<?=$item->id ;?>">
                                    <i class="fas fa-edit"></i>Chỉnh sửa</a> |
                                    <a class ="btn btn-primary btn-xs" href="index.php?option=order&cat=show&id=<?=$item->id ;?>">
                                    <i class="fas fa-eye"></i>Chi tiết</a> |
                                    <a class ="btn btn-danger btn-xs" href="index.php?option=order&cat=delete&id=<?=$item->id ;?>">
                                    <i class="fas fa-trash"></i>Xoá</a>
                              </div>
                           </td>
                           <td><?=$item->deliveryphone ;?></td>
                           <td><?=$item->deliveryemail ;?></td>
                           <td><?=$item->deliveryaddress ;?></td>
                           <td><?=$item->note;?></td>
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