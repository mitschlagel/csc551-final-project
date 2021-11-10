<!DOCTYPE html>

<html>
   <head>
      <meta charset="utf-8">
      <title>didtheyplay.soccer</title>
      <link rel="stylesheet" href="css/style.css" />
   </head>
   <body>

<p>Login Summary: </br> 
Your username: <?php print($_POST['username']); ?> </br>
Password: <?php print($_POST['password']); ?> </br>
</p>


<?php 

$user=$_POST['username'];
$pass=$_POST['password'];

include("connectToDB.inc");
$dataBase = connectDB();
$query='SELECT * FROM users;';
$result=mysqli_query($dataBase,$query) or die('Query failed: '.mysqli_error($dataBase));
   $loggedIn=false;

   while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
   {
   extract($row); //so we can use $ord_id and $cust_id

      if($Username==$user && $Password==$pass){
         echo "<p> Username: $Username <br/>
            Email: $Email <br/>
            Phone: $Phone <br/>
            BirthDate: $BirthDate </p>";
         $loggedIn=true;
      } 
      
   }

   if($loggedIn==false){
      echo "<p> The email or password are incorrect </p>";
   }

mysql_close($dataBase);
?>

</body>
</html>