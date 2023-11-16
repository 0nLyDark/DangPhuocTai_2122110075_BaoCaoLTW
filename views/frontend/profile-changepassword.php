<?php
use App\Models\User;

if(isset($_REQUEST['DOIMATKHAU']))
{
   if(strlen($_POST['password'])>0)
   {
      $customer=User::find($_SESSION['user_id']);
      if($customer->password == sha1($_POST['password_old']))
      {
         if($_POST['password'] == $_POST['password_re'])
         {
            $customer->password = sha1($_POST['password']);
            $customer->save();
            $msg="Đổi mật khẩu thành công"; 
         }
         else
            $msg="Mật khẩu mới xác nhận không trùng khớp";
      }
      else
         $msg="Mật khẩu cũ không đúng";
   }
   else
      $msg="Mật khẩu không được để trống";
}

$title='Đổi mật khẩu';
?>
<?php require_once('views/frontend/header.php') ;?>
   <section class="bg-light">
      <div class="container">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-2 my-0">
               <li class="breadcrumb-item">
                  <a class="text-main" href="index.php">Trang chủ</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
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
               <form action="index.php?option=profile&changepassword=true" method="post">
                  <h1 class="fs-2 text-main">Đổi mật khẩu</h1>
                  <?php if(isset($_SESSION['iscustom'])):?>
                     <?php if(isset($msg)) echo $msg;?>
                     <table class="table table-borderless">
                        <tr>
                           <td style="width:20%;">Mật khẩu cũ</td>
                           <td>
                              <input type="password" name="password_old" class="form-control" />
                           </td>
                        </tr>
                        <tr>
                           <td>Mật khẩu</td>
                           <td>
                              <input type="password" name="password" class="form-control" />
                           </td>
                        </tr>
                        <tr>
                           <td>Xác nhận mật khẩu</td>
                           <td>
                              <input type="password" name="password_re" class="form-control" />
                           </td>
                        </tr>
                        <tr>
                           <td></td>
                           <td>
                              <button class="btn btn-main" type="submit" name="DOIMATKHAU">
                                 Đổi mật khẩu
                              </button>
                           </td>
                        </tr>
                     </table>
                  <?php else:?>
                  <p>Bạn có tài khoản chưa?
                     <a href="index.php?option=customer&login=true">Đăng nhập</a>
                     <a href="index.php?option=customer&register=true">Đăng ký</a>
                  </p>
                  <?php endif;?>
               </form>
            </div>
         </div>
      </div>
   </section>
<?php require_once('views/frontend/footer.php') ;?>
