// Function for searching for and displaying statistics
const getStats = () => {
  // Pull values from form on the page
  const player = document.querySelector("#player-name").value;
  const league = document.querySelector("#league-name").value;
  const season = document.querySelector("#season").value;

  // This is the endpoint that returns stats on indidividual players
  const url = "https://v3.football.api-sports.io/players";

  // This is person api key for api-football
  const config = { "x-apisports-key": "569fd3056fbfd09a47a568e3b82163f7" };

  // Construct an object of search params out of the user inputs
  const params = { search: player, league: league, season: season };

  // Use axios to fire a GET request to api-football
  axios
    // GET takes two parameters -- the endpoint to call and a configuration object that contains the headers and query params
    .get(url, { headers: config, params: params })
    .then((response) => {
      // Check if player exists
      if (response.data.results == 0) {
        // Read the response and record the error message and the query that caused the error
        const errorMessage = response.data.errors.requests;
        const query = response.data.parameters.search;

        // Handle the api error
        displayErrors(errorMessage, query);
      } else {
        // Read response and put relevant part into stats variable
        const stats = response.data.response;

        // Handle the successful response
        displayStats(stats);
      }
    })

    // Handle the axios error, if there is one
    .catch((error) => {
      console.log(error);
    });
};

// Function that takes a json object and renders it to the DOM through an interpolated string
const displayStats = (statistics) => {
  const searchResults = document.querySelector(".players");
  searchResults.innerHTML = "";
  statistics.forEach((element) => {
    const playerProfile = document.createElement("section");
    playerProfile.classList.add("player-profile");

    searchResults.appendChild(playerProfile);
    console.log(element.player);
    console.log(element.statistics[0]);
    const bio = element.player;
    const stats = element.statistics[0];
    const birthday = new Date(bio.birth.date);
    const player_id = element.player.id;
    playerProfile.innerHTML = `<div class="player-profile-header">
    <h2><span id="first_name">${bio.firstname}</span>
    <span id="last_name">${bio.lastname}</span></h2>
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
          <li>Player ID: <span id="player_id">${player_id}</span></li>
          <li>Date of Birth: ${birthday.toLocaleDateString()} </li>
          <li>Age: ${bio.age} years old</li>
          <li>Nationality: ${bio.nationality}</li>
          <li>Position: ${stats.games.position}</li>
        </ul>
      </div>
      <div class="bio-stats">
        

        <ul>
          
          <li>Total Appearences: <span id="appearances">${
            stats.games.appearences
          }</span></li>
          <li>Total Minutes: <span id="minutes">${
            stats.games.minutes
          }</span></li>
          <li>Goals: <span id="goals">${stats.goals.total}</span></li>
          <li>Assists: <span id="assists">${
            stats.goals.assists || "0"
          }</span></li>
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

// Function that handles errors returned by api-football
const displayErrors = (errorMessage, query) => {
  const searchResults = document.querySelector(".players");
  searchResults.innerHTML = "";
  const error = document.createElement("section");
  searchResults.appendChild(error);

  const message =
    errorMessage === undefined
      ? `No results found for <b>${query}</b>, please try again`
      : errorMessage;
  error.innerHTML = `
  <div class="player-search-error">${message}</div>`;
};

// Event listener that fires this script when user clicks submit
document
  .querySelector("#player-search-submit")
  .addEventListener("click", () => getStats());
