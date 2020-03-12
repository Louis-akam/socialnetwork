
<?php 
session_start();

if(!isset($_SESSION["id"])){

   header("location:index.php");
}
$conn=mysqli_connect("localhost","root","","nsrotution"); 
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION["username"]; ?></title>
</head>
<body>
     
  <?php echo $_SESSION["username"];?><br/>
  <?php echo $_SESSION["id"]; ?><br/>
  <?php echo $_SESSION["fname"];?><br/>
  <?php echo $_SESSION["lname"];?><br/>

   <form action="#" method="POST" style="float:right;">
   	<input type="submit" name="Sign-Out" value="Signout">

   </form>
   <?php
   if(isset($_POST["Sign-Out"])){
   	session_destroy();
   	header("location:index.php");
   }
   ?>
   <form action="#" method="POST">
   	<input type="submit" name="Delete" value="Delete">
   </form>
   <?php  
      if(isset($_POST["Delete"])){
      	$ID = $_SESSION["id"];

        mysqli_query($conn, "UPDATE users SET active = 'no' WHERE id = '$ID' ");
             session_destroy();

         }
   ?>
</body>
</html>


	



