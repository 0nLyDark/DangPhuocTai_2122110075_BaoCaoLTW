<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Đăng nhập quản trị</title>
   <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
   <style>
    body{
        background-image: url("../public/images/backgroud_admin.jpg");
        background-size: 100%;
    }
    .swapper
    {
        max-width: 500px;
        margin: auto;
        box-shadow: 1px 0px 4px black;
        border-radius: 50px;
        background-color: whitesmoke;
    }
   </style>
    </head>
    <body>
        <?php 
        require_once "../vendor/autoload.php";
        use App\Models\User;
        $error="";
    
        if(isset($_POST['DANGNHAP']))
        {
            $username=$_POST['username'];
            $password=sha1($_POST['password']);
            $args=[
                ['password','=',$password],
                ['roles','=',1],
                ['status','=',1],
            ];
            if (filter_var($username, FILTER_VALIDATE_EMAIL))
            {
                $args[] = ['email','=',$username];
            }
            else
            {
                $args[] = ['username','=',$username];
            }
            $user=User::where($args)->first(); 
            if($user !== null){
                $_SESSION['useradmin']=$username;
                $_SESSION['user_id']=$user->id;
                $_SESSION['name']=$user->name;
                $_SESSION['image']=$user->image;
                header('location:index.php');
            }
            else{
                $error="Tài khoản không hợp lệ !";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="swapper mt-5 p-3">
                <h1 class="text-danger text-center fs-4">Đăng Nhập</h1>
                <div class="mb-3">
                    <label for=""><strong>Tên tài khoản(*)</strong></label>
                    <input class="form-control" type="text" name="username" placeholder="Tên đăng nhập hoặc email" required>
                </div>
                <div class="mb-3">
                    <label><strong>Mật khẩu(*)</strong></label>
                    <input class="form-control" type="password" name="password" placeholder="Mật khẩu" required>
                </div>
                <div class="mb-3 text-end">
                    <input class="btn btn-success" type="submit" value="Đăng nhập" name="DANGNHAP">
                </div>
                <div class="mb-3 ">
                    <?php if($error!=""):?>
                        <p class="text-danger"><?=$error;?></p>
                    <?php endif;?>
                </div>
            </div>
        </form>
    </body>
</html>