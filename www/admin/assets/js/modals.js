const modal_btn = document.querySelector(".modal_btn");
const close_modals = document.querySelector(".close-modals");
const cancel_modals = document.querySelector(".cancel-modal");
const overlay = document.querySelector(".overlay");
const modals = document.querySelector(".modals");

modal_btn.addEventListener("click", (e) => {
  overlay.classList.remove("hidden");
  modals.classList.remove("hidden");
  e.preventDefault();
});

overlay.addEventListener("click", (e) => {
  overlay.classList.add("hidden");
  modals.classList.add("hidden");
  e.preventDefault();
});

close_modals.addEventListener("click", (e) => {
  overlay.classList.add("hidden");
  modals.classList.add("hidden");
  e.preventDefault();
});
