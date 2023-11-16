<?php
use App\Libraries\MyClass;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
if(isset($_SESSION['iscustom']))
{
   $list_order=Order::where([['status','=',1],['user_id','=',$_SESSION['user_id']]])->get();
   $list_orderdetail;
   foreach($list_order as $order)
   {
      $list_orderdetail[$order->id]=Orderdetail::join('product','product.id','=','product_id')
      ->where('order_id','=',$order->id)->select('image','name','orderdetail.price','orderdetail.qty','amount')->get();
   }
}
$title='Quản lý dơn hàng';
?>
<?php require_once('views/frontend/header.php') ;?>
   <section class="bg-light">
      <div class="container">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-2 my-0">
               <li class="breadcrumb-item">
                  <a class="text-main" href="index.php">Trang chủ</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Quản lý đơn hàng</li>
            </ol>
         </nav>
      </div>
   </section>
   <section class="hdl-maincontent py-2">
      <div class="container">
         <div class="row">
            <div class="col-md-3 order-2 order-md-1">
               <ul class="list-group mb-3 list-category">
                  <li class="list-group-item bg-main py-3">Thông tin tài khoản</li>
                  <li class="list-group-item">
                     <a href="index.php?option=profile">Thông tin tài khoản</a>
                  </li>
                  <li class="list-group-item">
                     <a href="index.php?option=profile&order=true">Quản lý đơn hàng</a>
                  </li>
                  <li class="list-group-item">
                     <a href="index.php?option=profile&changepassword=true">Đổi mật khẩu</a>
                  </li>
                  <li class="list-group-item">
                     <a href="index.php?option=profile&edit=true">Cập nhật thông tin</a>
                  </li>
               </ul>
            </div>
            <div class="col-md-9 order-1 order-md-2">
               <h1 class="fs-2 text-main">Quản lý đơn hàng</h1>
               <?php if(isset($_SESSION['iscustom'])):?>
                  <?php if(count($list_order)>0):?>
                     <?php foreach($list_order as $order):?>
                        <div class="row border border-primary bg-info text-white my-3 p-4 " style="border-radius: 25px;" >
                           <div class="col-md-4">
                                 <p><strong>Tên người nhận: </strong><?=$order->deliveryname;?></p>
                                 <p><strong>Email: </strong><?=$order->deliveryemail;?></p>
                                 <p><strong>SĐT liên hệ: </strong><?=$order->deliveryphone;?></p>
                           </div>
                           <div class="col-md-8">
                              <div class="col">
                                 <div class="row-8">
                                    <p><strong>Địa chỉ: </strong><?=$order->deliveryaddress;?></p>
                                 </div>
                                 <div class="row-4">
                                    <p><strong>Chú ý: </strong><?=$order->note;?></p>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="text-sart ">
                                 <div class="form-check form-switch">
                                    <input name="showorder" class="form-check-input" type="checkbox" role="switch" 
                                    id="<?=$order->id;?>" onchange="showOrder(id)">
                                    <label class="form-check-label" id="labelshoworder" for="<?=$order->id;?>">Xem chi tiết</label>
                                 </div>
                              </div>
                              <div class="orderdetail border border-info bg-white text-black " id="orderdetail<?=$order->id;?>" style="display: none;border-radius: 25px;">
                              <?php $total=0;?>
                                 <?php foreach($list_orderdetail[$order->id] as $orderdetail):?>
                                    <?php $total+=$orderdetail->amount;?>
                                    <div class="row my-3">
                                       <div class="col-md-2">
                                          <img width="125px" height="125px" src="public/images/product/<?= $orderdetail->image; ?>" alt="<?= $orderdetail->image; ?>">
                                       </div>
                                       <div class="col-md-4">
                                          <p><strong>Tên SP: </strong><a href="index.php?option=product&slug=<?=MyClass::str_slug($orderdetail->name);;?>" style="text-decoration: none;" ><?=$orderdetail->name;?></a></p>
                                       </div>
                                       <div class="col-md-3">
                                          <p><strong>Giá: </strong><?=number_format($orderdetail->price);?> <sup>Đ</sup></p>
                                          <p><strong>Số lượng: </strong><?=$orderdetail->qty;?></p>
                                       </div>
                                       <div class="col-md-3">
                                          <p><strong>Tổng: </strong><?=number_format($orderdetail->amount);?> <sup>Đ</sup></p>
                                       </div>
                                    </div>
                                 <?php endforeach;?> 
                              </div>
                              <script>
                                 function showOrder(id) {
                                    const elementGender = document.getElementById(id).checked;

                                    if (elementGender == true) {
                                       document.getElementById("orderdetail"+id).style.display = "block";
                                    }
                                    else {
                                       document.getElementById("orderdetail"+id).style.display = "none";
                                    }
                                 }
                              </script>
                              <p class="text-end  mt-3"><strong>Tổng tiền: </strong><?=number_format($total);?> <sup>Đ</sup></p>
                           </div>
                        </div>
                     <?php endforeach;?>
                  <?php endif;?>
               <?php else:?>
                  <p>Bạn có tài khoản chưa?
                     <a href="index.php?option=customer&login=true">Đăng nhập</a>
                     <a href="index.php?option=customer&register=true">Đăng ký</a>
                  </p>
               <?php endif;?>
            </div>
         </div>
      </div>
   </section>
<?php require_once('views/frontend/footer.php') ;?>
