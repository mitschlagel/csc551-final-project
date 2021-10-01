function displayTable() {
  const league = document.querySelector("#league").value;

  const tableContainer = document.querySelector(".table-main");
  tableContainer.innerHTML = "";
  const table = document.createElement("div");
  table.classList.add("league-table");
  tableContainer.appendChild(table);
  table.innerHTML = league;
}

window.addEventListener("DOMContentLoaded", () => {
  document
    .querySelector("select")
    .addEventListener("input", () => displayTable());
});
