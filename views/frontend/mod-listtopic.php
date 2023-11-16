<?php

use App\Models\Topic;

$list_topic=Topic::where('status','=',1)->get();

?>
<ul class="list-group mb-3 list-brand">
    <li class="list-group-item bg-main py-3">Danh mục chủ đề </li>
    <?php foreach($list_topic as $topic):?>
    <li class="list-group-item">
        <a href="index.php?option=post&topic=<?=$topic->slug;?>"><?=$topic->name;?></a>
    </li>
    <?php endforeach;?>
</ul>
