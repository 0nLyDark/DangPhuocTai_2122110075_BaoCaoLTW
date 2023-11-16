<?php
use App\Models\Post;
$slug=$_REQUEST['slug'];
$post=Post::where([['status','=',1],['type','=','post'],['slug','=',$slug]])->first();

$title=$post->title;
$list_post=Post::where([['status','=',1],['type','=','post'],['id','!=',$post->id],['topic_id','=',$post->topic_id]])->get();
?>
<?php require_once "header.php" ?>
<section class="bg-light">
      <div class="container">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-2 my-0">
               <li class="breadcrumb-item">
                  <a class="text-main" href="index.html">Trang chủ</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">
                  Chi tiết bài viết
               </li>
            </ol>
         </nav>
      </div>
   </section>
   <section class="hdl-maincontent py-2">
      <div class="container">
         <div class="row">
            <div class="col-md-3 order-2 order-md-1">
               <?php require_once 'views/frontend/mod-listtopic.php';?>
            </div>
            <div class="col-md-9 order-1 order-md-2">
               <h1 class="fs-2 text-main"><?=$post->title;?></h1>

               <p>
               <?=$post->detail;?>
               </p>
               <h3 class="fs-4 text-main">
                  <strong>Bài viết khác</strong>
               </h3>
               <ul class="post-list-other">
                  <?php foreach($list_post as $item):?>
                     <li><a href="index.php?option=post&slug=<?=$item->slug;?>" class="fs-5 text-info" style="text-decoration-line:none;" >
                     <?=$item->title;?></a></li>
                  <?php endforeach;?>
               </ul>
            </div>
         </div>
      </div>
   </section>
<?php require_once "footer.php" ?>