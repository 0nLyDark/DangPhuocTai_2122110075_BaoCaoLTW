<?php
use App\Models\Menu;
$mod_mainmenu_item=Menu::where([['status','=','1'],['position','=','mainmenu'],['parent_id','=',$item->id]])
->OrderBy('sort_order','ASC')->get();
?>
<?php if(count($mod_mainmenu_item)>0):?>
<li class="nav-item dropdown menu0">
    <a class="nav-link dropdown-toggle text-white " href="<?=$item->link;?>" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <?=$item->name;?>
    </a>
    <ul class="dropdown-menu menu1">
        <?php foreach($mod_mainmenu_item AS $item1):?>
            <li><a class="dropdown-item menu1-item" href="<?=$item1->link;?>"><?=$item1->name;?></a>
            </li>
        <?php endforeach;?>
    </ul>
</li>
<?php else:?>
    <li class="nav-item">
        <a class="nav-link text-white" href="<?=$item->link;?>"><?=$item->name;?></a>
    </li>
<?php endif;?>