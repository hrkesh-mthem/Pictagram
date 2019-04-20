<?php

$con=mysqli_connect("localhost","root","")or
    die("Could not connect: " . mysql_error());
	session_start();
//Select Database
mysqli_select_db($con,"insta")or
 die("Could not select db: " . mysql_error());
	
if(isset($_POST['uname']) && !empty($_POST['uname'])  && isset($_POST['psw']) && !empty($_POST['psw'])){
  $username=$_POST['uname'];
  $password=$_POST['psw'];
  $btn=$_POST['btn'];
  if($password!=NULL && $username!=NULL)
  {  
    $result=mysqli_query($con,"SELECT name,password FROM login WHERE name='$username' AND password='$password'");
	$i1 = mysqli_num_rows($result);
    if($i1>0)
    {
		$_SESSION["USERNAME"] = $username;
		//echo "Successfully login". $_SESSION["USERNAME"];
	
		header("Location:insta_login.php")or
		die("Could not select db: " . mysql_error());
    }
    else {
      echo '<script type="text/javascript">
           alert("This account does not exist");
          window.location.href = "insta_home.php";
             </script>';
	  
    }
  }
}
else{
	echo '<script type="text/javascript">
           alert("Enter the userid or password");
          window.location.href = "insta_home.php";
             </script>';
	
	
}
?>
<html>
<head>
<script>
  function preventBack(){window.history.forward();}
  setTimeout("preventBack()", 0);
  window.onunload=function(){null};
</script>


</head>
</html>
