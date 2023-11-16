<?php
use App\Models\Post;
use App\Models\Topic;
use App\Libraries\Pagination;
use App\Libraries\MyClass;
$limit=3;
$current=Pagination::pageCurrent();
$offset=Pagination::pageOffset($current,$limit);

$topic_post=Topic::where([['status','=',1],['slug','=',$_REQUEST['topic']]])->first();
$list_post=Post::where([['status','=',1],['type','=','post'],['topic_id','=',$topic_post->id]])->skip($offset)->limit($limit)->get();

$title=$topic_post->name;
$total=Post::where([['status','=',1],['type','=','post'],['topic_id','=',$topic_post->id]])->count();
?>
<?php require_once('views/frontend/header.php') ;?>
   <section class="bg-light">
      <div class="container">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-2 my-0">
               <li class="breadcrumb-item">
                  <a class="text-main" href="index.php">Trang chủ</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">
                  Tin tức
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
               <div class="post-topic-title bg-main">
                  <h3 class="fs-5 py-3 text-center">TIN TỨC</h3>
               </div>
               <div class="post-topic mt-3">
               <?php foreach($list_post as $post):?>
                  <div class="row post-item mb-4">
                     <div class="col-4 col-md-4">
                        <div class="post-item-image">
                           <a href="index.php?option=post&slug=<?=$post->slug;?>">
                              <img src="public/images/post/<?=$post->image;?>" style="width: 250px;height: 200px;;" class="img-fluid" alt="<?=$post->image;?>">
                           </a>
                        </div>
                     </div>
                     <div class="col-8 col-md-8">
                        <h2 class="post-item-title fs-5 py-1">
                           <a href="index.php?option=post&slug=<?=$post->slug;?>">
                              <?=$post->title;?>
                           </a>
                        </h2>
                        <p><?=MyClass::word_limit($post->detail,80);?></p>
                     </div>
                  </div>
               <?php endforeach;?>
               </div>
                  <?=Pagination::pageLink($total,$current,$limit,'index.php?option=post&topic='.$_REQUEST['topic']);?>
            </div>
         </div>
      </div>
   </section>
<?php require_once('views/frontend/footer.php') ;?>

