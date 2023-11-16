<?php
use App\Models\User;
if(isset($_SESSION['iscustom']))
{
   $customer=User::find($_SESSION['user_id']);
   if(isset($_POST['CAPNHATTHONGTIN']))
   {
      if(strlen($_POST['name'])>0 && strlen($_POST['phone'])>0 && strlen($_POST['address'])>0)
      {
         if($customer->password == sha1($_POST['password']))
         {
            $customer->name =$_POST['name'];
            $customer->phone =$_POST['phone'];
            $customer->address =$_POST['address'];
            $customer->save();
            $msg="Đã cập nhật thông tin thành công";
         }
         else
            $msg="Mật khẩu không đúng";
      }
      else
         $msg="Vui lòng nhập đầy đủ thông tin";
   }
}

$title='Cập nhật thông tin tài khoản';
?>
<?php require_once('views/frontend/header.php') ;?>
   <section class="bg-light">
      <div class="container">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-2 my-0">
               <li class="breadcrumb-item">
                  <a class="text-main" href="index.php">Trang chủ</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Cập nhật thông tin</li>
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
               <h1 class="fs-2 text-main">Cập nhật thông tin</h1>
               
               <?php if(isset($_SESSION['iscustom'])):?>
                  <?php if(isset($msg)) echo $msg;?>
                  <form action="index.php?option=profile&edit=true" method="post">
                     <table class="table table-borderless">
                        <tr>
                           <td style="width:20%;">Tên tài khoản</td>
                           <td><input type="text" name="name" value="<?=$customer->name;?>" style="width:50%;" class="form-control" ></td>                        
                        </tr>
                        <tr>
                           <td style="width:20%;">Tên đăng nhập</td>
                           <td><?=$customer->username;?></td>
                        </tr>
                        <tr>
                           <td style="width:20%;">Email</td>
                           <td><?=$customer->email;?></td>
                        </tr>
                        <tr>
                           <td style="width:20%;">Điện thoại</td>
                           <td><input type="text" name="phone" value="<?=$customer->phone;?>" style="width:50%;" class="form-control"></td>
                        </tr>
                        <tr>
                           <td style="width:20%;">Địa chỉ</td>
                           <td><input type="text" name="address" value="<?=$customer->address;?>" style="width:50%;" class="form-control"></td>
                        </tr>
                        <tr>
                           <td style="width:20%;">Nhập mật khẩu </td>
                           <td><input type="password" name="password"  style="width:50%;" class="form-control"></td>
                        </tr>
                        <tr>
                           <td style="width:20%;"></td>
                           <td>
                              <button class="btn btn-main" type="submit" name="CAPNHATTHONGTIN">
                                 Cập nhật thông tin
                              </button>
                           </td>
                        </tr>
                     </table>
                  </form>
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
