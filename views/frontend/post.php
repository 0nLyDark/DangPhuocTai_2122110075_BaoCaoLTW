<?php 

if(isset($_REQUEST['topic']))
{
    require_once 'views/frontend/post-topic.php' ;
}
else
{
    if(isset($_REQUEST['slug']))
    {
        require_once 'views/frontend/post-detail.php' ;
    }
    else
    {
        require_once 'views/frontend/post-content.php' ;
    }
}