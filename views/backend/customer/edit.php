<?php
use App\Models\User;
$id=$_REQUEST['id'];

$customer=User::find($id);
if($customer==NULL)
{
    header('location:index.php?option=customer');
}
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <form action="index.php?option=customer&cat=process" method="post" enctype="multipart/form-data">
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật khách hàng</h1>
                  </div>
               </div>
            </div>
         </section>
         <section class="content">
            <div class="card">
               <div class="card-header text-right">
                  <a href="index.php?option=customer" class="btn btn-sm btn-info">
                     <i class="fa fa-arrow-left" aria-hidden="true"></i>
                     Về danh sách
                  </a>
                  <button class="btn btn-sm btn-success" type="submit" name="CAPNHAT" >
                     <i class="fa fa-save" aria-hidden="true"></i>
                     Lưu
                  </button>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="mb-3">
                           <input type="hidden" name="id" value="<?=$customer->id;?>">
                           <label>Họ tên (*)</label>
                           <input type="text" name="name" value="<?=$customer->name;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Điện thoại</label>
                           <input type="text" name="phone" value="<?=$customer->phone;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Email</label>
                           <input type="text" name="email" value="<?=$customer->email;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Tên đăng nhập</label>
                           <input type="text" name="username" value="<?=$customer->username;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Mật khẩu</label>
                           <input type="password" name="password" value="<?=$customer->password;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Xác nhận mật khẩu</label>
                           <input type="password" name="password_re" value="<?=$customer->password;?>" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-6">
                     <div class="mb-3">
                           <label>Địa chỉ</label>
                           <input type="text" name="address" value="<?=$customer->address;?>" class="form-control">
                        <div class="mb-3">
                        <div class="mb-3">
                           <label>Hình đại diện</label>
                           <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Giới tính</label>
                           <select name="gender" class="form-control">
                              <option value="0" <?=($customer->gender)==0?'selected':'';?>>Nữ</option>
                              <option value="1" <?=($customer->gender)==1?'selected':'';?>>Nam</option>
                           </select>
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1" <?=($customer->status)==1?'selected':'';?>>Xuất bản</option>
                              <option value="2" <?=($customer->status)==2?'selected':'';?>>Chưa xuất bản</option>
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