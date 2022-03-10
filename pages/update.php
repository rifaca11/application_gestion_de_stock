<?php

 include 'connexion.php';
 session_start();
 
 // Check if the user is logged in, if not then redirect him to login page
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     header("location: index.php");
     exit;
 }

  $id=$_GET["updateid"];
 $sql="SELECT * FROM produits where id_p like $id";
 $result=mysqli_query($link,$sql);
 
 if($result){

  if(mysqli_num_rows($result) > 0){
    
  while($row = mysqli_fetch_assoc($result)){  
    // print_r($row);
    $id=$row['id_p'];
    $referencespr=$row['reference'];
    $namepr=$row['nom'];
    $decriptionpr=$row['descriptions'];
    $pricepr=$row['prix'];
    $qtepr=$row['quantite'];
    $catepr=$row['categorie'];
    $newNmae=$row['images'];


  }
 }
}



 if($_SERVER['REQUEST_METHOD']=="POST"){
 if(!empty($_GET["updateid"]) && !empty($_POST['referPr']) &&  !empty($_POST['namePr']) &&  !empty($_POST['descrPr']) &&  !empty($_POST['pricePr']) &&  !empty($_POST['pricePr']) &&  !empty($_POST['qtePr']) &&  !empty($_POST['catPr']))
 {

    $referencespr = $_POST['referPr'];
    $namepr = $_POST['namePr'];
    $decriptionpr = $_POST['descrPr'];
    $pricepr = $_POST['pricePr'];
    $qtepr = $_POST['qtePr'];
    $catepr = $_POST['catPr'];
    
    // file properties
    $name=$_FILES["file"]["name"];
    if(!empty($name)){

      $file=$_FILES["file"]["tmp_name"];
      $extention=explode(".",$name);
      $newNmae=uniqid()."images".".".$extention[1];
      $fileUpload="../images/".$newNmae;

      move_uploaded_file($file,$fileUpload);

      // __


       $sqll=("SELECT * FROM produits WHERE id_p=$id");
       $resultt=mysqli_query($link,$sqll);
       $query=mysqli_fetch_assoc($resultt);
    //    if(!empty($query['images'])){
         unlink("../images/".$query['images']);
         }
         
   
    $sql = "UPDATE produits SET reference='$referencespr', nom='$namepr',descriptions='$decriptionpr',
    prix=$pricepr,quantite=$qtepr,categorie='$catepr', images='$newNmae'  WHERE id_p = $id";

    $result=mysqli_query($link,$sql);
    if($result){
      header("location: liste.php");
    }
    else{
      $login_err="invalid to update";
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

    <main style="width: 100%; height:100%">

            <div class="main__container">
                <!-- main title -->
                <div class="main__title">
                    <img src="../images/hello.svg" alt="" />
                    <div class="main__greeting">
                        <h1>Update your product</h1>
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
                                name="referPr" <?php echo "value=".$referencespr; ?> >
                        </div>

                        <div class="cont">
                            <label> Name :</label>
                            <input class="inp" type="text" id="nameP" placeholder="  Enter your product" name="namePr"
                                <?php echo "value=".$namepr; ?>>
                        </div>

                        <div class="cont">
                            <label> Description :</label>
                            <input <?php echo 'value='.$decriptionpr; ?>
                                style="padding-top:15px;width:100%; height: 40px; border: none;border-radius: 5px; font-size:14px; font-family:Lato,'sans-serif';"
                                id="descr" placeholder="Describe your product" name="descrPr"
                                <?php echo "value=".$decriptionpr; ?>>
                            <!-- </textarea> -->
                        </div>

                        <div class="cont">
                            <label> Prix :</label>
                            <input class="inp" type="number" id="prix" placeholder="  Enter price" name="pricePr"
                                <?php echo "value=".$pricepr; ?>>
                        </div>

                        <div class="cont">
                            <label> Quantity :</label>
                            <input class="inp" type="number" id="qte" placeholder="  Enter the quantity" name="qtePr"
                                <?php echo "value=".$qtepr; ?>>
                        </div>

                        <div class="cont">
                            <label> categorie :</label>
                            <input class="inp" type="text" id="cat" placeholder="  Enter the categorie" name="catPr"
                                <?php echo "value=".$catepr; ?>>
                        </div>

                        <div class="cont">
                            <label> image :</label>
                            <input class="inp" accept="image/*" type="file" id="img" placeholder="  Choose image"
                                name="file" <?php echo "value=".$newNmae; ?>>
                        </div>

                        <div class="butt_cont">
                            <button type="submit" class="btn" style="text-decoration:none;margin-top:-30px;">Update Product</button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- end of main cards -->
    </div>
    </main>
    <!-- navbar -->
    
    </div>

</body>

</html>