const navbarToggleBtn = document.querySelector('#navbarToggleBtn');
const navbarContent = document.querySelector('#navbarContent');

navbarToggleBtn.addEventListener('click', () => {
  navbarContent.classList.toggle('show');
});