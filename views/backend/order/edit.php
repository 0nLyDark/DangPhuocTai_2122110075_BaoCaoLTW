<?php
use App\Models\Order;
$id=$_REQUEST['id'];
$order=Order::find($id);
$list=Order::where('order.status','!=',0)->orderby('id','DESC')->get();

if($order==NULL)
{
    header('location:index.php?option=order');
}

?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <form action="index.php?option=order&cat=process" method="post" enctype="multipart/form-data">
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật đơn hàng</h1>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header text-right">
                  <a href="index.php?option=order" class="btn btn-sm btn-info">
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
                     <div class="col-md-8">
                        <div class="mb-3">
                        <input type="hidden" name="id" value="<?=$order->id;?>" >
                           <label>ID tài khoản đặt hàng(*)</label>
                           <input type="text" name="user_id" value="<?=$order->user_id;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Tên người nhận</label>
                           <input type="text" name="deliveryname" value="<?=$order->deliveryname;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Số Điện thoại</label>
                           <input type="text" name="deliveryphone" value="<?=$order->deliveryphone;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Email</label>
                           <input type="text" name="deliveryemail" value="<?=$order->deliveryemail;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Địa chỉ</label>
                           <textarea name="deliveryaddress" rows="5" class="form-control"><?=$order->deliveryaddress;?></textarea>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="mb-3">
                        <label>Ghi chú</label>
                           <textarea name="note" rows="5" class="form-control"><?=$order->note;?></textarea>
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1" <?=($order->status)==1?'selected':'';?>>Xuất bản</option>
                              <option value="2" <?=($order->status)==2?'selected':'';?>>Chưa xuất bản</option>
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