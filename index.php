<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "insta";
$conn = mysqli_connect($servername, $username, $password);

mysqli_select_db($conn,$database);
$id=$_GET['delpost'];
if($id){
	$query = mysqli_query($conn,"delete FROM gallary where id=$id");
	if($query)
	{
		echo '<script type="text/javascript">
           alert("Picture Deleted");
          window.location.href = "insta_login.php";
             </script>';
	}
	else
	{
		echo "no delete";
	}
}
else
{
	echo "conn err";
}
?>