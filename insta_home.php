<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "insta";


$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn,$database);?>

<!DOCTYPE html>

<html>
<head>
<link href="style.css" rel="stylesheet">
</head>

<body>

<script>
function validate()
{

var x=document.myform.password.value;
var y=document.myform.repeatpwd.value;

if(x.length<8)
{
   window.alert("Enter a strong password");
   return false;
}
if(y!=x)
{
  window.alert("Password and confirm password not matched");
  return false;
  }




}
function validate1()
{

var x=document.myform1.password.value;
var y=document.myform1.repeatpwd.value;

if(x.length<8)
{
   window.alert("Enter a strong password");
   return false;
}
if(y!=x)
{
  window.alert("Password and confirm password not matched");
  return false;
  }




}
</script>

<div id="id04" class="modal fade in">
  <div class="modal-dialog">
  <form id="ff" class="modal4-content animate" action="login.php" method="post">
   

    <div>
  <div><img src="pic.png" style="height: 120px;"></div>
    <div style="text-align: center;">  <p>User Login</p>
      <hr>
      <input type="text" placeholder="Enter Username" name="uname" required style = "width:40% ; margin: 10px 0px;"><br>
      <input type="password" placeholder="Enter Password" name="psw" required  style = "width:40% ; margin: 10px 0px;"><br>
       <p align="center"><button type="submit" name="btn" class="signupbtn" value="submit">Log in</button> 
       </p>
    </div>
    </div>
    <p align="center">
    Don't have an account?<a href="insta_reg.php">Sign up</a>
  </p>
  </form>
  </div>
</div>
<script type="text/javascript">
$(window).load(function(){
	$('#id04').modal('fade in');
});
</script>
</body>
</html> 