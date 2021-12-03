// else connect to database
// get player id
// send player id to api for stats
// put player id and names into player table, stats updated into follow table
// DONT FORGET TO UPDATE THE TABLES PAGE -- just champions league?
// connection.connect(function (error) {
//   if (error) throw error;
//   console.log("Connected!");
const parseCookie = (cookieName) => {
  const regex = new RegExp(cookieName + "=([^;]+)");
  const value = regex.exec(document.cookie);
  return value != null ? unescape(value[1]) : null;
};

$(document).ready(function () {
  $(document).on("click", ".did-they-play", function () {
    // if logged in:
    const user = parseCookie("userLog");

    if (user) {
      const data = {
        player_id: $("#player_id").text(),
        first_name: $("#first_name").text(),
        last_name: $("#last_name").text(),
        appearences: $("#appearences").text(),
        minutes: $("#minutes").text(),
        goals: $("#goals").text(),
        assists: $("#assists").text(),
        userName: user,
      };

      const dataString = JSON.stringify(data);

      $.ajax({
        type: "POST",
        url: "../php/followPlayer.php",
        data: { data: dataString },
        success: function (response) {
          console.log(response);
          console.log(dataString);
        },
      });
    } else {
      alert("You must be logged in to follow players.");
    }
  });
});
