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
if($_POST['press']=="Dislike")
{
$sql1=mysqli_query($conn,"update likedblog set liked='0' where user='$nam' and follows='$name' and image_name='$title'");
$affectedRows1 = mysqli_affected_rows($conn);
$sql=mysqli_query($conn,"select * from gallary where name='$name' and image_name='$title'");
$affectedRows = mysqli_affected_rows($conn);
if($affectedRows == 1 && $sql && $affectedRows1 == 1 && $sql1)
{
    	while($row = mysqli_fetch_array($sql))
  {
    $v=$row['likes'];
  }
   $v=$v-1;
    $sql2=mysqli_query($conn,"update gallary set likes='$v' where name='$name' and image_name='$title'");
    if($sql2)
    {
      ?> <script type="text/javascript">
      alert("You disliked '<?php echo $title?>'");
          window.location.href = "insta_login.php";
             </script>;
             <?php
    }
    else
    {
      echo '<script type="text/javascript">
           alert("Error disliking");
          window.location.href = "insta_login.php";
             </script>';
    }}
else
{
    echo '<script type="text/javascript">
           alert("There an error dl");
          window.location.href = "insta_login.php";
             </script>';
}
}
else if ($_POST['press']=="Like") {
  $sql1=mysqli_query($conn,"update likedblog set liked='1' where user='$nam' and follows='$name' and image_name='$title'");
$affectedRows1 = mysqli_affected_rows($conn);
$sql=mysqli_query($conn,"select * from gallary where name='$name' and image_name='$title'");
$affectedRows = mysqli_affected_rows($conn);
if($affectedRows == 1 && $sql && $affectedRows1 == 1 && $sql1)
{
      while($row = mysqli_fetch_array($sql))
  {
    $v=$row['likes'];
  }
   $v=$v+1;
    $sql2=mysqli_query($conn,"update gallary set likes='$v' where name='$name' and image_name='$title'");
    if($sql2)
    {
      
      $note=$nam.' liked your picture "'.$title.'"';
$sqlnew=mysqli_query($conn,"insert into notif(liker,user,image_name,notice) values('$nam','$name','$title','$note')");
$affectedRowsnew = mysqli_affected_rows($conn);
if($affectedRowsnew == 1 && $sqlnew)
{
      ?> <script type="text/javascript">
           alert("You liked '<?php echo $title?>'");
          window.location.href = "insta_login.php";
             </script>;
             <?php
}
else
{
    echo '<script type="text/javascript">
           alert("There an error l");
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
    }}
else
{
    echo '<script type="text/javascript">
           alert("There an error lf");
          window.location.href = "insta_login.php";
             </script>';
}
}
else if ($_POST['press']=="Like1") {
  $sql1=mysqli_query($conn,"insert into likedblog(user,follows,image_name,liked) values ('$nam','$name','$title','1') ");
$affectedRows1 = mysqli_affected_rows($conn);
$sql=mysqli_query($conn,"select * from gallary where name='$name' and image_name='$title'");
$affectedRows = mysqli_affected_rows($conn);
if($affectedRows == 1 && $sql && $affectedRows1 == 1 && $sql1)
{
      while($row = mysqli_fetch_array($sql))
  {
    $v=$row['likes'];
  }
   $v=$v+1;
    $sql2=mysqli_query($conn,"update gallary set likes='$v' where name='$name' and image_name='$title'");
    if($sql2)
    {
      
      $note=$nam.' liked your picture "'.$title.'"';
$sqlnew=mysqli_query($conn,"insert into notif(liker,user,image_name,notice) values('$nam','$name','$title','$note')");
$affectedRowsnew = mysqli_affected_rows($conn);
if($affectedRowsnew == 1 && $sqlnew)
{
      ?> <script type="text/javascript">
           alert("You liked '<?php echo $title?>'");
          window.location.href = "insta_login.php";
             </script>;
             <?php
}
else
{
    echo '<script type="text/javascript">
           alert("There an error last");
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
    }}
else
{
    echo '<script type="text/javascript">
           alert("There an error nl");
          window.location.href = "insta_login.php";
             </script>';
}
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