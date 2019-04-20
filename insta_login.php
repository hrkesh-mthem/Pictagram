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
    <form autocomplete="off" action="insta_login2.php" method="post">
      <div class="autocomplete" style="width: 300px;">
      <input id="myInput" type="text"  name="search" required><input type="submit" name="btn" value="search">
    </div>
    </form>
  </div>
</div>
<div class="main">
<button class="b1 log1" onclick="document.getElementById('id02').style.display='block'" style="width:auto; cursor:pointer">New Post</button>
<form method="post" action="insta_login2.php"><input type="submit" value="My Profile" name="btn" class="b1 log1" id="myBtn2"/>
<input type="submit" value="Home" name="btn"  class="b1 log1" id="myBtn2"/>

<input type="submit" value="View Details" name="btn" class="b1 log1" id="myBtn"/>

<input type="submit" value="Request Admin for Authorization" name="btn"  class="b1 log1" id="myBtn1" />

<input type="submit" value="Follow Requests" name="btn" class="b1 log1"/>
<input type="submit" value="Notifications" name="btn" class="b1 log1" />
</form>
<button class="b1 log1" onclick="document.getElementById('idf').style.display='block'" style="width:auto; cursor:pointer">Filter</button>
</div>
</div>
<div id="idf" class="modalf">
  <form class="modalf-content animate" action="insta_login2.php" method="POST" enctype="multipart/form-data" style = "width:35%">
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

if (!$result || !$test) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
}
      while(($row = mysqli_fetch_array($result)) && ($row0 = mysqli_fetch_array($test))){
    
    //echo $pic['image_name'];
    ?>

    <div class="new">
      <?php $ti=$row['image_name']; ?>
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
                echo '<p>Posted on '.date('jS M Y', strtotime($row['dat'])).' '.date('H:m:s', strtotime($row['dated'])).'</p>';
                echo '<p>'.$row['tags'].'</p>';
                $d=$row['dated'];  
                $nam = $row['name'];            
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
<?php } 
} 
else{
    echo mysqli_error($conn);
    
}
}

for($page=1;$page<=$no_of_pages;$page++)
{
  echo '<a href="insta_login.php?page='.$page.'">&nbsp;&nbsp;&nbsp;'.$page.' </a>';
}
}
}
else{
    echo mysqli_error($conn);
    //echo "error2";
    
}


?>
  </div>
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
$try = mysqli_query($conn,"select * from login");

//$r = mysqli_fetch_assoc($try);
$bloggers=array();
 while($r = mysqli_fetch_assoc($try)){

//array_push($bloggers,$r['name']);
$bloggers[]=$r['name'];
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