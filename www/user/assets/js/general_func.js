window.addEventListener("keydown", function (event) {
  if (event.keyCode === 116) {
    event.preventDefault();
  }
});

// window.onload = function () {
//   window.scrollTo(0, document.body.scrollHeight);
// };

let preventFromReload = (e) => {
  e.preventDefault();
};

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();

    document.querySelector(this.getAttribute("href")).scrollIntoView({
      behavior: "smooth",
    });
  });
});
