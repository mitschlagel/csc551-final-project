<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>didtheyplay.soccer</title>
    <link rel="stylesheet" href="../css/style.css" />
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

      </div>
      <nav class="header-nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="players.php">Players</a></li>
          <li><a href="fixtures.php">Fixtures</a></li>
          <li><a href="tables.php">Tables</a></li>
          <li><a href="user.php" id="this">User</a></li>
        </ul>
      </nav>
    </header>
    <main>
        <section>
      
        <?php

            
            function deletePlayer($playerNumber) {
                include("connectToDB.inc");
                $dataBase = connectDB();
                $qy1=$_COOKIE['userLog'];
                $query='DELETE FROM follow WHERE username="'.$qy1.'" AND PlayerId="'.$playerNumber.'";';
                $result=mysqli_query($dataBase,$query) or die('Query failed: '.mysqli_error($dataBase));
                mysql_close($dataBase);
            }

            function showDeletedPlayer($playerNumber) {
              $fn="";$ln="";
              $dataBase = connectDB();
              $query2='SELECT * FROM player WHERE PlayerId='.$playerNumber.';';
              $result2=mysqli_query($dataBase,$query2) or die('Query failed: '.mysqli_error($dataBase));
              while ($row = mysqli_fetch_array($result2, MYSQL_ASSOC))
              {
                extract($row);
                $fn=$FirstName;
                $ln=$LastName;
              }
              echo "The player $fn $ln has been correctly deleted";
              mysql_close($dataBase);
            }

            if(isset($_GET['followPlayerId'])){
              $playerSel=$_GET['followPlayerId'];
              deletePlayer($playerSel);
              showDeletedPlayer($playerSel);
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