const axios = require("axios");

// This stays constant with my key
const config = { "x-apisports-key": "569fd3056fbfd09a47a568e3b82163f7" };

// this is the data we need to save for each user's fav players
// change these here to play around and search for different players.
// league ids are listed in the readme
const playerQuery = {
  player: "pulisic",
  league: "39",
  season: "2021",
};

const getPlayer = ({ player, league, season }) => {
  const url = "https://v3.football.api-sports.io/players";
  const params = { search: player, league: league, season: season };
  axios
    .get(url, { headers: config, params: params })
    .then((response) => {
      const playerID = response.data.response[0].player.id;
      const teamID = response.data.response[0].statistics[0].team.id;
      const playerQuery = response.data.response[0].player.name;
      processPlayer(teamID, playerID, playerQuery);
    })
    .catch((error) => {
      console.log(error);
    });
};

// get team id for the player, send request to /fixtures with params {team: teamID, last: 1}. receive fixture ID

const processPlayer = (teamID, playerID, playerQuery) => {
  const url = "https://v3.football.api-sports.io/fixtures";
  const params = { team: teamID, season: "2021", last: "1" };
  axios
    .get(url, { headers: config, params: params })
    .then(({ data }) => {
      const fixtureID = data.response[0].fixture.id;

      processFixture(fixtureID, teamID, playerID, playerQuery);
    })
    .catch((error) => {
      console.log(error);
    });
};

// send request to /fixtures/players with param {fixture: fixtureID, team: teamID}
// parse that response for stats for that player for most recent match
const processFixture = (fixtureID, teamID, playerID, playerQuery) => {
  const url = "http://v3.football.api-sports.io/fixtures/players";
  const params = { fixture: fixtureID, team: teamID };
  axios
    .get(url, { headers: config, params: params })
    .then(({ data }) => {
      const responseObject = data.response[0];
      let playerInRoster = false;
      responseObject.players.forEach(({ player, statistics }) => {
        if (player.id == playerID) {
          playerInRoster = true;
          const stats = statistics[0];
          console.log(player.name);
          console.log(stats);
        }
      });
      if (!playerInRoster) {
        console.log(`${playerQuery} was not in the game day squad.`);
      }
    })

    .catch((error) => {
      console.log(error);
    });
};

getPlayer(playerQuery);
