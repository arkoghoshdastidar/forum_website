<?php
session_start();
include 'essentials/_dbconnect.php';
//signup code
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $sameUserName=false;
    $incorrectPassword=false;
    if(isset($_POST['signup']))
    {
       $username=$_POST['username'];
       $username=str_replace("<","&lt;",$username);
       $username=str_replace(">","&gt;",$username);
       $username=str_replace("'","''",$username);
       $password=$_POST['password'];
       $password=str_replace("<","&lt;",$password);
       $password=str_replace(">","&gt;",$password);
       $password=str_replace("'","''",$password);
       $rpassword=$_POST['rpassword'];
       $rpassword=str_replace("<","&lt;",$rpassword);
       $rpassword=str_replace(">","&gt;",$rpassword);
       $rpassword=str_replace("'","''",$rpassword);
       $sql="SELECT * FROM `userdetails` WHERE `USERNAME`='$username'";
       $result=mysqli_query($connect,$sql);
       $num_rows_selected=mysqli_num_rows($result);
       if($num_rows_selected==1)
       {
           $sameUserName=true;   
       }
       else
       {
           if($password==$rpassword)
           {
               $hashPassword=password_hash($password,PASSWORD_DEFAULT);
               $sql="INSERT INTO `userdetails`( `USERNAME`, `PASSWORD`) VALUES ('$username','$hashPassword')";
               $result=mysqli_query($connect,$sql);
           }
           else
           {
               $incorrectPassword=true;
           }
       }
   }
}
// login code
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $loginUser=true;
    if(isset($_POST['login']))
    {
        $lusername=$_POST['lusername'];
        $lusername=str_replace("<","&lt;",$lusername);
        $lusername=str_replace(">","&gt;",$lusername);
        $lusername=str_replace("'","''",$lusername);
        $lpassword=$_POST['lpassword'];
        $lpassword=str_replace("<","&lt;",$lpassword);
        $lpassword=str_replace(">","&gt;",$lpassword);
        $lpassword=str_replace("'","''",$lpassword);
        $sql="SELECT * FROM `userdetails` WHERE `USERNAME`='$lusername'";
        $result=mysqli_query($connect,$sql);
        $num=mysqli_num_rows($result);
        if($num==1)
        {
            $row=mysqli_fetch_assoc($result);
            if(password_verify($lpassword,$row['PASSWORD']))
            {
                $loginUser=true;
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$row['USERNAME'];
                header("location:index.php");
            }
            else
            {
                $loginUser=false;
            }
        }
        else
        {
            $loginUser=false;
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>MyForum</title>
</head>

<body>
    <?php
    include 'essentials/_header.php';
    if(isset($sameUserName)){

        if($sameUserName){
            echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Username already present!</strong> Try some other username.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
        }
    }
    if(isset($incorrectPassword)){

        if($incorrectPassword){
            echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Passwords don\'t match!</strong> Re-enter the password correctly.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
        }
    }
    if(isset($incorrectPassword)&&isset($sameUserName)){

        if($incorrectPassword==false&& $sameUserName==false){
            echo('<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Account createrd successfully!</strong>Now login to continue.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
        }
    }
    if(isset($loginUser)){

        if(!$loginUser){
            echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Invalid credentials!</strong>Try to login again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
        }
    }
    ?>
    <div class="container" style="margin-top:20vh;padding:10px;">
        <div class="jumbotron">
            <h1 class="display-4">Hello <?php 
               if(isset($_SESSION['loggedin']))
               {
                   echo $_SESSION['username'];
               }            
               else
               {
                   echo "User";
               }
            ?></h1>
            <p class="lead">
                You can contact the web host through instagram.
            <div class="media">
                <img src="images/instagram.png" class="mr-3" height="50px" width="50px">
                <div class="media-body">
                    <h5 class="mt-0"><a href="https://www.instagram.com/agd_014/" class="text-dark"
                            style="text-decoration:none;">agd_014</a></h5>
                </div>
            </div>
            </p>
            <hr class="my-4">
            <div class="media">
                <p class="lead" style="font-size:20px;">Or you can send him a mail.</p>
                <img src="images/gmail.png" class="mr-3" height="40px" width="40px">
                <div class="media-body">
                    <h5 class="mt-0"><a href="mailto:arkoghosh@gmail.com" class="text-dark"
                            style="text-decoration:none;">arkoghosh@gmail.com</a></h5>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    include 'essentials/_footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>