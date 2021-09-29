document.body.addEventListener("DOMNodeInserted", () => {
  const savePlayerButton = document.querySelector(".did-they-play");

  savePlayerButton.onclick = () => {
    alert("You must be logged in to follow players.");
  };
});
