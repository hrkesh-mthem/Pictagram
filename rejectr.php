<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "insta";
session_start();
$conn = mysqli_connect($servername, $username, $password);

mysqli_select_db($conn,$database);
if(isset($_SESSION["USERNAME"])){
$me =$_SESSION["USERNAME"];
$name = $_GET['n1'];
$sql=mysqli_query($conn,"select * from follow where user='$name' and follows='$me' and sent='1' and accepted='0'");
$affectedRows = mysqli_affected_rows($conn);
if($affectedRows == 1 && $sql)
{
    $sql1=mysqli_query($conn,"update follow set sent='0' where user='$name' and follows='$me' and sent='1'");
    if($sql1)
    {
    	echo '<script type="text/javascript">
           alert("Permission request has been rejected");
          window.location.href = "insta_login.php";
             </script>';
    }
    else
    {
    	echo '<script type="text/javascript">
           alert("Error accepting the request");
          window.location.href = "insta_login.php";
             </script>';
    }
}
else
{
    echo '<script type="text/javascript">
           alert("There an error");
          window.location.href = "insta_login.php";
             </script>';
}
}
else
{
  echo '<script type="text/javascript">
           alert("Session error");
          window.location.href = "insta_login.php";
             </script>';
}
?>