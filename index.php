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
    <div id="carouselExampleIndicators" mt-0 class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slider/1.jpg
" class="d-block w-100" style="height: 500px; width=100%;">
            </div>
            <div class="carousel-item">
                <img src="images/slider/2.jpg" style="height: 500px;width=100%;" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="images/slider/3.jpg" style="height: 500px;width=100%;" class="d-block w-100">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container">
        <p class="text-white  container my-3 bg-dark rounded text-center">CATEGORIES</p>
    </div>
    <div class="container d-flex justify-content-center flex-wrap" style="margin-bottom:50px">
        <?php
          $sql="SELECT * FROM `categories`";
          $result=mysqli_query($connect,$sql);
          while($row=mysqli_fetch_assoc($result))
          {
            $title=$row['TITLE'];
            $description=$row['DESCRIPTION'];
            echo '<div class="row ">
            <div class="col-4 my-1 mx-5">
                <div class="card" style="width: 18rem;">
                    <img src="cardImages/'.$title.'.png"
                        class="card-img-top"  height=250px>
                    <div class="card-body">
                        <h5 class="card-title">'.$title.'</h5>
                        <p class="card-text">'.substr($description,0,150).'...</p>
                        <a href="threadlist.php?ID='.$row['ID'].'" class="btn btn-primary">View thread</a>
                    </div>
                </div>
            </div>
             </div>';
          }
        ?>
    </div>
    <?php
    include 'essentials/_footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>