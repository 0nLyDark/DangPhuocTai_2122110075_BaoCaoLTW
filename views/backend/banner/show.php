<?php
use App\Models\Banner;

$id=$_REQUEST['id'];
$banner=Banner::find($id);

if($banner==NULL)
{
    header('location:index.php?option=banner');
}
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Chi Tiết Thuong Hiệu</h1>
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
                     <a href="index.php?option=banner" class="btn btn-sm btn-info">
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
                                 <th>Tên Trường</th>
                                 <th>Giá trị</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <th>ID</th>
                                 <td><?=$banner->id;?></td>
                              </tr>
                              <tr>
                                 <th>Name</th>
                                 <td><?=$banner->name;?></td>
                              </tr>
                              <tr>
                                 <th>Link</th>
                                 <td><?=$banner->link;?></td>
                              </tr>
                              <tr>
                                 <th>Position</th>
                                 <td><?=$banner->position;?></td>
                              </tr>
                              <tr>
                                 <th>Image</th>
                                 <td>
                                    <img  width="125px" height="125px" src="../public/images/banner/<?=$banner->image;?>" alt="<?=$banner->image; ?>">
                                 </td>
                              </tr>
                              <tr>
                                 <th>Sort_order</th>
                                 <td><?=$banner->sort_order;?></td>
                              </tr>
                              <tr>
                                 <th>Created_at</th>
                                 <td><?=$banner->created_at;?></td>
                              </tr>
                              <tr>
                                 <th>Created_by</th>
                                 <td><?=$banner->created_by;?></td>
                              </tr>
                              <tr>
                                 <th>Updated_at</th>
                                 <td><?=$banner->updated_at;?></td>
                              </tr>
                              <tr>
                                 <th>Updated_by</th>
                                 <td><?=$banner->updated_by;?></td>
                              </tr>
                              <tr>
                                 <th>status</th>
                                 <td><?=$banner->status;?></td>
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