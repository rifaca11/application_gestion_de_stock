<?php
      // error_reporting(0);
      include 'connexion.php';
      session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
      // $id=$_GET['updateid'];
$sql="SELECT * FROM users WHERE role like 'client' ";

      $result=mysqli_query($link,$sql);
      $row=mysqli_fetch_assoc($result);
      // print_r($row);
      $id=$row['id'];
      $username=$row['username'];
      $email=$row['email'];
      $password=$row['password'];


if($_SERVER['REQUEST_METHOD']=="POST"){

    $oldpass = $_POST["password"];
   
        if(password_verify($oldpass,$password)){
            
                $username=$_POST['user_name'];
                $newPassword=$_POST['Cpassword'];
            
            $sql="UPDATE users SET username='$username', password='$newPassword' WHERE id=$id ";
            
            
            // Redirect user to dashboard page
            header("location: dashboard.php");
        } else{
            // Password is not valid, display a generic error message
            $login_err = "Invalid password.";
            
        }

    }







?>