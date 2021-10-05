const axios = require("axios");

// This stays constant with my key
const config = { "x-apisports-key": "569fd3056fbfd09a47a568e3b82163f7" };

const getPlayer = () => {
  const player = "werner"; // this probably needs to be processed
  const league = "39";
  const season = "2021";

  const url = "https://v3.football.api-sports.io/players";
  const params = { search: player, league: league, season: season };
  axios
    .get(url, { headers: config, params: params })
    .then((response) => {
      processPlayer(response.data.response[0].statistics[0].team.id);
    })
    .catch((error) => {
      console.log(error);
    });
};

// get team id for the player, send request to /fixtures with params {team: teamID, last: 1}. receive fixture ID

const processPlayer = (teamID) => {
  const url = "https://v3.football.api-sports.io/fixtures";
  const params = { team: teamID, season: "2021", last: "1" };
  axios
    .get(url, { headers: config, params: params })
    .then((response) => {
      const fixtureID = response.data.response[0].fixture.id;
      processFixture(fixtureID, teamID);
    })
    .catch((error) => {
      console.log(error);
    });
};

// send request to /fixtures/players with param {fixture: fixtureID, team: teamID}
// parse that response for stats for that player for most recent match
const processFixture = (fixtureID, teamID) => {
  const url = "http://v3.football.api-sports.io/fixtures/players";
  const params = { fixture: fixtureID, team: teamID };
  axios
    .get(url, { headers: config, params: params })
    .then((response) => {
      const playerArray = response.data.response[0].players;
      playerArray.forEach((player) => {
        console.log(player.player.name);
      });
    })
    .catch((error) => {
      console.log(error);
    });
};
getPlayer();
