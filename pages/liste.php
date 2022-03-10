<?php

include 'connexion.php';
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

if(isset($_GET["deleteid"]) ){

  $id = $_GET["deleteid"];
  $sql = "DELETE FROM produits WHERE id_p = $id";
  
  
      if (mysqli_query($link,$sql)) {
      
        header("location: liste.php?success delete!!");
        
      }else{
        header("location: liste.php? not success delete !!");
      }
  
  
  
 
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/product.css">
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
            <div class="sidebar__link active_menu_link">
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
                        <h1>Lists of products</h1>
                        <p>For more infos about products</p>
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
                <div class="">


                    <?php

              $sql="SELECT * FROM produits";
              $result=mysqli_query($link,$sql);
              
              if($result){

                if(mysqli_num_rows($result) > 0){
                  
                  echo '<table id="customers">';
                  echo "<thead>";
                  echo "<tr>";
                  echo "<th>Id </th>"; 
                  echo "<th>Reference </th>";
                  echo "<th>Nom </th>";
                  echo "<th>Descriptions </th>";
                  echo "<th>prix </th>";
                  echo "<th>Qte </th>";
                  echo "<th>Categorie </th>";
                  echo "<th>Image </th>";
                  echo '<th>Mise à jour </th>';
                  echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";

                

                while($row = mysqli_fetch_array($result)){  
                  // print_r($row);
                  echo "<tr>";
                  $id=$row['id_p'];
                  $referencespr=$row['reference'];
                  $namepr=$row['nom'];
                  $decriptionpr=$row['descriptions'];
                  $pricepr=$row['prix'];
                  $qtepr=$row['quantite'];
                  $catepr=$row['categorie'];
                  $newNmae=$row['images'];


                  echo "<td>".$id."</td>";
                  echo "<td>".$referencespr."</td>";
                  echo "<td>".$namepr."</td>";
                  echo "<td>".$decriptionpr."</td>";
                  echo "<td>".$pricepr."</td>";
                  echo "<td>".$qtepr."</td>";
                  echo "<td>".$catepr."</td>";
                  echo '<td><img src="../images/'.$newNmae.'" width="50" height="50"></td>';
                  echo "<td>";
                  echo '<pre><a href="? deleteid='.$row['id_p'].'" style="text-decoration:none"><button name="delete" class="delete">Delete </button> </a></pre>
                  ';
                  echo '<pre><a href="update.php?updateid='.$row['id_p'].'" style="text-decoration:none"><button class="update">Update</button> </a></pre>
                  ';
      
                  echo "</td>";
                  echo "</tr>";
                 
                }

                echo "</tbody>";                            
                echo "</table>";
                
              }

              else {
            //    echo $login_err;
               echo "<h3 style='margin-top: 30px'>you cont have any data</h3>";
              }
            }

              ?>
                </div>
            </div>
            <!-- end of main cards -->
    </div>
    </main>


    </div>
        
    <!-- navbar -->
    
    </div>

</body>

</html>