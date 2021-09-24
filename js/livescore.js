const getLiveScores = () => {
  const url = "";
  const config = { "x-apisports-key": "569fd3056fbfd09a47a568e3b82163f7" };

  axios
    .get(url, { headers: config })
    .then((response) => {
      console.log(response.data.response[0]);
      const player = response.data.response[0].player.name;
      //   document.write(`<h1>${player}</h1>`);
    })
    .catch((error) => {
      console.log(error);
    });
};
