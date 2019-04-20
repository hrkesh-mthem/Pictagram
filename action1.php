<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "insta";
session_start();

$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn,$database);


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['file']["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_SESSION["USERNAME"])){
$user_name = $_SESSION["USERNAME"];
if(isset($_FILES['file']['name']))
{
	if(!empty($_FILES['file']['name']))
	{
		$name = $_FILES['file']['name'];
		$image_name = addslashes($_FILES['file']['name']);
		$size = $_FILES['file']['size'];
		$max_size = 2097152;
		
		$type = $_FILES['file']['type'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$location = 'uploads/';
		
		
		$offset = 0;
		while($strpos = strpos($name, '.', $offset))
		{
			$offset = $strpos + 1;
			$extension = strtolower(substr($name, $offset));
		}
		if(($imageFileType == 'jpg' || $imageFileType == 'png' || $imageFileType == 'jpeg'  )&&($imageFileType=='jpeg'|| $imageFileType=='jpg' || $imageFileType=='png' )&& ($size<=$max_size))
		{
			$sql1=mysqli_query($conn,"select name from login where name='$user_name' and sent='1' and accepted='1'");
$affectedRows1 = mysqli_affected_rows($conn);
	if($affectedRows1 == 1 && $sql1)
	{
		$yas = move_uploaded_file($tmp_name, 'uploads/'.$name);
		if($yas)
		{
				$file_to_saved = "uploads/".$name;
		if($_POST['butt']=="Upload Picture")
		{
            $textareaValue=$_POST["nblog"];
            $dat= date("Y-m-d");
            $tim= date("H:i:s");
			$sql = "insert into gallary (name,image,image_name,tags,dated,dat) values ('$user_name','".$file_to_saved."','$image_name','".$textareaValue."','$tim','$dat') ";
	$rs = mysqli_query($conn, $sql);
	$affectedRows = mysqli_affected_rows($conn);
	if($affectedRows == 1)
	{
		echo '<script type="text/javascript">
                       alert("Picture has been uploaded successfully");
                                                  window.location.href = "insta_login.php";
                                                          </script>';
	}
else{
	echo '<script type="text/javascript">
                       alert("Picture could not be uploaded");
                                                  window.location.href = "insta_login.php";
                                                          </script>';
	
}
}
else if ($_POST['butt']=="Update Profile Pic") {
                        $sql2 = "select name from profil where name = '$user_name' ";
                                    $result2 = mysqli_query($conn,$sql2);
                                           $row2 = mysqli_fetch_array($result2);
										   
                        if ($row2) {
                          
						     //$delet = mysqli_query($conn," DELETE FROM profile WHERE id = 'user_name' ");
						
							
							$update_img = mysqli_query($conn,"UPDATE profil SET profile = '".$file_to_saved."', pname = '$image_name' WHERE name ='$user_name' ");
							if($update_img){
								echo '<script type="text/javascript">
                                            alert("Image UPDATE Successfully");
                                                  window.location.href = "insta_login.php";
                                                          </script>';
							}
							else{
								echo '<script type="text/javascript">
                                            alert("There is something wrong while updating image");
                                                  window.location.href = "insta_login.php";
                                                          </script>';	
								
							}
							
							
						}				
				    else{
				    $insert_img = mysqli_query($conn,"INSERT INTO profil (name,profile,pname) values  ('$user_name','".$file_to_saved."','$image_name')");
                      if ($insert_img) {
    echo '<script type="text/javascript">
                                            alert("Image Set Successfully");
                                                  window.location.href = "insta_login.php";
                                                          </script>';
                                       }
                       else{
                              echo '<script type="text/javascript">
                                            alert("There is something wrong while Setting image");
                                                  window.location.href = "insta_login.php";
                                                          </script>';	
                              }
					}
}
}
else
{
	echo '<script type="text/javascript">
                       alert("Error while uploading");
                                                  window.location.href = "insta_login.php";
                                                          </script>';
}
}
else
{
           echo '<script type="text/javascript">
                       alert("User is not authorized..");
                                                  window.location.href = "insta_login.php";
                                                          </script>';

}	
			}
			else
			{
				
		          echo '<script type="text/javascript">
                        alert("File must be jpg/jpeg and must be 2MB or less.");
                        window.location.href = "insta_login.php";
                                     </script>';
			}
		}
		else
		{
			
			
		          echo '<script type="text/javascript">
                        alert("Please choose a picture");
                        window.location.href = "insta_login.php";
                                     </script>';
		}
	}
	else
	{
		
		          echo '<script type="text/javascript">
                alert("Not done");
                              window.location.href = "insta_login.php";
                                         </script>';
	}
}
else{
	echo '<script type="text/javascript">
                alert("Session error");
                              window.location.href = "insta_login.php";
                                         </script>';
}
?>


