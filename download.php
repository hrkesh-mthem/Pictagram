<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "insta";
$conn = mysqli_connect($servername, $username, $password);

mysqli_select_db($conn,$database);
$file = $_GET['file'];
$id = $_GET['idn'];
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
          window.location.reload();
             </script>';
      download_file($file);
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

function download_file( $fullPath ){

  // Must be fresh start
  if( headers_sent() )
    die('Headers Sent');

  // Required for some browsers
  if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');

  // File Exists?
  if( file_exists($fullPath) ){

    // Parse Info / Get Extension
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);

    // Determine Content Type
    switch ($ext) {
      case "pdf": $ctype="application/pdf"; break;
      case "exe": $ctype="application/octet-stream"; break;
      case "zip": $ctype="application/zip"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "jpg": $ctype="image/jpg"; break;
      default: $ctype="application/force-download";
    }
    header("Pragma: public"); // required
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); // required for certain browsers
    header("Content-Type: $ctype");
    header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$fsize);
    ob_clean();
    flush();
    readfile( $fullPath );
  } else
    die('File Not Found');

}
?>