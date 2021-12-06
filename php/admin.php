<?php
  include ("connectToDB.inc");
  function getUserAdmin(){
    $dataBase = connectDB();
  
    $queryAdmin  = 'SELECT * FROM users ORDER BY username';
    $resultAdmin = mysqli_query($dataBase, $queryAdmin) or die('Query failed: '.mysqli_error($dataBase));
    while ($lineAdmin = mysqli_fetch_array($resultAdmin, MYSQL_ASSOC)) {
      extract($lineAdmin);
      if($Username==$_COOKIE['userLog']){
        return $Admin;
      }
    }
    return 0;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>didtheyplay.soccer</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/mobile.css" />
	<style>
		  .login-register-buttons{
        <?php
          if(isset($_COOKIE['userLog'])){
            echo "display:none;";
          }
        ?>
      }
      .logout-button{
        <?php
          if(isset($_COOKIE['userLog'])){
            echo "display:block;width:auto;";  
          }else{
            echo "display:none;";
          }
        ?>
      }
      .logout-button button{
        background-color: #f44336;
      }

      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td, th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #dddddd;
      }

      input[type="text"]{
        width: 20%;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }
	</style>
  </head>
  <body>
    <header>
      <div class="header-title">
        <img class="header-image" src="../img/ball.png" />
        <h1>didtheyplay.soccer?</h1>
        
        <!-- THESE ARE FOR THE LOGIN AND REGISTER BUTTONS -->
        <div class="login-register-buttons">
          <button onclick="document.getElementById('login-form').style.display='block'" style="width:auto;">Login</button>
          <button onclick="document.getElementById('register-form').style.display='block'" style="width:auto;">Register</button>
        </div>

        <!-- THIS IS THE LOG-OUT BUTTON -->
        <div class="logout-button">
          <button onclick="location.href='logout.php'">Log Out</button>
        </div>

      </div>
      <nav class="header-nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="players.php">Players</a></li>
          <li><a href="fixtures.php">Live Fixtures</a></li>
          <li><a href="user.php">User</a></li>
          <?php
            if(getUserAdmin()){
              echo '<li><a href="admin.php" id="this">Admin</a></li>';
            }
          ?>
        </ul>
      </nav>
    </header>
    <main>
        <section>
      
        <?php
          function showAllData() {
            $dataBase = connectDB();
          
            $queryUsers  = 'SELECT * FROM users ORDER BY username';
            $resultUsers = mysqli_query($dataBase, $queryUsers) or die('Query failed: '.mysqli_error($dataBase));
            echo "<br>All <i>users</i> Records:<br>";
            echo "<table>";
            echo "<tr> <th>Username</th> <th>Password</th> <th>Email</th> <th>Phone</th> <th>BirthDate</th> <th>Admin</th></tr>";
            while ($lineUsers = mysqli_fetch_array($resultUsers, MYSQL_ASSOC)) {extract($lineUsers);
              echo "<tr> <td>$Username</td> <td>$Password</td>  <td>$Email</td> <td>$Phone</td> <td>$BirthDate</td> <td>$Admin</td> </tr>";
            }
            echo "</table>";

            $queryPlayers  = 'SELECT * FROM player ORDER BY PlayerId';
            $resultPlayers = mysqli_query($dataBase, $queryPlayers) or die('Query failed: '.mysqli_error($dataBase));
            echo "<br>All <i>player</i> Records:<br>";
            echo "<table>";
            echo "<tr> <th>PlayerId</th> <th>First Name</th> <th>Last Name</th></tr>";
            while ($linePlayers = mysqli_fetch_array($resultPlayers, MYSQL_ASSOC)) {extract($linePlayers);
              echo "<tr> <td>$PlayerId</td>  <td>$FirstName</td> <td>$LastName</td></tr>";
            }
            echo "</table>";

            $queryFollow  = 'SELECT * FROM follow ORDER BY Username, PlayerId';
            $resultFollow = mysqli_query($dataBase, $queryFollow) or die('Query failed: '.mysqli_error($dataBase));
            echo "<br>All <i>follow</i> Records:<br>";
            echo "<table>";
            echo "<tr> <th>Username</th> <th>PlayerId</th> <th>Appearances</th> <th>Minutes</th> <th>Goals</th> <th>Assists</th></tr>";
            while ($lineFollow = mysqli_fetch_array($resultFollow, MYSQL_ASSOC)) {extract($lineFollow);
              echo "<tr> <td>$Username</td> <td>$PlayerId</td> <td>$Appearances</td> <td>$Minutes</td> <td>$Goals</td> <td>$Assists</td></tr>";
            }
            echo "</table>";
          
            mysqli_close($dataBase);
          
          }

          function deleteRecords() {
            $dataBase = connectDB();
            $q1='DELETE FROM ';
            $q2=' WHERE ';
            $query=$q1.$_POST['tableName1'].$q2.$_POST['attributeName1'].'="'.$_POST['attributeValue1'].'"';
            $result=mysqli_query($dataBase,$query) or die('Query failed: '.mysqli_error($dataBase));
            mysql_close($dataBase);
          }
          function updateRecords() {
            $dataBase = connectDB();
            $q1='UPDATE ';
            $q2=' SET ';
            $q3=' WHERE ';
            $query=$q1.$_POST['tableName2'].$q2.$_POST['attributeName2'].'='.$_POST['attributeValue2'].$q3.$_POST['attributeName3'].'="'.$_POST['attributeValue3'].'"';
            $result=mysqli_query($dataBase,$query) or die('Query failed: '.mysqli_error($dataBase));
            mysql_close($dataBase);
          }

          if(getUserAdmin()){
            if (isset($_POST['tableName1']) && isset($_POST['attributeName1']) && isset($_POST['attributeValue1'])) {
              deleteRecords();
              showAllData();
            } else if (isset($_POST['tableName2']) && isset($_POST['attributeName2']) && isset($_POST['attributeValue2']) && isset($_POST['attributeName3']) && isset($_POST['attributeValue3'])) {
              updateRecords();
              showAllData();
            } else {
              showAllData();
            }
            echo <<<END
            <h2>Below you can DELETE records from the tables above</h2>
            <form action="$_SERVER[PHP_SELF]" method="post">
              <p>DELETE FROM <input type="text" name="tableName1" value=""> </p>
              <p>WHERE <input type="text" name="attributeName1" value="">  = <input type="text" name="attributeValue1" value=""> </p>
              <input type='submit' value='Submit'>
            </form>
          END
          ;

          echo <<<END
            <h2>Below you can UPDATE records in the tables above</h2>
            <form action="$_SERVER[PHP_SELF]" method="post">
              <p>UPDATE <input type="text" name="tableName2" value=""> </p>
              <p>SET <input type="text" name="attributeName2" value=""> = <input type="text" name="attributeValue2" value=""> </p>
              <p>WHERE <input type="text" name="attributeName3" value=""> = <input type="text" name="attributeValue3" value=""> </p>
              <input type='submit' value='Submit'>
            </form>
          END
          ;
          }else{
            echo "<p>You are not an admin</p>";
          }

          

         
          
        ?>
        </section>

      <!-- THESE ARE FOR THE LOGIN AND REGISTER BUTTONS -->
      <section class="login-and-register">
        <div id="login-form" class="login-window">
          <form class="login-window-box animate" action="login.php" method="post">
            <div class="close-x-div">
              <span onclick="document.getElementById('login-form').style.display='none'" class="close">&times;</span>
            </div>
  
            <div class="login-info">
              <label for="username"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" required>
        
              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>
                
              <button type ="submit">Login</button>
              <button type ="reset" class="clearButton">Clear</button>
            </div>
        
            <div class="container" style="background-color:#f1f1f1">
              <span>Are you not <a href="">registered?</a></span>
            </div>
          </form>
        </div>
  
        <div id="register-form" class="register-window">
          <form class="register-window-box animate" action="register.php" method="post">
            <div class="close-x-div">
              <span onclick="document.getElementById('register-form').style.display='none'" class="close">&times;</span>
            </div>
  
            <div class="register-info">
              <label for="username"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" required>
        
              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>
  
              <label for="email"><b>E-Mail</b></label>
              <input type="email" placeholder="email@domain.com" name="email" required>
  
              <label for="phone"><b>Telephone</b></label>
              <input type="tel" placeholder="(###) ###-####" name="phone" pattern = "\(\d{3}\) +\d{3}-\d{4}" required>
         
              <label for="birthdate"><b>Date of Birth</b></label>
              <input type = "date" placeholder = "mm/dd/yyyy" name="birthdate" required>
                
              <button type ="submit">Register</button>
              <button type ="reset" class="clearButton">Clear</button>
            </div>
        
            <div class="container" style="background-color:#f1f1f1">
              <span>Are you already <a href="">registered?</a></span>
            </div>
          </form>
        </div>
      </section>
    </main>
    <footer>
      <div>
        All statistics provided by
        <a href="http://www.api-football.org">api-football</a>.
      </div>
      <div>
        Some icons made by
        <a href="https://www.freepik.com" title="Freepik">Freepik</a> from
        <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a
        >.
      </div>
    </footer>
  </body>
</html>