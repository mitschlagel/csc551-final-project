document.body.addEventListener("DOMNodeInserted", () => {
  const savePlayerButton = document.querySelector(".did-they-play");
  const mysql = require("mysql");

  const connection = mysql.createConnection({
    host: "127.0.0.1",
    user: "root",
    password: "mYsQ1066!",
  });

  savePlayerButton.onclick = () => {
    alert("You must be logged in to follow players.");
    connection.connect(function (error) {
      if (error) throw error;
      console.log("Connected");
    });
  };
});
