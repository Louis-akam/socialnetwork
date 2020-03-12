<?php    
 session_start();
 if(isset($_SESSION["id"])){

   header("location:home.php");
}
 $conn=mysqli_connect("localhost","root","","nsrotution");

   if(!$conn){

   	  echo "Unable to Connected";
   }

?>  



<!DOCTYPE html>
<html>
<head>
	<title>NsroTution</title>
</head>
<body>
<!--Start of creating your Form-->

<form action="#" method="POST">
	<input type="text" name="username" placeholder="Enter Username"><br/>
    <input type="password" name="password" placeholder="Enter Password"><br/>
    <input type="submit" value="Sign In" name="Sign-In"><br/>

</form>
<br/>
<br/>

<form action="#" method="POST">
<input type="text" name="username" placeholder="Choose Username"><br/>
<input type="text" name="fname" placeholder="Enter First Name "><br/>
<input type="text" name="lname" placeholder="Enter Last Name "><br/>
<input type="password" name="password" placeholder="Enter Password"><br/>
<input type="password" name="rpassword" placeholder="Repeat Password"><br/>

<input type="submit" value="Sign Up" name="SignUp"><br/>
</form>


</body>
</html>




<?php   
    

    if(isset($_POST["Sign-In"])){
    	$username=$_POST["username"];
    	$pass=$_POST["password"];

     if($username == ""){

         echo "Enter username";

     }else{

      if($pass != ""){
      	
           $enc_pass = md5($pass);
      	  $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'  AND password = '$enc_pass' AND active = 'yes'");
      	    $check = mysqli_num_rows($query);
      	    if($check != 0){
      	    	$fetch = mysqli_fetch_assoc($query); 
      	    	$_SESSION["username"] = $fetch["username"];
      	    	$_SESSION["id"] = $fetch["id"];
      	    	$_SESSION["fname"] = $fetch["fname"];
      	    	$_SESSION["lname"] = $fetch["lname"];
      	    	
      	    	header("location:home.php");


      	    }else{
      	    	echo "username and password does not match;";
      	    }

      }else{

      	echo "enter password";
      }

     }
     
    }
    
    if(isset($_POST["SignUp"])){
    	$username=$_POST["username"];
    	$fname=$_POST["fname"];
        $lname=$_POST["lname"];
        $pass=$_POST["password"];
        $rpass=$_POST["rpassword"];


    if($username != "" AND $pass != "" AND $rpass != "" ) {
    	#To check weather the input pass word is true
      if($rpass === $pass ){

    	$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND active = 'yes'");

    	   $num =  mysqli_num_rows($query);

    	   if($num != 0){
    	   	echo "Already exist";
    	   	
    	   }else{

            #to give an encryted password
    	   	$enc_pass = md5($pass);
     # To insert values into your database
    	   	 mysqli_query($conn, "INSERT INTO users(username, fname , lname , password) VALUES('$username','$fname','$lname','$enc_pass')");

    	   }

     	}
 
     	else{

     		echo "<span style='color:#ff0000;font-weight:bolder;'>Check Password</span>";
     	}

    }  else{

    	echo "<span style='color:#ff0000;font-weight:bolder;'> Please no space should be left empty </span>";	
    }   

    }
        

?>





