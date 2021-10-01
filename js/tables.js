function displayTable() {
  const league = document.querySelector("#league").value;

  const tableToDisplay = document.createElement("article");

  const tableContainer = document.querySelector(".table-main");
  tableContainer.innerHTML = "";
  tableContainer.appendChild(tableToDisplay);

  console.log(league);
  tableToDisplay.innerHTML = `
  <div
  id="wg-api-football-standings"
  data-host="v3.football.api-sports.io"
  data-league="${league}"
  data-team=""
  data-season="2021"
  data-key="569fd3056fbfd09a47a568e3b82163f7"
  data-theme=""
  data-show-errors="false"
  class="api_football_loader"
></div>
<script
      type="module"
      src="https://widgets.api-sports.io/football/1.1.8/widget.js"
    ></script>

  `;
}

document
  .querySelector("#table-select-button")
  .addEventListener("click", () => displayTable());
