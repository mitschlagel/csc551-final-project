const getStats = () => {
  // get search terms from user
  const player = document.querySelector("#player-name").value; // this probably needs to be processed
  const league = document.querySelector("#league-name").value;

  // generate this url based on user input
  const url = "https://v3.football.api-sports.io/players";

  // This stays constant with my key
  const config = { "x-apisports-key": "569fd3056fbfd09a47a568e3b82163f7" };
  const params = { search: player, league: league };
  return (
    axios
      .get(url, { headers: config, params: params })
      .then((response) => response.data)
      // .then((data) => data.response[0])
      .catch((error) => {
        console.log(error);
      })
  );
};

document
  .querySelector("#player-search-submit")
  .addEventListener("click", () => {
    const playerDataArray = getStats();
    console.log(playerDataArray);
    playerDataArray.then((data) => console.log(data));
  });
