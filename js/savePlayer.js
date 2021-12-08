// Function to parse the userLog cookie for the user name
const parseCookie = (cookieName) => {
  const regex = new RegExp(cookieName + "=([^;]+)");
  const value = regex.exec(document.cookie);
  return value != null ? unescape(value[1]) : null;
};

// jQuery function to take data from a player search result and POST it to the mysql data base via php script
$(document).ready(function () {
  $(document).on("click", ".did-they-play", function () {
    const user = parseCookie("userLog");

    // if logged in:
    if (user) {
      const data = {
        player_id: $("#player_id").text(),
        first_name: $("#first_name").text(),
        last_name: $("#last_name").text(),
        appearances: $("#appearances").text(),
        minutes: $("#minutes").text(),
        goals: $("#goals").text(),
        assists: $("#assists").text(),
        userName: user,
      };
      // JSON.stringify() takes an object and encodes it into a json string for easier transmission
      const dataString = JSON.stringify(data);

      // This ajax call takes our json string and sends it to a php script that forwards the data on to the mysql database
      $.ajax({
        type: "POST",
        url: "../php/followPlayer.php",
        data: { data: dataString },
        success: function (response) {
          console.log(response);
          console.log(dataString);
          alert(`You are now following ${data.first_name} ${data.last_name}`);
        },
      });
    } else {
      alert("You must be logged in to follow players.");
    }
  });
});
