<!DOCTYPE html>

<html>
   <head>
      <meta charset="utf-8">
      <title>didtheyplay.soccer</title>
      <link rel="stylesheet" href="css/style.css" />
   </head>
   <body>

<p>Registration Summary: </br> 
Your username: <?php print($_POST['username']); ?> </br>
Password: <?php print($_POST['password']); ?> </br>
Email address is: <?php print($_POST['email']); ?> </br> 
Telephone Number is: <?php print($_POST['phone']); ?> </br> 
Your birthdate is: <?php print($_POST['birthdate']); ?> </br> 
Your registration time is: 
<?php 
date_default_timezone_set('US/Central');
$date_and_time = date("l, F d Y g:i:s a");
print($date_and_time); ?></br>

<?php
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$birthdate=$_POST['birthdate'];
 
$dbConnection=mysqli_connect("sql304.epizy.com","epiz_29507824","TKiNcSS1UvTF9V", "epiz_29507824_soccer");
$q1='INSERT INTO users VALUES("';
$q2='","';
$q3='");';
$query=$q1.$username.$q2.$password.$q2.$email.$q2.$phone.$q2.$birthdate.$q3;
$result=mysqli_query($dbConnection,$query) or die('Query failed: '.mysqli_error($dbConnection))
?>
</p>

</body>
</html>