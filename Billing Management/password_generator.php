<?php
@include 'connection.php';
// Initialize Variables to Null.
$email ="";//Sender's email_iD.
$Error ="";
$successMessage ="";
// On Submitting Form Below Function Will Execute	
if(isset($_POST['submit']))
{
if (!($_POST["email"]==""))
{
$email =$_POST["email"];  // Calling Function To Remove Special Characters From E-mail
$email = filter_var($email, FILTER_SANITIZE_EMAIL);  // Sanitizing E-mail(Remove unexpected symbol like <,>,?,#,!, etc.)
if (filter_var($email, FILTER_VALIDATE_EMAIL))
{
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_"; // Generating Password
$password = substr( str_shuffle( $chars ), 8, 16 );
$password1= sha1($password);

$query = mysql_query("UPDATE stock_management.billing SET password='$password1' WHERE email_id='$email'");
$result = mysql_query("select username FROM stock_management.billing WHERE email_id='$email'");
$username = mysql_fetch_assoc($result);
if($query)
{
$to = $email;
$subject = 'Your New Password...';
// Let's Prepare The Message For E-mail.
$message = 'Hello User';
'Your new password : '.$password.' 
your username is : '.$username.'[username].
Now you can login with this password.';
// Send The Message Using mail() Function.
if(mail($to, $subject, $message ))
{
$successMessage = "New Password has been sent to your mail, Please check your mail and SignIn.";
echo "<script>alert('".$successMessage."')</script>"; 
}
}
}
else{
$Error = "Invalid Email";
echo "<script>alert('".$Error."')</script>"; 
}
}
else{
$Error = "Email is required";
echo "<script>alert('".$Error."')</script>"; 
}
}
?>