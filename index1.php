<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "insta";
$conn = mysqli_connect($servername, $username, $password);

mysqli_select_db($conn,$database);
$id=$_GET['delpost'];
if($id){
	/*$query = mysqli_query($conn,"delete FROM gallary where id=$id");
	if($query)
	{
		echo '<script type="text/javascript">
           alert("Picture Downloaded");
          window.location.href = "insta_login.php";
             </script>';
	}*/
	$sql=mysqli_query($conn,"select * from gallary where id=$id");
$affectedRows = mysqli_affected_rows($conn);
if($affectedRows == 1 && $sql)
{
    	while($row = mysqli_fetch_array($sql))
  {
    $v=$row['download'];
  }
   $v=$v+1;
    $sql2=mysqli_query($conn,"update gallary set download='$v' where id=$id");
    if($sql2)
    {
    	echo '<script type="text/javascript">
      alert("Download successful");
          window.location.href = "insta_login.php";
             </script>';
    }
    else
    {
      echo '<script type="text/javascript">
           alert("Error Downloading");
          window.location.href = "insta_login.php";
             </script>';
    }}
	else
	{
		echo "no download";
	}
}
else
{
	echo "conn err";
}
?>