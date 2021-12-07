const parseCookie = (cookieName) => {
  const regex = new RegExp(cookieName + "=([^;]+)");
  const value = regex.exec(document.cookie);
  return value != null ? unescape(value[1]) : null;
};

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

      const dataString = JSON.stringify(data);

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
