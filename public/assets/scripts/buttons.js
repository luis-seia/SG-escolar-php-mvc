// Adds event listener to all buttons on the page
const buttons = document.querySelectorAll(".button");

buttons.forEach((button) => {
    const link = button.dataset.link;
    button.addEventListener("click", () => { handleButtonClick(link); });
});

function handleButtonClick(link) {
    location.href = link;
}