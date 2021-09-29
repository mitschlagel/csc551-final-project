function displayTable() {
  const league = document.querySelector("#league").value;
  const widget = `
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
          >${league}</div>
        
        <script
        type="module"
        src="https://widgets.api-sports.io/football/1.1.8/widget.js"
      ></script>`;

  const tableContainer = document.querySelector(".table-main");
  tableContainer.innerHTML = "";
  const table = document.createElement("div");
  table.classList.add("league-table");
  tableContainer.appendChild(table);
  table.innerHTML = widget;
}

window.addEventListener("DOMContentLoaded", () => {
  document
    .querySelector("select")
    .addEventListener("input", () => displayTable());
});
