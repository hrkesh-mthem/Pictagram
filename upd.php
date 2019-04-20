<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "insta";
session_start();
$conn = mysqli_connect($servername, $username, $password);

mysqli_select_db($conn,$database);
if(isset($_SESSION["USERNAME"])){
$name = $_GET['n'];
$nam=$_SESSION["USERNAME"];
$title= $_GET['t'];
$comment=$_POST['comments'];
$sql=mysqli_query($conn,"update gallary set tags='$comment' where name='$name' and image_name='$title'" );
$affectedRows = mysqli_affected_rows($conn);
if($affectedRows == 1 && $sql)
{
    	?><script type="text/javascript">
           alert("You updated caption of '<?php echo $title?>'");
          window.location.href = "insta_login.php";
             </script>;
             <?php
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