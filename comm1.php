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
$sql=mysqli_query($conn,"insert into comblog(user,follows,image_name,comments) values ('$nam','$name','$title','$comment') ");
$affectedRows = mysqli_affected_rows($conn);
$sql11=mysqli_query($conn,"select comments from gallary where name='$name' and image_name='$title'");
$affectedRows11 = mysqli_affected_rows($conn);
if($affectedRows == 1 && $sql && $affectedRows11 == 1 && $sql11)
{
    	while($row = mysqli_fetch_array($sql11))
  {
    $v=$row['comments'];
  }
   $v=$v+1;
    $sql1=mysqli_query($conn,"update gallary set comments='$v' where name='$name' and image_name='$title'");
    if($sql1)
    {
      $note=$nam.' commented on your picture "'.$title.'" - " '.$comment.'"';
$sqlnew=mysqli_query($conn,"insert into notif(liker,user,image_name,notice) values('$nam','$name','$title','$note')");
$affectedRowsnew = mysqli_affected_rows($conn);
if($affectedRowsnew == 1 && $sqlnew)
{
      ?> <script type="text/javascript">
           alert("You commented on picture '<?php echo $title?>'");
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
           alert("Error liking");
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