const cardButtons = document.querySelectorAll(".card-button");

cardButtons.forEach((button) => {
    const link = button.dataset.link;
    button.addEventListener("click", () => { handleButtonClick(link); });
});

function handleButtonClick(link) {
    location.href = link;
}