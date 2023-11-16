<?php 
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
$id=$_REQUEST['id'];
$product = Product::join('category', 'product.category_id', '=', 'category.id')
   ->join('brand', 'product.brand_id', '=', 'brand.id')
    ->where('product.status', '!=', 0)
    ->select(['product.id','product.name','product.slug','product.image','category_id','product.description', 'brand_id','detail',
    'price','pricesale','qty','product.status','category.name AS category_name','brand.name AS brand_name'])
    ->find($id);
$list_category=Category::where('status','!=',0)->orderby('id','DESC')->get();
$list_brand=Brand::where('status','!=',0)->orderby('id','DESC')->get();
if($product==NULL)
{
    header('location:index.php?option=product');
}

?>
<?php require_once "../views/backend/header.php" ?>
      <!-- CONTENT -->
      <form action="index.php?option=product&cat=process" method="post" enctype="multipart/form-data">
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật sản phẩm</h1>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header text-right">
                  <a href="index.php?option=product" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                  </a>
                  <button class="btn btn-sm btn-success" type="submit" name="CAPNHAT">
                     <i class="fa fa-save" aria-hidden="true"></i>
                     Lưu
                  </button>
               </div>
               <div class="card-body">
               <?php require_once '../views/backend/message.php'?>
                  <div class="row">
                     <div class="col-md-8">
                        <div class="mb-3">
                           <input type="hidden" name="id" value="<?=$product->id;?>" >
                           <label>Tên sản phẩm(*)</label>
                           <input type="text" value="<?=$product->name;?>" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text" value="<?=$product->slug;?>" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <input type="text" name="description"  value="<?=$product->description;?>" class="form-control"></input>
                        </div>
                        <div class="row">
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label>Danh mục (*)</label>
                                    <select name="category_id" class="form-control">
                                       <?php foreach($list_category as $item) :?>
                                          <option value="<?=$item->id?>"<?=($item->id==$product->category_id)?'selected':'';?>><?=$item->name?></option>
                                       <?php endforeach ;?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label>Thương hiệu (*)</label>
                                    <select name="brand_id" class="form-control">
                                       <?php foreach($list_brand as $item) :?>
                                          <option value="<?=$item->id?>"<?=($item->id==$product->brand_id)?'selected':'';?>><?=$item->name?></option>
                                       <?php endforeach ;?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3">
                           <label>Chi tiết</label>
                           <textarea name="detail" class="form-control" rows="5" ><?=$product->detail;?></textarea>
                        </div>
                     </div>
                     <div class="col-md-4">
                           <div class="mb-3">
                              <label>Giá bán (*)</label>
                              <input type="number" value="<?=$product->price;?>" min="10000" name="price" class="form-control">
                           </div>
                           <div class="mb-3">
                              <label>Giá sale (*)</label>
                              <input type="number" value="<?=$product->pricesale;?>" min="10000" name="pricesale" class="form-control">
                           </div>
                           <div class="mb-3">
                              <label>Số lượng (*)</label>
                              <input type="number" value="<?=$product->qty;?>" min="0" name="qty" class="form-control">
                           </div>
                           <div class="mb-3">
                              <label>Hình đại diện</label>
                              <input type="file" name="image" class="form-control">
                           </div>
                           <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1" <?=($product->status)==1?'selected':'';?>>Xuất bản</option>
                              <option value="2" <?=($product->status)==2?'selected':'';?>>Chưa xuất bản</option>
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