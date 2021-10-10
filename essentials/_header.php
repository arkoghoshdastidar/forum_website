<?php
include 'essentials/_login.php';
include 'essentials/_signup.php';
include 'essentials/_dbconnect.php';
if(!isset($_SESSION['loggedin']))
{
    echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<a class="navbar-brand" href="index.php">MyForum</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<li class="nav-item">
<a class="nav-link active" aria-current="page" href="index.php">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="about.php">About</a>
</li>
<li class="nav-item">
<a class="nav-link" href="contact.php">Contact</a>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
Categories
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
$sql="SELECT * FROM `categories`";
$result=mysqli_query($connect,$sql);
while($row=mysqli_fetch_assoc($result))
{
    echo '<li><a class="dropdown-item" href="threadlist.php?ID='.$row['ID'].'">'.$row['TITLE'].'</a></li>';
}
echo'</ul>
</li>
</ul>
<form class="d-flex" action="search.php" method="GET">
<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
<button class="btn btn-outline-success" type="submit">Search</button>
</form>
<form class="d-flex">
<button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#login" type="button">Login</button>
<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signup" type="button">SignUp</button>
</form>
</div>
</div>
</nav>';
}
else
{
    echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<a class="navbar-brand" href="index.php">MyForum</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<li class="nav-item">
<a class="nav-link active" aria-current="page" href="index.php">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="about.php">About</a>
</li>
<li class="nav-item">
<a class="nav-link" href="contact.php">Contact</a>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
Categories
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
$sql="SELECT * FROM `categories`";
$result=mysqli_query($connect,$sql);
while($row=mysqli_fetch_assoc($result))
{
    echo '<li><a class="dropdown-item" href="threadlist.php?ID='.$row['ID'].'">'.$row['TITLE'].'</a></li>';
}
echo'</ul>
</li>
</ul>
<form class="d-flex"  action="search.php" method="GET">
<input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
<button class="btn btn-outline-success" type="submit">Search</button>
</form>
<form class="d-flex">
<button class="btn btn-success"  type="button" style="margin-left:2px;"><a href="logout.php" style="text-decoration:none;" class="text-light " >Logout</a></button>
</form>
</div>
</div>
</nav>';
}
?>