let sidebar = document.querySelector(".sidebar");
let close = document.querySelector(".close");
let sidebarBtn = document.querySelector(".bx-menu-alt-left");
let xBtn = document.querySelector(".fa-circle-xmark");

sidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
  sidebarBtn.classList.toggle("hidden");
  xBtn.classList.toggle("hidden");
});

xBtn.addEventListener("click", () => {
  close.classList.toggle("close");
  xBtn.classList.toggle("hidden");
  sidebarBtn.classList.toggle("hidden");
});
