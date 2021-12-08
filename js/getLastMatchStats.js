// NOTE: We did not end up using this script but it was a lot of fun to build so we are leaving it in the repo.

const axios = require("axios");

// This stays constant with my key
const config = { "x-apisports-key": "569fd3056fbfd09a47a568e3b82163f7" };

// this is the data we need to save for each user's fav players
// change these here to play around and search for different players.
// league ids are listed in the readme
const playerQuery = {
  player: "salah",
  league: "39",
  season: "2021",
};

const getPlayer = ({ player, league, season }) => {
  const url = "https://v3.football.api-sports.io/players";
  const params = { search: player, league: league, season: season };
  axios
    .get(url, { headers: config, params: params })
    .then(({ data }) => {
      const playerInfo = data.response[0];
      const teamID = data.response[0].statistics[0].team.id;
      getFixture(teamID, playerInfo);
    })
    .catch((error) => {
      console.log(error);
    });
};

// get team id for the player, send request to /fixtures with params {team: teamID, last: 1}. receive fixture ID

const getFixture = (teamID, playerInfo) => {
  const url = "https://v3.football.api-sports.io/fixtures";
  const params = { team: teamID, season: "2021", last: "1" };
  axios
    .get(url, { headers: config, params: params })
    .then(({ data }) => {
      const fixtureID = data.response[0].fixture.id;
      const matchInfo = data.response[0];
      //console.log(playerInfo);
      processFixture(fixtureID, teamID, playerInfo, matchInfo);
    })
    .catch((error) => {
      console.log(error);
    });
};

// send request to /fixtures/players with param {fixture: fixtureID, team: teamID}
// parse that response for stats for that player for most recent match
const processFixture = (fixtureID, teamID, playerInfo, matchInfo) => {
  const url = "http://v3.football.api-sports.io/fixtures/players";
  const params = { fixture: fixtureID, team: teamID };
  axios
    .get(url, { headers: config, params: params })
    .then(({ data }) => {
      const info = {
        fixture: matchInfo,
        player: playerInfo,
        team: data.response,
      };
      displayLastMatchStats(info);
      // const responseObject = data.response[0];
      // let playerInRoster = false;
      // responseObject.players.forEach(({ player, statistics }) => {
      //   if (player.id == playerInfo.player.id) {
      //     playerInRoster = true;
      //     const stats = statistics[0];
      //     console.log(player.name);

      //     const date = new Date(matchInfo.fixture.date);
      //     console.log(date.toLocaleString());
      //     console.log(
      //       `${matchInfo.teams.home.name} ${matchInfo.goals.home} | ${matchInfo.goals.away} ${matchInfo.teams.away.name}`
      //     );
      //     console.log(stats);
      //   }
      // });
      // if (!playerInRoster) {
      //   console.log(`${playerInfo.player.name} was not in the game day squad.`);
      // }
    })

    .catch((error) => {
      console.log(error);
    });
};

getPlayer(playerQuery);

const displayLastMatchStats = ({ fixture, player, team }) => {
  // const displayContainer = document.querySelector(".favorite-player-display");
  // displayContainer.innerHTML = "";
  // const playerDataDisplay = document.createElement("div");
  // displayContainer.appendChild(playerDataDisplay);
  // displayContainer.innerHTML = `<h1>${player.name}</h1>`;
  //make this look like the fifa player match report
  console.log(fixture);
  console.log(team);
  console.log(player);
};
