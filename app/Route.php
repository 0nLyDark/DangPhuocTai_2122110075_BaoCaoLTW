<?php
class Route
{
        public static function route_site()
        {
            $path_View = "views/frontend/";
            if(isset($_REQUEST['option']))
            {
                $path_View.=$_REQUEST['option'];
                if(isset($_REQUEST['slug']))
                {
                    $path_View.="-detail.php";
                }
                else{
                    if(isset($_REQUEST['cat']))
                    {
                        $path_View.="-category.php";
                    }
                    else
                    {
                        $path_View.=".php";
                    }
                }
            }
            else
            {
                $path_View.="home.php";
            }
            require_once $path_View;
        }
        public static function route_admin()
        {
            $path_View="../views/backend/";
            if(isset($_REQUEST["option"]))
            {
                $path_View.=$_REQUEST["option"]."/";
                if(isset($_REQUEST["cat"]))
                {
                    $path_View.=$_REQUEST["cat"].".php";
                }
                else
                {
                    $path_View.="index.php";
                }
            }
            else
            {
                $path_View.="dashboard/index.php";
            }
            require_once $path_View;
        }
}