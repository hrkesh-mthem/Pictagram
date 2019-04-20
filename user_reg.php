<html>

<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


mysqli_select_db($conn,"insta");

$pass = $_POST['psw'];
$uname = $_POST['uname'];
$fname = $_POST['fname'];
$email = $_POST['email'];
$result1=mysqli_query($conn,"SELECT * FROM login WHERE name='$uname'");
$affectedRows1 = mysqli_affected_rows($conn);
$result=mysqli_query($conn,"SELECT * FROM login WHERE email='$email'");
$affectedRows = mysqli_affected_rows($conn);
if(($affectedRows1 == 1 && $result1) || ($affectedRows == 1 && $result)){
    if($affectedRows1 == 1 && $result1)
    {
		echo '<script type="text/javascript">
           alert("Username is already Taken!!!");
          window.location.href = "insta_reg.php";
             </script>';
	
    }
	if($affectedRows == 1 && $result){
		echo '<script type="text/javascript">
           alert("Email is already Registered !!!");
          window.location.href = "insta_reg.php";
             </script>';
         }	
     }
else{    
if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
    echo '<script type="text/javascript">
           alert("The email you have entered is invalid, please try again.");
          window.location.href = "insta_reg.php";
             </script>';
}else{
    // Return Success - Valid Email
     $sql = "INSERT INTO login (fname,name, email ,password,sent,accepted)   
         VALUES ('$fname','$uname','$email','$pass','0','0')";
	   if ($conn->query($sql) === TRUE) {
echo '<script type="text/javascript">
           alert("Account registered successfully...You can now Log in");
          window.location.href = "insta_home.php";
             </script>';
           }
           else
           {
            echo '<script type="text/javascript">
           alert("Account not registered");
          window.location.href = "insta_reg.php";
             </script>';
           }
}
	}
?>

</html>