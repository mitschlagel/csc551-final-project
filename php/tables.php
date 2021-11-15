<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>didtheyplay.soccer</title>
    <link rel="stylesheet" href="../css/style.css" />
    <script src="../node_modules/axios/dist/axios.min.js"></script>
  </head>

  <body>
    <header>
      <div class="header-title">
        <img class="header-image" src="../img/ball.png" />
        <h1>didtheyplay.soccer?</h1>
        <!-- THESE ARE FOR THE LOGIN AND REGISTER BUTTONS -->
        <div class="login-register-buttons">
          <button
            onclick="document.getElementById('login-form').style.display='block'"
            style="width: auto"
          >
            Login
          </button>
          <button
            onclick="document.getElementById('register-form').style.display='block'"
            style="width: auto"
          >
            Register
          </button>
        </div>
      </div>
      <nav class="header-nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="players.php">Players</a></li>
          <li><a href="fixtures.php">Fixtures</a></li>
          <li><a href="tables.php" id="this">Tables</a></li>
          <li><a href="user.php">User</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <section class="title"><h2>Tables</h2></section>

      <section class="table-select">
        <label for="league">Choose a league:</label>
        <select id="league" name="league">
          <option selected="selected" disabled="disabled"></option>
          <option value="2" id="champions">UEFA Champions League</option>
          <option value="3" id="europa">UEFA Europa League</option>
          <option value="39" id="england">England - Premier League</option>
          <option value="78" id="germany">Germany - Bundesliga</option>
          <option value="140" id="spain">Spain - La Liga</option>
          <option value="61" id="france">France - Ligue 1</option>
          <option value="135" id="italy">Italy - Serie A</option>
        </select>
        <input value="Go" type="button" id="table-select-button"></input>
      </section>
      <section class="table-main"></section>
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

      <script
        type="module"
        src="https://widgets.api-sports.io/football/1.1.8/widget.js"
      ></script>
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
    <script src="../js/tables.js"></script>
  </body>
</html>
