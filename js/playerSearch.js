import getStats from "./getStats";

const searchButton = document.querySelector("#player-search-submit");

searchButton.addEventListener("click", () => {
  console.log(document.querySelector("#player-name").value);
  const playerToSearch = document.querySelector("#player-name");
  console.log(playerToSearch);
  // console.log(getStats(playerToSearch, 78));
});
