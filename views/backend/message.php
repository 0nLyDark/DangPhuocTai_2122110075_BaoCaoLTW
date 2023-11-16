<?php 
use App\Libraries\MyClass;
?>
<?php if(MyClass::has_flash('message')):?>
    <?php $arr=MyClass::get_flash('message');?>
    <div class="alert alert-<?=$arr['type'];?> text-center">
        <?=$arr['msg'];?>
    </div>
<?php endif;?>