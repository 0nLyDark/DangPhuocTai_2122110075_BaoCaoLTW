
<?php
use App\Models\Product;

$list = Product::join('category', 'product.category_id', '=', 'category.id')
   ->join('brand', 'product.brand_id', '=', 'brand.id')
    ->where('product.status', '=', 0)
    ->select(['product.id','product.name','product.image', 'category.name AS category_name','brand.name AS brand_name'])
    ->get();
$cout_all=Product::where('status','!=',0)->count();
$cout_trash=Product::where('status','=',0)->count(); 
   
?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <form action="" method="post">
         <div class="content-wrapper">
            <section class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-12">
                        <h1 class="d-inline">Tất cả sản phẩm</h1>
                        <a href="index.php?option=product&cat=create" class="btn btn-sm btn-primary">Thêm sản phẩm</a>
                     </div>
                  </div>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="card">
                  <div class="card-header">
                  <div class="row">
                     <div class="col-md-6">
                        <a href="index.php?option=product">Tất cả (<?=$cout_all;?>)</a> |
                        <a href="index.php?option=product&cat=trash">Thùng rác (<?=$cout_trash;?>)</a>
                     </div>
                     <div class="col-md-6 text-right">
                        <button class="btn btn-sm btn-success" type="submit" name="THEM">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Lưu
                        </button>
                     </div>
                  </div>
                  </div>
                  <div class="card-body">
                  <?php require_once '../views/backend/message.php'?>
                     <table class="table table-bordered" id="mytable">
                        <thead>
                           <tr>
                              <th class="text-center" style="width:30px;">
                                 <input type="checkbox">
                              </th>
                              <th class="text-center" style="width:130px;">Hình ảnh</th>
                              <th>Tên sản phẩm</th>
                              <th>Tên danh mục</th>
                              <th>Tên thương hiệu</th>
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
                                 <img width="125px" height="125px" src="../public/images/product/<?= $item->image; ?>" alt="<?= $item->image; ?>">
                              </td>
                              <td>
                                 <div class="name">
                                 <?= $item->name; ?>
                                 </div>
                                 <div class="function_style">
                                    <a class ="btn btn-primary btn-xs" href="index.php?option=product&cat=restore&id=<?=$item->id ;?>">
                                    <i class="fas fa-undo"></i>Khôi phục</a> |
                                    <a class ="btn btn-danger btn-xs" href="index.php?option=product&cat=destroy&id=<?=$item->id ;?>">
                                    <i class="fas fa-trash"></i>Xoá vĩnh viễn</a>
                                 </div>
                              </td>
                              <td>
                                 <?=$item->category_name ?>
                              </td>
                              <td>
                                 <?=$item->brand_name ?>
                              </td>
                           </tr>
                           <?php endforeach; ?>
                           <?php endif; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </section>
         </div>
      </form>
      <!-- END CONTENT-->
<?php require_once "../views/backend/footer.php" ?>