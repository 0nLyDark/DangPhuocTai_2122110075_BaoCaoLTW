<?php
use App\Models\Post;
$slug=$_REQUEST['cat'];
$page=Post::where([['status','=',1],['type','=','page'],['slug','=',$slug]])->first();
$title=$page->title;
$list_page=Post::where([['status','=',1],['type','=','page'],['id','!=',$page->id]])->limit(10)->get();

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
                  Trang đơn
               </li>
            </ol>
         </nav>
      </div>
   </section>
   <section class="hdl-maincontent py-2">
      <div class="container">
         <div class="row">
            <div class="col-md-3 order-2 order-md-1">
               <ul class="list-group mb-3 list-page">
                  <li class="list-group-item bg-main py-3">Các trang khác</li>
                  <?php foreach($list_page AS $item):?>
                     <li class="list-group-item">
                        <a href="index.php?option=page&cat=<?=$item->slug;?>"><?=$item->title;?></a>
                     </li>
                  <?php endforeach;?>
               </ul>
            </div>
            <div class="col-md-9 order-1 order-md-2">
               <h1 class="fs-2 text-main"><?=$page->title;?></h1>
               <p><?=$page->detail;?></p>
<!--                 <img width="125px" height="125px" src="public/images/post/<?=$page->image;?>" alt="<?=$item->image;?>"> 
 -->            </div>
         </div>
      </div>
   </section>
<?php require_once "footer.php" ?>