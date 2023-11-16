<?php
use App\Models\Menu;
$mod_footermenu=Menu::where([['status','=',1],['position','=','footermenu']])
->OrderBy('sort_order','ASC')->get();
?>
<h3 class="widgettilte">
   <strong>Liên hệ</strong>
</h3>
<ul class="footer-menu">  
   <?php foreach($mod_footermenu AS $item):?>
      <li><a href="<?=$item->link;?>"><?=$item->name;?></a></li>
   <?php endforeach;?>
</ul>
