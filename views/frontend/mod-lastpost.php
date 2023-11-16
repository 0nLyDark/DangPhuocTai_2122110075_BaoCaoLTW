<?php 
use App\Models\Post;
use App\Libraries\MyClass;
$post=Post::where([['status','=',1],['type','=','post']])->OrderBy('created_at','DESC')->first();
if($post)
{
   $list_post=Post::where([['status','=',1],['type','=','post'],['id','!=',$post->id]])->OrderBy('created_at','DESC')->limit(3)->get();
}
?>
<section class="hdl-lastpost bg-main mt-3 py-4">
      <div class="container">
         <div class="row">
            <div class="col-md-9">
               <h3>BÀI VIẾT MỚI</h3>
               <div class="row">
                  <?php if(isset($post)):?>
                     <div class="col-md-6">
                        <a href="index.php?option=post&slug=<?=$post->slug;?>">
                           <img class="img-fluid" src="public/images/post/<?=$post->image;?>" style="width: 500px;height:300px" />
                        </a>
                        <h3 class="post-title fs-4 py-2">
                           <a href="index.php?option=post&slug=<?=$post->slug;?>">
                              <?=$post->title;?>
                           </a>
                        </h3>
                        <p><?=MyClass::word_limit($post->detail,50);?></p>
                     </div>
                     <?php if(count($list_post)>0):?>
                     <div class="col-md-6">
                        <?php foreach($list_post as $item):?>
                           <div class="row mb-3">
                           <div class="col-md-4">
                              <a href="index.php?option=post&slug=<?=$item->slug;?>">
                                 <img class="img-fluid" src="public/images/post/<?=$item->image;?>" style="width: 150px;height:125px" />
                              </a>
                           </div>
                           <div class="col-md-8">
                              <h3 class="post-title fs-5">
                                 <a href="index.php?option=post&slug=<?=$item->slug;?>">
                                    <?=$item->title;?>
                                 </a>
                              </h3>
                              <p><?=MyClass::word_limit($item->detail,25);?></p>
                           </div>
                        </div>
                        <?php endforeach;?>
                     </div>
                     <?php endif;?>
                  <?php endif;?>
               </div>
            </div>
            <div class="col-md-3">FACEBOOK</div>
         </div>
      </div>
   </section>