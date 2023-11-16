<?php 
use App\Models\Brand;
use App\Models\Product;
use App\Libraries\Pagination;
$limit=8;
$current=Pagination::pageCurrent();
$offset=Pagination::pageOffset($current,$limit);

$slug=$_REQUEST['cat'];
$brand=Brand::where([['status','=',1],['slug','=',$slug]])->select('id','name')->first();

$list_product=Product::where([['status','=',1],['brand_id','=',$brand->id]])
->skip($offset)
->limit($limit)
->OrderBy('created_at','DESC')->get();
if(isset($_REQUEST['sort']))
{
   if($_REQUEST['sort']=='ASC')
   {
      $list_product=Product::where([['status','=',1],['brand_id','=',$brand->id]])
      ->skip($offset)
      ->limit($limit)
      ->OrderBy('price','ASC')
      ->get();
   }
   if($_REQUEST['sort']=='DESC')
   {
      $list_product=Product::where([['status','=',1],['brand_id','=',$brand->id]])
      ->skip($offset)
      ->limit($limit)
      ->OrderBy('price','DESC')
      ->get();
   }
   if($_REQUEST['sort']=='cu')
   {
      $list_product=Product::where([['status','=',1],['brand_id','=',$brand->id]])
      ->skip($offset)
      ->limit($limit)
      ->OrderBy('created_at','ASC')
      ->get();
   }
}
$title=$brand->name;
$total=Product::where([['status','=',1],['brand_id','=',$brand->id]])->count();
?>

<?php require_once "header.php" ?>
   <section class="bg-light">
      <div class="container">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-2 my-0">
               <li class="breadcrumb-item">
                  <a class="text-main" href="index.php">Trang chủ</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">
                  <?=$brand->name;?>
               </li>
            </ol>
         </nav>
      </div>
   </section>
   <section class="hdl-maincontent py-2">
      <div class="container">
         <div class="row">
            <div class="col-md-3 order-2 order-md-1">
               <?php require_once 'views/frontend/mod-listcategory.php'?>
               <?php require_once 'views/frontend/mod-listbrand.php'?>
               <?php require_once 'views/frontend/mod-product-new.php'?>
            </div>
            <div class="col-md-9 order-1 order-md-2">
               <div class="category-title bg-main">
                  <h3 class="fs-5 py-3 text-center"><?=$brand->name;?></h3>
               </div>
               <div class="product-category mt-3">
                  <div class="text-end pb-4">
                     <label>Sắp xếp theo:</label>
                     <select name="sort" id="sort" onchange="this.options[this.selectedIndex].value && (window.location=this.options[this.selectedIndex].value)" >
                        <option value="index.php?option=brand&cat=<?=$slug;?><?php if(isset($_REQUEST['page'])) echo "&page=".$_REQUEST['page'] ;?>" >Lọc</option>
                        <option value="index.php?option=brand&cat=<?=$slug;?>&sort=ASC<?php if(isset($_REQUEST['page'])) echo "&page=".$_REQUEST['page'] ;?>" 
                        <?=isset($_REQUEST['sort'])&&$_REQUEST['sort']=='ASC'?'selected':"";?>>Giá tăng dần</option>
                        <option value="index.php?option=brand&cat=<?=$slug;?>&sort=DESC<?php if(isset($_REQUEST['page'])) echo "&page=".$_REQUEST['page'] ;?>" 
                        <?=isset($_REQUEST['sort'])&&$_REQUEST['sort']=='DESC'?'selected':"";?>>Giá giảm dần</option>
                        <option value="index.php?option=brand&cat=<?=$slug;?>&sort=moi<?php if(isset($_REQUEST['page'])) echo "&page=".$_REQUEST['page'] ;?>" 
                        <?=isset($_REQUEST['sort'])&&$_REQUEST['sort']=='moi'?'selected':"";?>>Mới -> Cũ</option>
                        <option value="index.php?option=brand&cat=<?=$slug;?>&sort=cu<?php if(isset($_REQUEST['page'])) echo "&page=".$_REQUEST['page'] ;?>" 
                        <?=isset($_REQUEST['sort'])&&$_REQUEST['sort']=='cu'?'selected':"";?>>Cũ -> Mới</option>
                     </select>
                  </div>
                  <div class="row product-list">
                     <?php foreach($list_product as $product):?>
                        <div class="col-6 col-md-3 mb-4">
                           <?php require 'views/frontend/product-item.php'?>
                        </div>
                     <?php endforeach;?>
                     </div>
               </div>
               <?php 
                  if(isset($_REQUEST['sort']))
                  {
                     $url='index.php?option=brand&cat='.$slug.'&sort='.$_REQUEST['sort'];
                  }
                  else
                  {
                     $url='index.php?option=brand&cat='.$slug;
                  }
               ?>
               <?=Pagination::pageLink($total,$current,$limit,$url);?>
            </div>
         </div>
      </div>
   </section>
<?php require_once "footer.php" ?>