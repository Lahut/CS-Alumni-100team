<?php 
require __DIR__."/config/database.php";
require __DIR__."/services/util_service.php";
if(!UserService::_IsLoggedIn())
{
    Redirect("login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CS-Alumni</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body id="page-top">
    <style>
        .navbar-nav .nav-item a{
            border-right:1px solid #bbb;
        }
        .navbar-nav .nav-item:last-child a{
            border-right:none;
        }
    </style>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">CS-Alumni</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    
                    <?php if(UserService::_IsAlumni()){ ?>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="home.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="news.php">Post News</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="profile.php">Edit Profile & Password</a>
                    </li>
                    <?php }else if(UserService::_IsAdmin()){ ?>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="index.php">Alumni List</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="import.php">Import Alumni</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="officer.php">Manage Officer</a>
                    </li>
                    <?php }else if(UserService::_IsOfficer()){ ?>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="home.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="news.php">Post News</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="news_category.php">Manage News Category</a>
                    </li>
                    
                    <?php } ?>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="logout.php"><?php echo UserService::UserFullName() ?> (<?php echo UserService::UserType() ?>) - Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section>



