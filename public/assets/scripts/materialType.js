const materialTypeContainers = document.querySelectorAll(".material-type-image-container");

materialTypeContainers.forEach((container) => {
    container.addEventListener("click", () => { handleMaterialTypeClick(container.dataset.link); })
});

function handleMaterialTypeClick(link) {
    location.href = link;
}