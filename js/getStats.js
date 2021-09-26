// get search terms from user

const getStats = () => {
  const player = document.querySelector("#player-name").value; // this probably needs to be processed
  const league = document.querySelector("#league-name").value;
  const url = "https://v3.football.api-sports.io/players";

  // This stays constant with my key
  const config = { "x-apisports-key": "569fd3056fbfd09a47a568e3b82163f7" };

  //params base on user input
  const params = { search: player, league: league };

  axios
    .get(url, { headers: config, params: params })
    .then((response) => {
      const stats = response.data.response;
      displayStats(stats);
    })
    .catch((error) => {
      console.log(error);
    });
};

const displayStats = (stats) => {
  stats.forEach((element) => {
    const playerProfile = document.createElement("section");
    playerProfile.classList.add("player-profile");
    document.body.appendChild(playerProfile);

    console.log(element.player);
    console.log(element.statistics[0]);
    const bio = element.player;
    const stats = element.statistics[0];
    playerProfile.innerHTML = `<div class="player-profile-header">
    <h2>${bio.firstname} ${bio.lastname}</h2>
  </div>
  <div class="player-profile-body">
    <div class="name-photo">
      <img
        src="${bio.photo}"
      />
    </div>
    <div class="bio-info">
      <div>
        <ul>
          <li>DOB (age): ${bio.birth.date} (${bio.age})</li>
          <li>Nationality: ${bio.nationality}</li>
          <li>Position: ${stats.games.position}</li>
        </ul>
      </div>
      <div class="bio-stats">
        <!-- look at api response, if minutes or appearences YES and green, else, red and NO -->

        <ul>
          <li>Did they play? <span class="did-they-play">YES</span></li>
          <li>Total appearences: ${stats.games.appearences}</li>
          <li>Total Minutes: ${stats.games.minutes}</li>
          <li>Goals: ${stats.goals.total}</li>
          <li>Assists: ${stats.goals.assists}</li>
        </ul>
      </div>
    </div>
    <div class="club-info">
      <img
        id="club-logo"
        src="${stats.team.logo}"
      />
      <ul>
        <li>${stats.team.name}</li>
        <li>
          <img
            id="league-logo"
            src="${stats.league.logo}"
          />
          ${stats.league.name}
        </li>
        <li>
          <img id="flag" src="${stats.league.flag}" />
          ${stats.league.country}
        </li>
      </ul>
    </div>
  </div>`;
  });
};

document
  .querySelector("#player-search-submit")
  .addEventListener("click", () => getStats());
