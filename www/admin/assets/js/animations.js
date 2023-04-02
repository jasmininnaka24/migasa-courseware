const element = document.querySelector('.font-med');
setTimeout(() => {
  element.removeAttribute('hidden');
  element.classList.add('fade-in');
}, 1000);
