<?php

include 'connexion.php';

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
if($_SERVER['REQUEST_METHOD']=="POST"){
if (!empty($_POST['referPr']) && !empty($_POST['namePr'])  && !empty($_POST['descrPr']) && !empty($_POST['pricePr']) && !empty($_POST['pricePr']) && !empty($_POST['qtePr']) && !empty($_POST['catPr']) && !empty($_FILES['file']['name'])) {

  $referencespr = $_POST['referPr'];
  $namepr = $_POST['namePr'];
  $decriptionpr = $_POST['descrPr'];
  $pricepr = $_POST['pricePr'];
  $qtepr = $_POST['qtePr'];
  $catepr = $_POST['catPr'];

  // file properties
  $file = $_FILES["file"]["tmp_name"];
  $name = $_FILES["file"]["name"];
  $extention = explode(".", $name);
  $newNmae = uniqid() ."images".".". $extention[1];
  $fileUpload = "../images/".$newNmae;
  move_uploaded_file($file, $fileUpload);


  $sql = "INSERT INTO produits (reference,nom,descriptions,prix,quantite,categorie,images) VALUES
    ('$referencespr','$namepr','$decriptionpr','$pricepr','$qtepr','$catepr','$newNmae')";

  $result = mysqli_query($link, $sql);

  if ($result) {
    header("location: liste.php");
  }
}
else{
  $login_err="Please enter your data ";
}

}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/dash.css" />
    <title>DASHBOARD</title>
    <style>
    </style>


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
            <div class="sidebar__link ">
                <a href="dashboard.php">Dashboard</a>
            </div>
            <!-- <h2>Manage</h2> -->
            <div class="sidebar__link">
                <a href="adminManage.php">Admin Management</a>
            </div>
            <div class="sidebar__link">
                <a href="liste.php">List of products</a>
            </div>
            <div class="sidebar__link active_menu_link">
                <a href="create.php">Create products</a>
            </div>

        </div>
    </div>

    <main style="width: 100%; height:100%">

            <div class="main__container">
                <!-- main title -->
                <div class="main__title">
                    <img src="../images/hello.svg" alt="" />
                    <div class="main__greeting">
                        <h1>Create some products</h1>
                        <p>Insert the infos of products</p>
                    </div>
                </div>
                <!-- end main title -->
                <!-- main cards -->
                <?php  
           if(!empty($login_err)){
            echo '<div style="padding: 20px;
            background-color: #f44336;
            color: white;">' . $login_err . '</div>';
        }        
        ?>
                <div class="form_container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="cont">
                            <label> Reference :</label>
                            <input class="refer" type="text" id="referP" placeholder="  Enter your reference"
                                name="referPr">
                        </div>

                        <div class="cont">
                            <label> Name :</label>
                            <input class="inp" type="text" id="nameP" placeholder="  Enter your product" name="namePr"
                                >
                        </div>

                        <div class="cont">
                            <label> Description :</label>
                            <input
                             id="descr" placeholder="  Describe your product" name="descrPr" >
                        </div>

                        <div class="cont">
                            <label> Prix :</label>
                            <input class="inp" type="number" id="prix" placeholder="  Enter price" name="pricePr"
                                >
                        </div>

                        <div class="cont">
                            <label> Quantity :</label>
                            <input class="inp" type="number" id="qte" placeholder="  Enter the quantity" name="qtePr"
                                >
                        </div>

                        <div class="cont">
                            <label> categorie :</label>
                            <input class="inp" type="text" id="cat" placeholder="  Enter the categorie" name="catPr"
                                >
                        </div>

                        <div class="cont">
                            <label> image :</label>
                            <input class="inp" accept="image/*" type="file" id="img" placeholder="  Choose image"
                                name="file" >
                        </div>

                        <div class="butt_cont">
                            <button type="submit" name="submit" class="btn">Create Product</button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- end of main cards -->
    </div>
    </main>


    </div>
        
  
    </div>

</body>

</html>