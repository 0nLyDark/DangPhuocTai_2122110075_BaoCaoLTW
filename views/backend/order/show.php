<?php
use App\Models\Order;
use App\Models\Orderdetail;

$id=$_REQUEST['id'];
$order=Order::find($id);
$list_orderdetail=Orderdetail::where('order_id','=',$id)->get();

if($order==NULL)
{
    header('location:index.php?option=order');
}
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Chi Tiết Đơn Hàng</h1>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header">
                  <div class="row">
                     <div class="col-md-12 text-right">
                     <a href="index.php?option=order" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                     </a>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                     <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th class="text-center" style="width:30px;">
                              <input type="checkbox">
                           </th>
                           <th>Mã khách hàng</th>
                           <th>Mã sản phẩm</th>
                           <th>Giá</th>
                           <th>Số lượng</th>
                           <th>Thành tiền</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php if(count($list_orderdetail)>0): ?>
                     <?php foreach($list_orderdetail as $item1): ?>
                        <tr class="datarow">
                           <td>
                              <input type="checkbox">
                           </td>
                           <td>
                              <?=$order->user_id;?>
                           </td>
                           <td>
                              <div class="name">
                                 <?=$item1->product_id;?>
                              </div>
                           </td>
                           <td><?=$item1->price;?></td>
                           <td><?=$item1->qty;?></td>
                           <td><?=$item1->amount;?></td>
                        </tr>
                     <?php endforeach; ?>
                     <?php endif; ?>
                     </tbody>
                  </table>
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>Tên Trường</th>
                                 <th>Giá trị</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>ID</td>
                                 <td><?=$order->id;?></td>
                              </tr>
                              <tr>
                                 <td>User_id</td>
                                 <td><?=$order->user_id;?></td>
                              </tr>
                              <tr>
                                 <td>Deliveryaddress</td>
                                 <td><?=$order->deliveryaddress;?></td>
                              </tr>
                              <tr>
                                 <td>Deliveryname</td>
                                 <td><?=$order->deliveryname;?></td>
                              </tr>
                              <tr>
                                 <td>Deliveryphone</td>
                                 <td><?=$order->deliveryphone;?></td>
                              </tr>
                              <tr>
                                 <td>Deliveryemail</td>
                                 <td><?=$order->deliveryemail;?></td>
                              </tr>
                              <tr>
                                 <td>Note</td>
                                 <td><?=$order->note;?></td>
                              </tr>
                              <tr>
                                 <td>Created_at</td>
                                 <td><?=$order->created_at;?></td>
                              </tr>
                              <tr>
                                 <td>Updated_at</td>
                                 <td><?=$order->updated_at;?></td>
                              </tr>
                              <tr>
                                 <td>Updated_by</td>
                                 <td><?=$order->updated_by;?></td>
                              </tr>
                              <tr>
                                 <td>status</td>
                                 <td><?=$order->status;?></td>
                              </tr>
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