const mysql = require("mysql");

const connection = mysql.createConnection({
  host: "127.0.0.1",
  user: "root",
  password: "mYsQ1066!",
});

connection.connect(function (error) {
  if (error) throw error;
  console.log("Connected");
});
