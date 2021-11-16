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
            
      @media only screen and (max-width: 600px) {
        li > a {
          font-size: 1.25rem;
          letter-spacing: 1px;
        }
        header h1 {
          font-size: 2rem;
        }
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
          <li><a href="index.php" id="this">Home</a></li>
          <li><a href="players.php">Players</a></li>
          <li><a href="fixtures.php">Fixtures</a></li>
          <li><a href="tables.php">Tables</a></li>
          <li><a href="user.php">User</a></li>
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
        <h2 style="text-align: center">Home</h2>
        <p style="text-align: center">
          Welcome to our project. We are bringing you an easy way to keep up
          with your favorite players.<br />
          Just go to the players tab and start looking for the player you want,
          with just his name and the competition he plays in.
        </p>
        <div>
          <img
            class="player-example"
            src="../img/fekir.png"
            alt="Example of a player search, with data from a player called Nabil Fekir"
            style="float: left"
          />
          <p style="padding: 80px 0; text-align: center">
            This is an example of what a player search would look like,<br />
            with all the information about that players, including his profile
            photo, and the team and league he plays for, and his stats.
          </p>
        </div>
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
