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
    <script src="../node_modules/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
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
          <li><a href="players.php" id="this">Players</a></li>
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
      <section class="title">
        <h2>Players</h2>
        <p>
          Enter a player's last name to display their most recent statistics.
        </p>
      </section>
      <section class="player-search-form">
        <div class="player-form-section">
          <label for="player-name">Name:</label>
          <input type="search" id="player-name" pattern="/\s/g" required />
        </div>
        <div class="player-form-section">
          <label for="league-name">League:</label>
          <select id="league-name" name="league-name" required>
            <option selected="selected" disabled="disabled"></option>
            <option value="2" id="champions">UEFA Champions League</option>
            <option value="3" id="europa">UEFA Europa League</option>
            <option value="39" id="england">England - Premier League</option>
            <option value="78" id="germany">Germany - Bundesliga</option>
            <option value="140" id="spain">Spain - La Liga</option>
            <option value="61" id="france">France - Ligue 1</option>
            <option value="135" id="italy">Italy - Serie A</option>
          </select>
        </div>
        <div class="player-form-section">
          <label for="season">Season:</label>
          <select id="season" name="season" required>
            <option value="2021" id="2021" selected="selected">
              2021-2022
            </option>
            <option value="2020" id="2020">2020-2021</option>
            <option value="2019" id="2019">2019-2020</option>
          </select>
        </div>
        <div class="player-form-section">
          <input id="player-search-submit" value="Search" type="button"></input>
        </div>
      </section>
      <section class="players"></section>
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

    <script src="../js/getStats.js"></script>
    <script src="../js/savePlayer.js"></script>
  </body>
</html>
