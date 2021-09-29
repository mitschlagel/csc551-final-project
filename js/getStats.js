// get search terms from user

const getStats = () => {
  const player = document.querySelector("#player-name").value; // this probably needs to be processed
  const league = document.querySelector("#league-name").value;
  const season = document.querySelector("#season").value;
  const url = "https://v3.football.api-sports.io/players";

  // This stays constant with my key
  const config = { "x-apisports-key": "569fd3056fbfd09a47a568e3b82163f7" };

  //params base on user input
  const params = { search: player, league: league, season: season };

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
  const searchResults = document.querySelector(".players");
  searchResults.innerHTML = "";
  stats.forEach((element) => {
    const playerProfile = document.createElement("section");
    playerProfile.classList.add("player-profile");

    searchResults.appendChild(playerProfile);
    console.log(element.player);
    console.log(element.statistics[0]);
    const bio = element.player;
    const stats = element.statistics[0];
    const birthday = new Date(bio.birth.date);
    playerProfile.innerHTML = `<div class="player-profile-header">
    <h2>${bio.firstname} ${bio.lastname}</h2>
  </div>
  <div class="player-profile-body">
    <div class="name-photo">
      <img id="player-photo"
        src="${bio.photo}"
      />
      <div class="did-they-play">FOLLOW</div>
    </div>
    <div class="bio-info">
      <div>
        <ul>
          <li>Date of Birth: ${birthday.toLocaleDateString()} </li>
          <li>Age: ${bio.age} years old</li>
          <li>Nationality: ${bio.nationality}</li>
          <li>Position: ${stats.games.position}</li>
        </ul>
      </div>
      <div class="bio-stats">
        <!-- look at api response, if minutes or appearences YES and green, else, red and NO -->

        <ul>
          
          <li>Total Appearences: ${stats.games.appearences}</li>
          <li>Total Minutes: ${stats.games.minutes}</li>
          <li>Goals: ${stats.goals.total}</li>
          <li>Assists: ${stats.goals.assists || "0"}</li>
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
        
          <img id="flag" src="${
            stats.league.flag == null
              ? "img/european-union.png"
              : stats.league.flag
          }"
          />
          ${stats.league.country === "World" ? "Europe" : stats.league.country}
        </li>
      </ul>
    </div>
  </div>`;
  });
};

document
  .querySelector("#player-search-submit")
  .addEventListener("click", () => getStats());
