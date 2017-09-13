<?php
 @include 'connection.php';
 session_start();
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
$username=$_POST['username']; 
$password=$_POST['password'];

$username=filter_var($username, FILTER_SANITIZE_STRING);
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string(sha1($password));
$sql="SELECT * FROM stock_management.users WHERE username='$username' and password='$password'";
$s="SELECT flag FROM stock_management.users WHERE username='$username'";
$result=mysql_query($sql);
$r=mysql_query($s);
$count=mysql_num_rows($result);

while ($row = mysql_fetch_assoc($r))
{
	$flag=$row["flag"]; 
	echo $flag;
}
if($count==1 AND $flag<5 ){

$_SESSION['login'] = $username;
header("location:dashboard.php");

}
else {
mysql_query("
    UPDATE stock_management.users 
    SET flag = flag + 1
    WHERE username = '".$username."'
");
echo "<script language = \"javascript\">alert('Invalid Credentials')</script>";
echo "<script>setTimeout(\"location.href = 'index.html';\",20);</script>";
}
}
?>