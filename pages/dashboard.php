<?php
include 'connexion.php';
 
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$query = "SELECT count(*) FROM produits";
$qresult = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($qresult);
$count = $row["count(*)"];

$queryy = "SELECT SUM(quantite) FROM produits";
$qresultt = mysqli_query($link, $queryy);
$roww = mysqli_fetch_assoc($qresultt);
$countt = $roww["SUM(quantite)"];



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- font awesome -->
    <link rel="stylesheet" href="../css/dash.css" />
    <title>DASHBOARD</title>
    <!-- line chart -->

</head>

<body id="body">
    <div class="">
        <nav class="navbar">
            <div class="nav_icon" >
            <button class="btn-togglre" onclick="myFunction()">Menu</button>
            </div>
            
            <script>
                function myFunction() {
                var element = document.getElementById("sidebar");
                element.classList.toggle("sidebarTogle");
                }
            </script>

            <div class="navbar__left">
                <a class="active_link" href="#">Admin</a>
            </div>
            <div class="navbar__right">
                <a href="#">
                    <div class="sidebar__logout">
                        <a href="logout.php">Log out</a>
                    </div>
                </a>
            </div>
        </nav>

       <div style="display: flex;">
            
        <div id="sidebar">
        <div class="sidebar__title">
            <div class="sidebar__img">
                <h1>ShopNow</h1>
            </div>
            <i onclick="closeSidebar()" class="fa fa-times" id="sidebarIcon" aria-hidden="true"></i>
        </div>

        <div class="sidebar__menu">
            <div class="sidebar__link active_menu_link">
                <a href="dashboard.php">Dashboard</a>
            </div>
            <!-- <h2>Manage</h2> -->
            <div class="sidebar__link">
                <a href="adminManage.php">Admin Management</a>
            </div>
            <div class="sidebar__link">
                <a href="liste.php">List of products</a>
            </div>
            <div class="sidebar__link">
                <a href="create.php">Create products</a>
            </div>

        </div>
    </div>

        <main style="width: 100%;">
            <div class="main__container">
                <!-- main title -->

                <div class="main__title">
                    <img src="../images/hello.svg" alt="" />
                    <div class="main__greeting">
                        <h1>Welcome <b
                                style=" color:#FB7600 ; margin-left:5px; margin-right:5px;"><?php echo htmlspecialchars($_SESSION["username"]); ?></b>
                            to ShopNow</h1>
                        <p>The statistics in our application</p>
                    </div>
                </div>

                <!-- end main title -->

                <!-- main cards -->
                <div class="main__cards">
                    <div class="card">
                        <img src="../images/package.png" alt="" class="ic">
                        <div class="card_inner">
                            <p class="text-primary-p">Number of all products</p>
                            <span class="font-bold text-title"><?php echo $count; ?></span>
                        </div>
                    </div>

                    <div class="card">
                        <img src="../images/categorie.png" alt="" class="ic">
                        <div class="card_inner">
                            <p class="text-primary-p">number of <br> categories</p>
                            <span class="font-bold text-title"><?php echo $count; ?></span>
                        </div>
                    </div>

                    <div class="card">
                        <img src="../images/stock.png" alt="" class="ic">
                        <div class="card_inner">
                            <p class="text-primary-p">Quantity of stock</p>
                            <span class="font-bold text-title"><?php echo $countt; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of main cards -->

          
        </main>
       </div>
    <!-- navbar -->
    
    </div>


</body>

</html>