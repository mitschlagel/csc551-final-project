function changeLeague() {
  const select = document.querySelector("select");

  // Gets selected value from the dropdown
  const league = select.options[select.selectedIndex].value;

  // Picks div based on input
  const selectedTable = document.querySelector(`div[id='${league}']`);

  // Hide all other tables
  const otherTables = document.querySelectorAll(`.table:not(#${league}`);
  otherTables.forEach((node) => {
    node.classList.add("hide");
  });

  // Show desired table
  selectedTable.classList.remove("hide");
}
