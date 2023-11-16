<?php

use App\Libraries\Cart;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\User;

if(isset($_POST['MUANGAY']))
{
   $id = $_POST['id'];
   $qty = $_POST['qty'];
   $product = Product::find($id);
   $_SESSION['cartnow']['id']=$id;
   $_SESSION['cartnow']['qty']=$qty;
   $_SESSION['cartnow']['name']=$product->name;
   $_SESSION['cartnow']['image']=$product->image;
   $_SESSION['cartnow']['price']=$product->price;
}

$list_cart=Cart::cartContent();
if(isset($_SESSION['iscustom']))
{
   $customer=User::where([['status','=',1],['id','=',$_SESSION['user_id']]])->first();
}
if(isset($_POST['XACNHAN']))
{
   $order=new Order();
   $order->user_id=$_SESSION['user_id'];
   $order->deliveryaddress=$_POST['address'];
   $order->deliveryname=$customer->name;
   $order->deliveryphone=$customer->phone;
   $order->deliveryemail=$customer->email;
   $order->note="khong chu y";
   $order->created_at=date('Y-m-d H:i:s');
   $order->status=1;
   if($order->save())
   {
      $cart=$_SESSION['cartnow'];
         $orderdetail=new Orderdetail();
         $orderdetail->order_id=$order->id;
         $orderdetail->product_id=$cart['id'];
         $orderdetail->price=$cart['price'];
         $orderdetail->qty=$cart['qty'];
         $orderdetail->amount=$cart['price']*$cart['qty'];
         $orderdetail->updated_at=date('Y-m-d H:i:s');
         $orderdetail->save();
      unset($_SESSION['cartnow']);
   }
   header('location:index.php');
}
$title='Thanh toán';

?>
<?php require_once('views/frontend/header.php') ;?>
   <section class="bg-light">
      <div class="container">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-2 my-0">
            <li class="breadcrumb-item">
                  <a class="text-main" href="index.php">Trang chủ</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">
                  Thanh toán
               </li>
            </ol>
         </nav>
      </div>
   </section>
   <section class="hdl-maincontent py-2">
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <form action="index.php?option=checkout&now=true" method="post">
                  <h2 class="fs-5 text-main">Thông tin giao hàng</h2>
                  <?php if(isset($_SESSION['iscustom'])):?>
                     <div class="mb-3">
                     <label for="name">Họ tên</label>
                     <input type="text" name="name" id="name" value="<?=$customer->name;?>" class="form-control" placeholder="Nhập họ tên" readonly>
                  </div>
                  <div class="mb-3">
                     <label for="phone">Điện thoại</label>
                     <input type="text" name="phone" id="phone" value="<?=$customer->phone;?>" class="form-control" placeholder="Nhập điện thoại" readonly>
                  </div>
                  <div class="mb-3">
                     <label for="email">Email</label>
                     <input type="text" name="email" id="email" value="<?=$customer->email;?>" class="form-control" placeholder="Nhập email" readonly>
                  </div>
                  <div class="card">
                     <div class="card-header text-main">
                        Địa chỉ nhận hàng
                     </div>
                     <div class="card-body">
                        <div class="mb-3">
                           <label for="address">Địa chỉ</label>
                           <input type="text" name="address" id="address" value="<?=$customer->address;?>" class="form-control" placeholder="Nhập địa chỉ">
                        </div>
                     </div>
                  </div>
                  <h4 class="fs-6 text-main mt-4">Phương thức thanh toán</h4>
                  <div class="thanhtoan mb-4">
                     <div class="p-4 border">
                        <input name="typecheckout" onchange="showbankinfo(this.value)" type="radio" value="1"
                           id="check1" />
                        <label for="check1">Thanh toán khi giao hàng</label>
                     </div>
                     <div class="p-4 border">
                        <input name="typecheckout" onchange="showbankinfo(this.value)" type="radio" value="2"
                           id="check2" />
                        <label for="check2">Chuyển khoản qua ngân hàng</label>
                     </div>
                     <div class="p-4 border bankinfo">
                        <p>Ngân Hàng Vietcombank </p>
                        <p>STK: 99999999999999</p>
                        <p>Chủ tài khoản: Hồ Diên Lợi</p>
                     </div>
                  </div>
                  <div class="text-end">
                     <button type="submit" name="XACNHAN" class="btn btn-main px-4">XÁC NHẬN</button>
                  </div>
                  <?php else:?>
                     <p>Bạn có tài khoản chưa?
                        <a href="index.php?option=customer&login=true">Đăng nhập</a>
                        <a href="index.php?option=customer&register=true">Đăng ký</a>
                     </p>
                  <?php endif;?>
               </form>
            </div>
            <script>
               function showbankinfo(value) {
                  var elementbank = document.querySelector(".bankinfo");
                  if (value == 1) {
                     elementbank.style.display = "none";
                  }
                  else {
                     elementbank.style.display = "block";
                  }
               }
            </script>
            <div class="col-md-6">
               <h2 class="fs-5 text-main">Thông tin đơn hàng</h2>
               <table class="table table-borderless">
                  <thead>
                     <tr class="bg-dark">
                        <th style="width:30px;" class="text-center">STT</th>
                        <th style="width:100px;">Hình</th>
                        <th>Tên sản phẩm</th>
                        <th class="text-center">Giá</th>
                        <th style="width:130px" class='text-center'>Số lượng</th>
                        <th class="text-center">Thành tiền</th>
                     </tr>
                  </thead>
                  <tbody>
                        <?php $money_item=$product->price * $qty;?>
                        <tr>
                           <td class="text-center align-middle">1</td>
                           <td>
                              <img class="img-fluid" src="public/images/product/<?=$product->image;?>" alt="<?=$product->image;?>"> </td>
                           <td class="align-middle"><?=$product->name;?></td>
                           <td class="text-center align-middle"><?=number_format($product->price);?></td>
                           <td class="text-center align-middle">
                              <?=$qty;?>
                           </td>
                           <td class="text-center align-middle">
                              <?=number_format($money_item);?>
                           </td>
                        </tr>
                  </tbody>
                  <tfoot>
                     <tr>
                        <td colspan="6" class="text-end">
                           <strong>Tổng tiền: <?=number_format($money_item);?><sup>Đ</sup></strong>
                        </td>
                     </tr>
                  </tfoot>
               </table>
               <div>
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" placeholder="Mã giảm giá" aria-describedby="basic-addon2">
                     <span class="input-group-text" id="basic-addon2">Sử dụng</span>
                  </div>
               </div>
               <table class="table table-borderless">
                  <tr>
                     <th>Tạm tính</th>
                     <td class="text-end"><?=number_format($money_item);?> đ</td>
                  </tr>
                  <tr>
                     <th>Phí vận chuyển</th>
                     <td class="text-end">0</td>
                  </tr>
                  <tr>
                     <th>Giảm giá</th>
                     <td class="text-end">0</td>
                  </tr>
                  <tr>
                     <th>Tổng cộng</th>
                     <td class="text-end"><strong><?=number_format($money_item);?> đ</strong></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </section>
   <?php require_once('views/frontend/footer.php') ;?>