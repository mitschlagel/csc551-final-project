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

      .button {
        background-color: #f44336;
        color: white;
        padding: 7px 10px;
        margin: 8px 0;
        border: solid;
        cursor: pointer;
        width: 100%;
        text-decoration: none;
      }

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
          <li><a href="fixtures.php">Fixtures</a></li>
          <li><a href="tables.php">Tables</a></li>
          <li><a href="" id="this">User</a></li>
          <?php
            if(getUserAdmin()){
              echo '<li><a href="admin.php">Admin</a></li>';
            }
          ?>
        </ul>
      </nav>
    </header>
    <main>
      <section>
      
        <?php 

        $loggedIn=false;
        $u=$_COOKIE['userLog'];
        if(isset($u)){
            $loggedIn=true;
        }

        if($loggedIn==false){
            echo "<p> You have to log-in first </p>";
        }else{
          $dataBase = connectDB();
          $query='SELECT * FROM follow JOIN player on follow.playerId=player.playerId;';
          $result=mysqli_query($dataBase,$query) or die('Query failed: '.mysqli_error($dataBase));
         
          echo "<h3 align='center'>Welcome $u</br></h3>";

          echo  "<table>
                  <tr>
                    <th>Player Name</th>
                    <th>Appearances</th>
                    <th>Minutes</th>
                    <th>Goals</th>
                    <th>Assists</th>
                    <th>Delete Option</th>
                  </tr>";

          while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
          {
          extract($row);

              if($Username==$_COOKIE['userLog']){
                define("DAY",60*60*24);
                setcookie("selectedPlayer",$PlayerId,time()+DAY);

                echo  "<tr>
                        <td>$FirstName $LastName</td>
                        <td>$Appearances</td>
                        <td>$Minutes</td>
                        <td>$Goals</td>
                        <td>$Assists</td>
                        <td><a href='delete.php?followPlayerId=$PlayerId' class='button'>Delete</a></td>
                      </tr>";
              } 
              
          }
          echo "</table>";

          mysql_close($dataBase);

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