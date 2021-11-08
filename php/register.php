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
print($date_and_time); ?>
</p>

</body>
</html>