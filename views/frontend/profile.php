<?php

if(isset($_REQUEST['order']))
{
    require_once 'views/frontend/profile-order.php';
}
else
{
    if(isset($_REQUEST['changepassword']))
    {
        require_once 'views/frontend/profile-changepassword.php';
    }
    else
    {
        if(isset($_REQUEST['edit']))
        {
            require_once 'views/frontend/profile-edit.php';
        }
        else
        {
            require_once 'views/frontend/profile-content.php';
        }
    }
}
?>