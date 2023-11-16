<?php
use App\Models\Category;
$mod_menu_listcategory=Category::where([['status','=',1],['parent_id','=','0']])
->OrderBy('sort_order','ASC')->get();
?>
<div class="dropdown list-category">
   <strong class="dropdown-toggle w-100" data-bs-toggle="dropdown" aria-expanded="false">
      Danh mục sản phẩm
   </strong>
   <ul class="dropdown-menu w-100">
      <?php foreach($mod_menu_listcategory AS $item):?>
         <li><a class="dropdown-item" href="index.php?option=product&cat=<?=$item->slug;?>"><?=$item->name;?></a></li>
      <?php endforeach;?>
   </ul>
</div>