const images = ['../assets/img/teacher_1.png', '../assets/img/teacher_2.png'];

// Preload images
const preloadImages = (urls) => {
  urls.forEach((url) => { 
    const img = new Image();
    img.src = url;
  });
};

preloadImages(images);

// Get the image element
const image = document.getElementById('image-slider');

// Set initial image source
let index = 0;
image.src = images[index];

// Change image source every 4.5 seconds
setInterval(() => {
  index++;
  if (index >= images.length) {
    index = 0;
  }
  image.style.opacity = 0;
  setTimeout(() => {
    image.src = images[index];
    image.style.opacity = 1;
  }, 500);
}, 4500);

