// ----------------------------------- LOGIN MODAL ----------------------------------- //
const ratingPopup = () => {
    const loginModal = document.querySelector(".rating-modal");
    const pageContainer = document.querySelector(".container");

    pageContainer.classList.add("blur");
    loginModal.classList.add("active");
}

const closeratingPopup = document.querySelector(".rating-modal .close");
closeratingPopup.addEventListener("click", () => {
    const loginModal = document.querySelector(".rating-modal");
    const pageContainer = document.querySelector(".container");

    pageContainer.classList.remove("blur");
    loginModal.classList.remove("active");
});