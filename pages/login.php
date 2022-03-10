<?php
session_start() ;
include 'connexion.php';

if(isset($_POST['LOGIN']))
{
    $sql=mysqli_query($conn,"SELECT * FROM list where username = '". $_POST['user_name'] ."' AND  password='". $_POST['pass_word'] ."' ");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {

        // $_SESSION["ID"] = $row['id'];
         $_SESSION["Name"]=$row['username'];
        // $_SESSION["Mpass"]=$row['password']; 
        // header("Location:dashboard.php"); 
    }
    else
    {
        echo "Invalid Email ID/Password";
    }
}

?>

