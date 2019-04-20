<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "insta";
session_start();
$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn,$database);

if(isset($_SESSION["USERNAME"])){
$name =$_SESSION["USERNAME"];
$loc= "h";
$flag1 = 0;
$flag2 = 0;
$sqlpic = "select profile from profil where name ='$name' ";
$resultpic = mysqli_query($conn,$sqlpic);

if (!$resultpic) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}


$rowpic = mysqli_fetch_array($resultpic);

if(!$rowpic){
	$flag1 = 1;
}
}

//$image = $row['image'];

//$image_src = "upload/".$image;


?>


<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="stylein.css" rel="stylesheet">
<style>
.tablink {
    background-color: #555;
    color: white;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 25%;
}

.tablink:hover {
    background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
    color: white;
    display: none;
    padding: 100px 20px;
    height: 100%;
  
}
  .log {background-color: #f44336;} 
.log:hover {background-color: #da190b;}



#Home {background-color: #ff9999;}
#Home1 {background-color: #ffff66;}
#Home2 {background-color: #4d94ff;}
#About {background-color: #a64dff;}

.relative {
    position: relative;
}
.preview{
    width: 100px;
    height: 150px;
}
</style>
</head>
<body>
<div>
<div class="sidenav">
  <img src="<?=$rowpic[0]?>" width="75" height="75" alt ="Set Profile" id="id1">  
  <br>
  <button class="b1 log1" onclick="document.getElementById('id11').style.display='block'" style="width:auto; cursor:pointer">Update Profile Photo</button>
  <br>
  <br>
  <div class="Logout">
  <input type="button" value="Log Out"  class="b1 log1" id="myBtnl" onClick="Javascript:window.location.href = 'logout.php?var=<?php echo $name?>';" />
</div>
</div>
<div class="main1">
       <h1>WELCOME <?php echo $name ?></h1>
    </div>
    <div class="topnav1">
  <div class="search-container">
    <form autocomplete="off" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="autocomplete" style="width: 300px;">
      <input id="myInput" type="text"  name="search" required><input type="submit" name="btn" value="search">
    </div>
    </form>
  </div>
</div>
<div class="main">
<button class="b1 log1" onclick="document.getElementById('id02').style.display='block'" style="width:auto; cursor:pointer">New Post</button>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"><input type="submit" value="My Profile" name="btn" class="b1 log1" id="myBtn2"/>
<input type="submit" value="Home" name="btn"  class="b1 log1" id="myBtn2"/>
<input type="submit" value="View Details" name="btn" class="b1 log1" id="myBtn"/>
<input type="submit" value="Request Admin for Authorization" name="btn" class="b1 log1" id="myBtn1" />

<input type="submit" value="Follow Requests" name="btn"  class="b1 log1"/>
<input type="submit" value="Notifications" name="btn" class="b1 log1"/>
</form>
<button class="b1 log1" onclick="document.getElementById('idf').style.display='block'" style="width:auto; cursor:pointer">Filter</button>
</div>
</div>
<div id="idf" class="modalf">
  <form class="modalf-content animate" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" style = "width:35%">
    <div class = "containe">
  <p>Filter By</p>
  <hr>
  <br>
  <input type="checkbox" id="myCheck"  onclick="myFunction()">Account<br>
  <p id="option" style="display:none">
  <?php 
           $tryc = mysqli_query($conn,"select * from login order by id desc");
 while($rc = mysqli_fetch_assoc($tryc)){
?>
<br><input type="checkbox" name="account[]" value="<?php echo $rc['name'];?>"><?php echo $rc['name'];?>
<?php
}
  ?>
</p>
<input type="checkbox" id="myCheck2"  onclick="myFunction2()">Dates of Creation<br>
  <p id="option2" style="display:none">
  <?php 
           $tryc2 = mysqli_query($conn,"select * from gallary group by dat order by id desc");
 while($rc2 = mysqli_fetch_assoc($tryc2)){
?>
<br><input type="checkbox" name="dateoc[]" value="<?php echo $rc2['dat'];?>">
<?php echo date('jS M Y', strtotime($rc2['dat']))?>
<?php
}
  ?>
</p>
  <input type="checkbox" id="myCheck1"  onclick="myFunction1()">Hashtags<br>
<p id="option1" style="display:none">
  <?php 
           $tryc1 = mysqli_query($conn,"select * from searched order by id desc");
 while($rc1 = mysqli_fetch_assoc($tryc1)){
?>
<br><input type="checkbox" name="hash[]" value="<?php echo $rc1['hashtag'];?>"><?php echo $rc1['hashtag'];
?>
<?php
}
  ?>
</p>
<br><br><input type="submit" value="Filter" name="btn">
  </div>
</form>
</div>

<div id="id11" class="modal1">
  <form class="modal1-content animate" action="action1.php" method="POST" enctype="multipart/form-data" style = "width:35%; height:45% ">
    <div class = "containe">
	<p>UPLOAD PROFILE PHOTO</p>
	<hr>
	<br>
	<input type="file" name = "file"><br>
	<br>
    <input type="submit" value="Update Profile Pic" name="butt">
	</div>
</form>
</div>
<div id="idb" class="modalb">
  <form class="modalb-content animate" action="blogupdate.php" method="POST" enctype="multipart/form-data" style = "width:35%; height:50% ">
    <div class = "containe11">
     <label>Update Blog</label>
    <hr>
    Blog Title<br>
    <input type="text" name="btitlen">
    <br>
    New Blog Content<br>
        <textarea rows="10" cols="50" name = "nblogn">
        </textarea><br>
        <input type="submit" value="Submit">
    </div>
</form>
</div>
<div id="id02" class="modal2">
  
  <form class="modal2-content animate" action="action1.php" method="POST" enctype="multipart/form-data" style = "width:35%; height:80%">
 <div class="containe">
    <label>New Post</label>
    <hr>
    <img src="" height="150px" alt="Image preview..." width="100px"><br><br>
  <input type="file" onchange="previewFile()" name = "file"><br>
    <div>
    <br>
    Write a caption...
        <textarea rows="10" cols="50" name = "nblog">
        </textarea><br>
        <input type="submit" class="log1" value="Upload Picture" name="butt">
      </div>
    </div>
</form>
</div>
<?php 
if($_POST['btn']=='My Profile')
{
  ?>
<div class="absolute1">
      <?php 
if(isset($_SESSION["USERNAME"])){
$user_name = $_SESSION["USERNAME"];
//echo $user_name;

$query = mysqli_query($conn,"SELECT id FROM gallary where name = '$user_name' order by id desc");
$check = mysqli_fetch_array($query);
if($check){
$query2q = mysqli_query($conn,"SELECT id FROM gallary where name = '$user_name'order by id desc");
$pp = mysqli_num_rows($query2q);
$res_per_page=2;
$no_of_pages=ceil($pp/$res_per_page);

if(!isset($_GET['page']))
{
  $page=1;
}
else
{
  $page=$_GET['page'];
}

$this_page_first_result=(($page-1)*$res_per_page);
$query2 = mysqli_query($conn,"SELECT id FROM gallary where name = '$user_name'order by id desc limit $this_page_first_result,$res_per_page");    
while($yas = mysqli_fetch_assoc($query2))
{
    $IDstore[] = $yas['id'];
    //echo $yas['id'];
    
    

if(1){
foreach($IDstore as $id){

$sql = "select * from gallary where id=$id";

$result = mysqli_query($conn,$sql);
$try ="select image from gallary where id=$id";
$test = mysqli_query($conn,$try);

if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}


      while(($row = mysqli_fetch_array($result)) && ($row0 = mysqli_fetch_array($test))){
    
    //echo $pic['image_name'];
    ?>

    <div class="new">

      <img src="<?=$row0[0]?>" width="450px" height="525px" alt="Image"> 

      <a href="javascript:delpost('<?php echo $row['id'];?>','<?php echo $row['image_name'];?>')">Delete</a>
<?php 
echo '<p>'.$row['tags'].'</p>';
echo '<p>Posted on '.date('jS M Y', strtotime($row['dat'])).' '.date('H:i:s', strtotime($row['dated'])).'</p>';
                $d=$row['dated'];  
                $nam = $row['name']; 
                $ti=$row['image_name'];
                echo '<p>'.$row['likes'].' Likes</p>';
                ?>
                <hr><?php
echo '<p>'.$row['comments'].' Comments</p>';
$resu = mysqli_query($conn,"select * from comblog where follows='$nam' and image_name='$ti'");



 while($row111 = mysqli_fetch_assoc($resu)){
 echo '<p>'.$row111['user'].'- '.$row111['comments'].'</p>';
}
                ?>
<br><br> <form action="upd.php?n=<?php echo $nam?>&t=<?php echo $ti?>" method="post"><textarea  name="comments" maxlength="1000" cols="40" rows="1"></textarea>
    <button type="submit" class="b1 log1" value= "submit">Update Caption</button>
      </form>
</div>
<?php } } 
else{
    echo mysqli_error($conn);
    
}
}
for($page=1;$page<=$no_of_pages;$page++)
{
  echo '<a href="insta_login3.php?page='.$page.'&btn='.$_POST['btn'].'">&nbsp;&nbsp;&nbsp;'.$page.' </a>';
}
}
else
{
  ?>
<div class="main1">
  <?php
  echo "No Pictures uploaded yet...";
  ?>
</div>
  <?php
}
}
else{
    echo mysqli_error($conn);
    //echo "error2";
    
}


?>
  </div>
<?php }
else if($_POST['btn']=="Home")
{?>
  <div class="absolute1">
      <?php 
if(isset($_SESSION["USERNAME"])){
$user_name = $_SESSION["USERNAME"];
//echo $user_name;

$query = mysqli_query($conn,"SELECT * FROM follow where user = '$user_name' and sent='1' and accepted='1'");
$check = mysqli_fetch_array($query);

//echo $check['id'];
if($check){
    $query2q = mysqli_query($conn,"SELECT id FROM gallary where name in (select follows from follow where user = '$user_name' and sent='1' and accepted='1') order by id desc");
$pp = mysqli_num_rows($query2q);
$res_per_page=2;
$no_of_pages=ceil($pp/$res_per_page);

if(!isset($_GET['page']))
{
  $page=1;
}
else
{
  $page=$_GET['page'];
}


$this_page_first_result=(($page-1)*$res_per_page);
$query2 = mysqli_query($conn,"SELECT id FROM gallary where name in (select follows from follow where user = '$user_name' and sent='1' and accepted='1') order by id desc limit $this_page_first_result,$res_per_page");    
while($yas = mysqli_fetch_assoc($query2))
{
    $IDstore[] = $yas['id'];
    //echo $yas['id'];
    
    

if(1){
foreach($IDstore as $id){

$sql = "select * from gallary where id=$id";

$result = mysqli_query($conn,$sql);
$try ="select image from gallary where id=$id";
$test = mysqli_query($conn,$try);

if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}


      while(($row = mysqli_fetch_array($result)) && ($row0 = mysqli_fetch_array($test))){
    
    //echo $pic['image_name'];
    ?>

    <div class="new">
      <img src="<?=$row0[0]?>" width="450px" height="525px" alt="Image">
      <a href="download.php?file=<?=$row0[0]?>&idn=<?php echo $row['id']?>"><img src="/insta/d.jpg" width="20px" height="20px" alt="Download"></a>
<?php 
        if($row['download']>1)
        {
               $str="Downloads";
        }
        else
        {
          $str="Download";
        }
                echo $row['download'].' '.$str;
                echo '<p>'.$row['tags'].'</p>';
                echo '<p>Posted on '.date('jS M Y', strtotime($row['dat'])).' '.date('H:i:s', strtotime($row['dated'])).'</p>';
                $d=$row['dated'];  
                $nam = $row['name']; 
                $ti=$row['image_name'];            
                echo '<p>Posted By - '.$nam.'</p>';
                echo '<p>'.$row['likes'].' Likes</p>';
$ql=mysqli_query($conn,"select * from likedblog where user='$name' and follows='$nam' and image_name='$ti'");
$ffectedRows = mysqli_affected_rows($conn);
if($ffectedRows==1 && $ql)
{
   $q=mysqli_query($conn,"select * from likedblog where user='$name' and follows='$nam' and image_name='$ti' and liked='1'");
$ffectedRow = mysqli_affected_rows($conn);
if($ffectedRow==1 && $q)
{
    ?>
<form method="post" action="dislikef.php?n=<?php echo $nam ?>&t=<?php echo $ti?>"><input type="submit" value="Dislike" name="press" class="b1 log1" /></form>
    <?php
}
else
{
?>
    <form method="post" action="dislikef.php?n=<?php echo $nam ?>&t=<?php echo $ti?>"><input type="submit" value="Like" name="press" class="b1 log1" /></form>
<?php
}
}
else
{
    ?> 
    <form method="post" action="dislikef.php?n=<?php echo $nam ?>&t=<?php echo $ti?>"><input type="submit" value="Like1" name="press" class="b1 log1" /></form>
<?php }
?>
<hr>
<?php
echo '<p>'.$row['comments'].' Comments</p>';
$resu = mysqli_query($conn,"select * from comblog where follows='$nam' and image_name='$ti'");



 while($row = mysqli_fetch_assoc($resu)){
 echo '<p>'.$row['user'].'- '.$row['comments'].'</p>';
} ?>
   <br><br> <form action="comm1.php?n=<?php echo $nam?>&t=<?php echo $ti?>" method="post"><textarea  name="comments" maxlength="1000" cols="40" rows="1"></textarea>
    <button type="submit" class="b1 log1" value= "submit">Comment</button>
      </form>

</div>
<?php } } 
else{
    echo mysqli_error($conn);
    
}
}
for($page=1;$page<=$no_of_pages;$page++)
{
  echo '<a href="insta_login3.php?page='.$page.'&btn='.$_POST['btn'].'">&nbsp;&nbsp;&nbsp;'.$page.' </a>';
}
}
}
else{
    echo mysqli_error($conn);
    //echo "error2";
    
}


?>
  </div>
<?php }
else if($_POST['btn']=='Filter')
{
  ?>
<div class="absolute1">
      <?php 
if(isset($_SESSION["USERNAME"])){
$user_name = $_SESSION["USERNAME"];
if(!empty($_POST['account']) || !empty($_POST['hash']) || !empty($_POST['dateoc']))
{
if(!empty($_POST['account'])){
// Loop to store and display values of individual checked checkbox.
foreach($_POST['account'] as $selected){
$querya = mysqli_query($conn,"SELECT id FROM gallary where name = '$selected' order by id desc");
$checka = mysqli_fetch_array($querya);
if($checka){
    $query2a = mysqli_query($conn,"SELECT id FROM gallary where name = '$selected'order by id desc");
    
while($yasa = mysqli_fetch_assoc($query2a))
{
    $IDstorea[] = $yasa['id'];
    //echo $yasa['id'];
    
    

if(1){
foreach($IDstorea as $ida){

$sqla = "select * from gallary where id=$ida";

$resulta = mysqli_query($conn,$sqla);
$trya ="select image from gallary where id=$ida";
$testa = mysqli_query($conn,$trya);

if (!$resulta) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}


      while(($rowa = mysqli_fetch_array($resulta)) && ($row0a = mysqli_fetch_array($testa))){
    
    //echo $pic['image_name'];
    ?>

    <div class="new">

      <img src="<?=$row0a[0]?>" width="450px" height="525px" alt="Image"> 
<a href="download.php?file=<?=$row0a[0]?>&idn=<?php echo $rowa['id']?>"><img src="/insta/d.jpg" width="20px" height="20px" alt="Download"></a>
<?php 
        if($rowa['download']>1)
        {
               $str="Downloads";
        }
        else
        {
          $str="Download";
        }
                echo $rowa['download'].' '.$str;
echo '<p>'.$rowa['tags'].'</p>';
echo '<p>Posted on '.date('jS M Y', strtotime($rowa['dat'])).' '.date('H:i:s', strtotime($rowa['dated'])).'</p>';
                echo '<p>Posted By - '.$rowa['name'].'</p>';
                $d=$rowa['dated'];  
                $nam = $rowa['name']; 
                $ti=$rowa['image_name'];
                echo '<p>'.$rowa['likes'].' Likes</p>';
                ?>
                <hr><?php
echo '<p>'.$rowa['comments'].' Comments</p>';
$resua = mysqli_query($conn,"select * from comblog where follows='$nam' and image_name='$ti'");



 while($row111a = mysqli_fetch_assoc($resua)){
 echo '<p>'.$row111a['user'].'- '.$row111a['comments'].'</p>';
}
                ?>
<br><br> <form action="upd.php?n=<?php echo $nam?>&t=<?php echo $ti?>" method="post"><textarea  name="comments" maxlength="1000" cols="40" rows="1"></textarea>
    <button type="submit" class="b1 log1" value= "submit">Update Caption</button>
      </form>
</div>
<?php } } 
else{
    echo mysqli_error($conn);
    
}
}
}
//////////////
}
}
if(!empty($_POST['hash'])){
// Loop to store and display values of individual checked checkbox.
foreach($_POST['hash'] as $selected){
$querya1 = mysqli_query($conn,"SELECT id FROM gallary where tags like '%$selected%' order by id desc");
$checka1 = mysqli_fetch_array($querya1);
if($checka1){
    $query2a1 = mysqli_query($conn,"SELECT id FROM gallary where tags like '%$selected%' order by id desc");
    
while($yasa1 = mysqli_fetch_assoc($query2a1))
{
    $IDstorea1[] = $yasa1['id'];
    //echo $yasa['id'];
    
    

if(1){
foreach($IDstorea1 as $ida1){

$sqla1 = "select * from gallary where id=$ida1";

$resulta1 = mysqli_query($conn,$sqla1);
$trya1 ="select image from gallary where id=$ida1";
$testa1 = mysqli_query($conn,$trya1);

if (!$resulta1) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}


      while(($rowa1 = mysqli_fetch_array($resulta1)) && ($row0a1 = mysqli_fetch_array($testa1))){
    
    //echo $pic['image_name'];
    ?>

    <div class="new">

      <img src="<?=$row0a1[0]?>" width="450px" height="525px" alt="Image"> 
<a href="download.php?file=<?=$row0a1[0]?>&idn=<?php echo $rowa1['id']?>"><img src="/insta/d.jpg" width="20px" height="20px" alt="Download"></a>
<?php 
        if($rowa1['download']>1)
        {
               $str="Downloads";
        }
        else
        {
          $str="Download";
        }
                echo $rowa1['download'].' '.$str;
echo '<p>'.$rowa1['tags'].'</p>';
echo '<p>Posted on '.date('jS M Y', strtotime($rowa1['dat'])).' '.date('H:i:s', strtotime($rowa1['dated'])).'</p>';
                echo '<p>Posted By - '.$rowa1['name'].'</p>';
                $d=$rowa1['dated'];  
                $nam = $rowa1['name']; 
                $ti=$rowa1['image_name'];
                echo '<p>'.$rowa1['likes'].' Likes</p>';
                ?>
                <hr><?php
echo '<p>'.$rowa1['comments'].' Comments</p>';
$resua1 = mysqli_query($conn,"select * from comblog where follows='$nam' and image_name='$ti'");



 while($row111a1 = mysqli_fetch_assoc($resua1)){
 echo '<p>'.$row111a1['user'].'- '.$row111a1['comments'].'</p>';
}
                ?>
<br><br> <form action="upd.php?n=<?php echo $nam?>&t=<?php echo $ti?>" method="post"><textarea  name="comments" maxlength="1000" cols="40" rows="1"></textarea>
    <button type="submit" class="b1 log1" value= "submit">Update Caption</button>
      </form>
</div>
<?php } } 
else{
    echo mysqli_error($conn);
    
}
}
}
//////////////
}
}

if(!empty($_POST['dateoc'])){
// Loop to store and display values of individual checked checkbox.
foreach($_POST['dateoc'] as $selected){
$querya12 = mysqli_query($conn,"SELECT id FROM gallary where dat='$selected' order by id desc");
$checka12 = mysqli_fetch_array($querya12);
if($checka12){
    $query2a12 = mysqli_query($conn,"SELECT id FROM gallary where dat='$selected' order by id desc");
    
while($yasa12 = mysqli_fetch_assoc($query2a12))
{
    $IDstorea12[] = $yasa12['id'];
    //echo $yasa['id'];
    
    

if(1){
foreach($IDstorea12 as $ida12){

$sqla12 = "select * from gallary where id=$ida12";

$resulta12 = mysqli_query($conn,$sqla12);
$trya12 ="select image from gallary where id=$ida12";
$testa12 = mysqli_query($conn,$trya12);

if (!$resulta12) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}


      while(($rowa12 = mysqli_fetch_array($resulta12)) && ($row0a12 = mysqli_fetch_array($testa12))){
    
    //echo $pic['image_name'];
    ?>

    <div class="new">

      <img src="<?=$row0a12[0]?>" width="450px" height="525px" alt="Image"> 
<a href="download.php?file=<?=$row0a12[0]?>&idn=<?php echo $rowa12['id']?>"><img src="/insta/d.jpg" width="20px" height="20px" alt="Download"></a>
<?php 
        if($rowa12['download']>1)
        {
               $str="Downloads";
        }
        else
        {
          $str="Download";
        }
                echo $rowa12['download'].' '.$str;
echo '<p>'.$rowa12['tags'].'</p>';
echo '<p>Posted on '.date('jS M Y', strtotime($rowa12['dat'])).' '.date('H:i:s', strtotime($rowa12['dated'])).'</p>';
                echo '<p>Posted By - '.$rowa12['name'].'</p>';
                $d=$rowa12['dated'];  
                $nam = $rowa12['name']; 
                $ti=$rowa12['image_name'];
                echo '<p>'.$rowa12['likes'].' Likes</p>';
                ?>
                <hr><?php
echo '<p>'.$rowa12['comments'].' Comments</p>';
$resua12 = mysqli_query($conn,"select * from comblog where follows='$nam' and image_name='$ti'");



 while($row111a12 = mysqli_fetch_assoc($resua12)){
 echo '<p>'.$row111a12['user'].'- '.$row111a12['comments'].'</p>';
}
                ?>
<br><br> <form action="upd.php?n=<?php echo $nam?>&t=<?php echo $ti?>" method="post"><textarea  name="comments" maxlength="1000" cols="40" rows="1"></textarea>
    <button type="submit" class="b1 log1" value= "submit">Update Caption</button>
      </form>
</div>
<?php } } 
else{
    echo mysqli_error($conn);
    
}
}
}
//////////////
}
}
}
else
{
  echo '<script type="text/javascript">
           alert("No Filter Selected");
          window.location.href = "insta_login.php";
             </script>';
}
}
else{
    echo mysqli_error($conn);
    //echo "error2";
    
}


?>
  </div>
<?php }


/////////////////
else if ($_POST['btn']=="View Details") {
  ?> <div class="absolute1">
      <?php 
if(isset($_SESSION["USERNAME"])){
$user_name = $_SESSION["USERNAME"];

$query = mysqli_query($conn,"SELECT fname,name,email FROM login where name = '$name'");
$em=mysqli_fetch_array($query);
if($query){
$row = mysqli_num_rows($query);
    if($row==1){?>
<br><div class="new1" style="font-size: 30px">
<?php
echo '<p>Full Name: '.$em['fname'].'</p><br>';
 echo '<p>User Name: '.$name.'</p><br>';
    echo '<p>Email Id: '.$em['email'].'</p><br>';?>
</div>
<?php  
}
}
else
{
     echo "No Profile";
}
}
else{
    echo mysqli_error($conn);
    //echo "error2";
    
}
?>
  </div>
<?php }
else if ($_POST['btn']=="Request Admin for Authorization") {
$sql=mysqli_query($conn,"select name from login where name='$name' and sent='0' and accepted='0'");
$affectedRows = mysqli_affected_rows($conn);
if($affectedRows == 1 && $sql)
{
    $sql1=mysqli_query($conn,"update login set sent='1' where name='$name' and sent='0' and accepted='0'");
    if($sql1)
    {
      echo '<script type="text/javascript">
           alert("Permission request has been sent to the admin");
          window.location.href = "insta_login.php";
             </script>';
    }
    else
    {
      echo '<script type="text/javascript">
           alert("Permission request not sent to the admin");
          window.location.href = "insta_login.php";
             </script>';
    }
}
else
{
  $sql1=mysqli_query($conn,"select name from login where name='$name' and sent='1' and accepted='0'");
$affectedRows1 = mysqli_affected_rows($conn);
    if($affectedRows1 == 1 && $sql1)
      {echo '<script type="text/javascript">
           alert("Permission request has already been sent to the admin");
          window.location.href = "insta_login.php";
             </script>';}
             else
             {
               $sql2=mysqli_query($conn,"select name from login where name='$name' and sent='1' and accepted='1'");
$affectedRows2 = mysqli_affected_rows($conn);
    if($affectedRows2 == 1 && $sql2)
      {echo '<script type="text/javascript">
           alert("Permission request has already been accepted by the admin");
          window.location.href = "insta_login.php";
             </script>';}
             else
             {
              echo "error";
             }

             }
           }
}
else if ($_POST['btn']=="Follow Requests") {
 ?> <div class="absolute1">
      <?php 
if(isset($_SESSION["USERNAME"])){
$user_name = $_SESSION["USERNAME"];
//echo $user_name;

$query = mysqli_query($conn,"SELECT * FROM follow where follows = '$user_name' and sent='1' and accepted='0'");
$check = mysqli_fetch_array($query);

//echo $check['id'];
if($check){
    $query2 = mysqli_query($conn,"SELECT id FROM follow where follows = '$user_name' order by id desc");
    
while($yas = mysqli_fetch_assoc($query2))
{
    $IDstore[] = $yas['id'];
    //echo $yas['id'];
    
    

if(1){
foreach($IDstore as $id){

$sql = "select user from follow where id=$id and follows='$user_name' and sent='1' and accepted='0'";

$result = mysqli_query($conn,$sql);


if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}


      while($row = mysqli_fetch_array($result) ){
    
    //echo $pic['image_name'];
    ?>

    <div class="new" style="font-size: 30px;">
<?php
    $nam=$row['user'];
    echo '<p>'.$nam.'</p>';?>
    <input type="button" value="Accept"  class="b1 log1" id="bn1" onClick="Javascript:window.location.href = 'acceptr.php?n=<?php echo $nam ?>';" />
    <input type="button" value="Reject"  class="b1 log1" id="bn2" onClick="Javascript:window.location.href = 'rejectr.php?n1=<?php echo $nam ?>';" />
</div>
<?php } } 
else{
    echo mysqli_error($conn);
    
}
}
}
else
{
  ?>
  <div class="main1">
    <?php echo "No Follow Requests"; ?>
  </div>
  <?php
}
}
else{
    echo mysqli_error($conn);
    //echo "error2";
    
}


?>
  </div>
<?php }
else if ($_POST['btn']=="Notifications") {
  ?>
  <div class="absolute1">
      <?php 
if(isset($_SESSION["USERNAME"])){
$user_name = $_SESSION["USERNAME"];
//echo $user_name;

$query = mysqli_query($conn,"SELECT * FROM notif where user = '$user_name'");
$check = mysqli_fetch_array($query);

//echo $check['id'];
if($check){
    $query2 = mysqli_query($conn,"SELECT id FROM notif where user='$user_name' order by id desc");
    
while($yas = mysqli_fetch_assoc($query2))
{
    $IDstore[] = $yas['id'];
    //echo $yas['id'];
    
    

if(1){
foreach($IDstore as $id){

$sql = "select * from notif where id=$id";

$result = mysqli_query($conn,$sql);


if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}


      while($row = mysqli_fetch_array($result) ){
    if($row['liker']!=$row['user'])
   { ?>

    <div class="new">
<?php echo '<h1>'.$row['notice'].'</h1>';?>
</div>
<?php }} } 
else{
    echo mysqli_error($conn);
    
}
}
}
else
{
   ?>
  <div class="main1">
    <?php echo "No Notifications"; ?>
  </div>
  <?php
}
}
else{
    echo mysqli_error($conn);
    //echo "error2";
    
}


?>
  </div>
<?php }
else if ($_POST['btn']=="search") {
  if(isset($_SESSION["USERNAME"])){
$name =$_SESSION["USERNAME"];
$search=$_POST["search"];
if($search[0] === '#')
{
$sql1s=mysqli_query($conn,"select * from searched where hashtag='$search'");
$affectedRows1s = mysqli_affected_rows($conn);
if($affectedRows1s == 1 && $sql1s)
{
   while($rowf = mysqli_fetch_array($sql1s))
  {
    $v=$rowf['counts'];
  }
   $v=$v+1;
    $sql2sf=mysqli_query($conn,"update searched set counts='$v',display='$search(searched $v times)' where hashtag='$search'");
    if($sql2sf)
    {

    }
    else
    {
      echo "Error updating";
    }
   /////////////////////
}
else
{
  $sql1ss=mysqli_query($conn,"insert into searched (hashtag,display,counts) values ('$search','$search(searched 1 time)',1)");
  $affectedRows1ss = mysqli_affected_rows($conn);
  if($affectedRows1ss == 1 && $sql1ss)
  {

  }
  else
  {
    echo "inserting error";
  }
}
}
////////////////
$sql1=mysqli_query($conn,"select name from login where name='$search'");
$affectedRows1 = mysqli_affected_rows($conn);
if($affectedRows1 == 1 && $sql1){
$sql = "select profile from profil where name ='$search' ";
$result = mysqli_query($conn,$sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}


$row = mysqli_fetch_array($result);

if(!$row){
  $flag1 = 1;
}?>
<div class="main1">
       <h1>Profile of <?php echo $search ?></h1>
</div>
<div class="absolute1">
<?php 
$asd=mysqli_query($conn,"select * from follow where user='$name' and follows ='$search'");
$araa = mysqli_affected_rows($conn);
if($araa == 1 && $asd)
{
$asd1=mysqli_query($conn,"select * from follow where user='$name' and follows ='$search' and sent='1' and accepted='1'");
$araa1 = mysqli_affected_rows($conn);
if($araa1==1 && $asd1)
{
//////folllowing div
}else
{
///request sent;
}
}
else
{
  ////follow button
}

if($affectedRows1 == 1 && $sql1){
$queryqqq = mysqli_query($conn,"SELECT id FROM gallary where name = '$search'");
$checkqqq = mysqli_fetch_array($queryqqq);

//echo $check['id'];
if($checkqqq){
    $query2q = mysqli_query($conn,"SELECT id FROM gallary where name = '$search' order by id desc");
/*$pp = mysqli_num_rows($query2qw);
$res_per_page=2;
$no_of_pages=ceil($pp/$res_per_page);

if(!isset($_GET['page']))
{
  $page=1;
}
else
{
  $page=$_GET['page'];
}

$this_page_first_result=(($page-1)*$res_per_page);
$query2q = mysqli_query($conn,"SELECT id FROM gallary where name = '$search' order by id desc limit $this_page_first_result,$res_per_page");    */
while($yas2q = mysqli_fetch_assoc($query2q))
{
    $IDstore2q[] = $yas2q['id'];
    //echo $yas['id'];
    
    

if(1){
foreach($IDstore2q as $id2q){

$sqlqw = "select * from gallary where id = $id2q";


$resultqw = mysqli_query($conn,$sqlqw);

$try123 ="select image from gallary where id=$id2q";
$test123 = mysqli_query($conn,$try123);
if (!$resultqw || !$test123) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}


      while(($rowz = mysqli_fetch_array($resultqw)) && ($row01 = mysqli_fetch_array($test123))){
    
    //echo $pic['image_name'];
    ?>
<div class="new">
  <img src="<?=$row01[0]?>" width="450px" height="525px" alt="Image">
  <a href="download.php?file=<?=$row01[0]?>&idn=<?php echo $rowz['id']?>"><img src="/insta/d.jpg" width="20px" height="20px" alt="Download"></a>
<?php 
        if($rowz['download']>1)
        {
               $str="Downloads";
        }
        else
        {
          $str="Download";
        }
                echo $rowz['download'].' '.$str;
                echo '<p>'.$rowz['tags'].'</p>';
                echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($rowz['dat'])).'</p>';                
                echo '<p>Posted By - '.$rowz['name'].'</p>';
                echo '<p>'.$rowz['likes'].' Likes</p>';
$nam = $rowz['name']; 
$ti=$rowz['image_name'];
$qlas=mysqli_query($conn,"select * from likedblog where user='$name' and follows='$nam' and image_name='$ti'");
$ffectedRowsas = mysqli_affected_rows($conn);
if($ffectedRowsas==1 && $qlas)
{
   $qin=mysqli_query($conn,"select * from likedblog where user='$name' and follows='$nam' and image_name='$ti' and liked='1'");
$ffectedRowin = mysqli_affected_rows($conn);
if($ffectedRowin==1 && $qin)
{
    ?>
<input type="button" value="Dislike"  class="b1 log1"  onClick="Javascript:window.location.href = 'dislikef.php?n=<?php echo $nam ?>&t=<?php echo $ti?>';" />
    <?php
}
else
{
?>
    <input type="button" value="Like"  class="b1 log1"  onClick="Javascript:window.location.href = 'likef1.php?n=<?php echo $nam ?>&t=<?php echo $ti?>';" />
<?php
}
}
else
{
    ?> <input type="button" value="Like"  class="b1 log1"  onClick="Javascript:window.location.href = 'likef.php?n=<?php echo $nam ?>&t=<?php echo $ti?>';" />
<?php }
?>
<hr>
<?php
 echo '<p>'.$rowz['comments'].' Comments</p>';
$resuo = mysqli_query($conn,"select * from comblog where follows='$nam' and image_name='$ti'");



 while($rowo = mysqli_fetch_assoc($resuo)){
 echo '<p>'.$rowo['user'].'- '.$rowo['comments'].'</p>';
} ?>
   <br><br> <form action="comm1.php?n=<?php echo $nam?>&t=<?php echo $ti?>" method="post"><textarea  name="comments" maxlength="1000" cols="40" rows="1"></textarea>
    <button type="submit" class="b1 log1" value= "submit">Comment</button>
      </form>

</div>
<?php } } 
else{
    echo mysqli_error($conn);
    
}
}
}
else
{
  ?>
  <div class="new">
<?php echo '<h1>No Pictures...</h1>';?>
</div>
<?php
}
}
else{
    echo '<script type="text/javascript">
           alert("No Result1");
          window.location.href = "insta_login.php";
             </script>';
    
}


?>
  </div>
<?php 
}
else
{
?>
<div class="absolute1">
<?php 
$asd2=mysqli_query($conn,"select * from gallary where tags like '%$search%'");
$araa2 = mysqli_affected_rows($conn);
if($araa2 && $asd2 ){
$queryqqq = mysqli_query($conn,"SELECT id FROM gallary where tags like '%$search%'");
$checkqqq = mysqli_fetch_array($queryqqq);

//echo $check['id'];
if($checkqqq){
    $query2q = mysqli_query($conn,"SELECT id FROM gallary where tags like '%$search%' order by id desc");
/*$pp = mysqli_num_rows($query2qw);
$res_per_page=2;
$no_of_pages=ceil($pp/$res_per_page);

if(!isset($_GET['page']))
{
  $page=1;
}
else
{
  $page=$_GET['page'];
}

$this_page_first_result=(($page-1)*$res_per_page);
$query2q = mysqli_query($conn,"SELECT id FROM gallary where tags like '%$search%' order by id desc limit $this_page_first_result,$res_per_page");*/
while($yas2q = mysqli_fetch_assoc($query2q))
{
    $IDstore2q[] = $yas2q['id'];
    //echo $yas['id'];
    
    

if(1){
foreach($IDstore2q as $id2q){

$sqlqw = "select * from gallary where id = $id2q";


$resultqw = mysqli_query($conn,$sqlqw);

$try123 ="select image from gallary where id=$id2q";
$test123 = mysqli_query($conn,$try123);
if (!$resultqw || !$test123) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}


      while(($rowz = mysqli_fetch_array($resultqw)) && ($row01 = mysqli_fetch_array($test123))){
    
    //echo $pic['image_name'];
    ?>
<div class="new">
  <img src="<?=$row01[0]?>" width="450px" height="525px" alt="Image">
<?php echo '<p>'.$rowz['tags'].'</p>';
                echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($rowz['dat'])).'</p>';                
                echo '<p>Posted By - '.$rowz['name'].'</p>';
                echo '<p>'.$rowz['likes'].' Likes</p>';
$nam = $rowz['name']; 
$ti=$rowz['image_name'];
$qlas=mysqli_query($conn,"select * from likedblog where user='$name' and follows='$nam' and image_name='$ti'");
$ffectedRowsas = mysqli_affected_rows($conn);
if($ffectedRowsas==1 && $qlas)
{
   $qin=mysqli_query($conn,"select * from likedblog where user='$name' and follows='$nam' and image_name='$ti' and liked='1'");
$ffectedRowin = mysqli_affected_rows($conn);
if($ffectedRowin==1 && $qin)
{
    ?>
<input type="button" value="Dislike"  class="b1 log1"  onClick="Javascript:window.location.href = 'dislikef.php?n=<?php echo $nam ?>&t=<?php echo $ti?>';" />
    <?php
}
else
{
?>
    <input type="button" value="Like"  class="b1 log1"  onClick="Javascript:window.location.href = 'likef1.php?n=<?php echo $nam ?>&t=<?php echo $ti?>';" />
<?php
}
}
else
{
    ?> <input type="button" value="Like"  class="b1 log1"  onClick="Javascript:window.location.href = 'likef.php?n=<?php echo $nam ?>&t=<?php echo $ti?>';" />
<?php }
?>
<hr>
<?php
 echo '<p>'.$rowz['comments'].' Comments</p>';
$resuo = mysqli_query($conn,"select * from comblog where follows='$nam' and image_name='$ti'");



 while($rowo = mysqli_fetch_assoc($resuo)){
 echo '<p>'.$rowo['user'].'- '.$rowo['comments'].'</p>';
} ?>
   <br><br> <form action="comm1.php?n=<?php echo $nam?>&t=<?php echo $ti?>" method="post"><textarea  name="comments" maxlength="1000" cols="40" rows="1"></textarea>
    <button type="submit" class="b1 log1" value= "submit">Comment</button>
      </form>

</div>
<?php } } 
else{
    echo mysqli_error($conn);
    
}
}
/*for($page=1;$page<=$no_of_pages;$page++)
{
  echo '<a href="insta_login3.php?page='.$page.'&btn='.$_POST['btn'].'&search='.$search.'">&nbsp;&nbsp;&nbsp;'.$page.' </a>';
}*/
}
else
{
  ?>
  <div class="new">
<?php echo '<h1>No Pictures...</h1>';?>
</div>
<?php
}
}
else
{
  echo '<script type="text/javascript">
           alert("No Result");
          window.location.href = "insta_login.php";
             </script>';
}

?>
  </div>

  <?php
}
}
else
{
    echo '<script type="text/javascript">
           alert("Session error");
          window.location.href = "insta_login.php";
             </script>';
}
}
?>
<script>
// Get the modal
var modal1 = document.getElementById('id11');
var modal2 = document.getElementById('id02');
var modalb = document.getElementById('idb');
var modalf = document.getElementById('idf');
// When the user clicks anywhere outside of the modal, close it

window.onclick = function(event) {
    if (event.target == modal1 || event.target == modal2 || event.target == modalb || event.target == modalf) {
        modal1.style.display = "none";
		    modal2.style.display = "none";
        modalb.style.display = "none";
        modalf.style.display = "none";
    }
}
<?php
$try = mysqli_query($conn,"select * from searched");

//$r = mysqli_fetch_assoc($try);
$bloggers=array();
 while($r = mysqli_fetch_assoc($try)){

//array_push($bloggers,$r['name']);
$bloggers[]=$r['display'];
}
 //$bloggers   = rtrim($bloggers,",");
?>
//var bloggers=[<?php  $bloggers; ?>];
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}
var bloggers = <?php echo json_encode($bloggers);?>;
autocomplete(document.getElementById("myInput"),bloggers);
function previewFile(){
       
       var preview = document.querySelector('img'); 
       var file    = document.querySelector('input[type=file]').files[0]; 
       var reader  = new FileReader();

       reader.onloadend = function () {
           preview.src = reader.result;
       }

       if (file) {
           reader.readAsDataURL(file);
       } else {
           preview.src = "";
       }
     }

previewFile();


function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
function delpost(id, title)
{
  if (confirm("Are you sure you want to delete '" + title + "'"))
  {
      window.location.href = 'index.php?delpost=' + id;
  }
}
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("option");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
function myFunction1() {
  var checkBox1 = document.getElementById("myCheck1");
  var text1 = document.getElementById("option1");
  if (checkBox1.checked == true){
    text1.style.display = "block";
  } else {
     text1.style.display = "none";
  }
}
function myFunction2() {
  var checkBox2 = document.getElementById("myCheck2");
  var text2 = document.getElementById("option2");
  if (checkBox2.checked == true){
    text2.style.display = "block";
  } else {
     text2.style.display = "none";
  }
}
</script>
</body>
</html>