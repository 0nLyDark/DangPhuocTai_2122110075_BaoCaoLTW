<?php
use App\Models\contact;
$id=$_REQUEST['id'];

$contact=contact::find($id);
if($contact==NULL)
{
    header('location:index.php?option=contact');
}
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <form action="index.php?option=contact&cat=process" method="post" enctype="multipart/form-data">
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật liên hệ</h1>
                  </div>
               </div>
            </div>
         </section>
         <section class="content">
            <div class="card">
               <div class="card-header text-right">
                  <a href="index.php?option=contact" class="btn btn-sm btn-info">
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
                           <input type="hidden" name="id" value="<?=$contact->id;?>">
                           <label>Họ tên (*)</label>
                           <input type="text" name="name" value="<?=$contact->name;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Điện thoại</label>
                           <input type="text" name="phone" value="<?=$contact->phone;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Email</label>
                           <input type="text" name="email" value="<?=$contact->email;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Tiêu đề (*)</label>
                           <input type="text" name="title" value="<?=$contact->title;?>" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Chi tiết (*)</label>
                           <textarea name="content" rows="5" class="form-control"><?=$contact->content;?></textarea>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1" <?=($contact->status)==1?'selected':'';?>>Xuất bản</option>
                              <option value="2" <?=($contact->status)==2?'selected':'';?>>Chưa xuất bản</option>
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