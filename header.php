<?php include "admin/config.php"; 

    $uri =  $_SERVER['REQUEST_URI']; // get current filename from URL
    $uri_arr = explode('/', $uri);

    $db = new database();
    $page = basename($_SERVER['PHP_SELF']);

    switch($page){
        case "single.php":
            if(isset($_GET['pid'])){
                $db->select('post', '*', null, "id = '{$_GET['pid']}'", null);
                $result2 = $db->getResult();
                $page_title = $result2[0]['title'] ;
            }else{
                $page_title = "No Post Found";
            }
            break;
            case "category.php":
                if(isset($_GET['cid'])){
                    $db->select('category', '*', null, "id = '{$_GET['cid']}'", null);
                    $result2 = $db->getResult();
                    $page_title = $result2[0]['category_name']. " News" ;
                }else{
                    $page_title = "No Post Found";
                }
                break;
                default :
                    $page_title = "News Site";
                break;
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div id="menubar">
    <div class="container">
        <nav class=" navbar-expand-lg navbar-light ">
            <div class="row menu-content">
                <div class="col-md-3">
                    <?php
                       // include "admin/config.php";
                       // $db = new database();
                        $db->select('settings', '*', null, null);
                        $result = $db->getResult();
                        if(count($result) > 0){
                            foreach($result as $row){
                                if($row['logo'] == ""){
                                    echo '<a href="sidebar.php"><h1>'.$row['website_name'].'</h1></a>';
                                }else{
                                    echo '<a href="index.php" id="logo" ><img src="admin/images/'.$row['logo'] . '"></a>' ;
                                }
                            }
                        }
                    ?>
                    <!-- <a class="navbar-brand p-0" href="sidebar.php"><img class="pt-2" style="width: 70%;" src="images/logo.png" alt=""></a> -->
                </div>
                
                    <div class="col-md-6 d-flex">

                        <?php
                            $db->select('category', '*',null, "post > 0", null);
                            $result1 = $db->getResult();
                            if(count($result1) > 0){
                                $active = "";

                        ?>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item menu">
                            <a class="nav-link <?php if($uri_arr[1] == 'index.php') echo 'active'; ?>" aria-current="page" href="index.php">Home</a>
                            </li>
                            <?php 
                                foreach($result1 as $row1){
                                    if(isset($_GET['cid'])){
                                        if($row1['id'] == $_GET['cid']){
                                        $active = "active";
                                    }else{
                                        $active = "";
                                    }
                                }  
                                echo "<li class='nav-item menu'><a class='{$active} nav-link' href='category.php?cid={$row1['id']}'>{$row1['category_name']}</a></li>";  
                                }
                            ?>
                            <!-- <li class="nav-item menu ">
                            <a class="nav-link" href="category.php">Entertainment</a>
                            </li>
                            <li class="nav-item menu">
                            <a class="nav-link" href="category.php">Politics</a>
                            </li>
                            <li class="nav-item menu">
                            <a class="nav-link" href="category.php">Horror</a>
                            </li>
                            <li class="nav-item menu">
                            <a class="nav-link" href="category.php">Health</a>
                            </li> -->
                        </ul>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="d-flex justify-content-end" action="search.php" method="GET">
                            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                    </div>
                
            </div>
        </nav>
    </div>
</div>

