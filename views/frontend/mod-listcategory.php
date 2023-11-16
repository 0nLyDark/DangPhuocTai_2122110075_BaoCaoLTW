<?php
use App\Models\Category;
$mod_list_category=Category::where([['status','=',1],['parent_id','=',0]])
->OrderBy('sort_order','ASC')
->select('name','slug')->get();

?>
<ul class="list-group mb-3 list-category">
    <li class="list-group-item bg-main py-3">Danh mục sản phẩm</li>
    <li class="list-group-item">
        <a href="index.php?option=product">Tất cả sản phẩm</a>
    </li>
    <?php foreach($mod_list_category as $mod_row_cat):?>
    <li class="list-group-item">
        <a href="index.php?option=product&cat=<?=$mod_row_cat->slug;?>"><?=$mod_row_cat->name;?></a>
    </li>
    <?php endforeach;?>
</ul>
