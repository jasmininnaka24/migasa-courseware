let images = ["../../../assets/img/pinoyflag.png", "../../../assets/img/barong.png", "../../../assets/img/filipina.png", "../../../assets/img/flag_filipino.png", "../../../assets/img/ph.png"];
let currentIndex = 0;
let image = document.getElementById("image");

// Set the opacity of the first image to 1 so it doesn't fade out
image.classList.add("first-image");

setInterval(() => {
currentIndex = (currentIndex + 1) % images.length;
let nextImage = new Image();
nextImage.src = images[currentIndex];
nextImage.onload = () => {
image.classList.remove("active");
image.classList.remove("first-image");
image.style.opacity = 1;
setTimeout(() => {
image.style.opacity = 0;
image.src = nextImage.src;
setTimeout(() => {
image.style.opacity = 1;
image.classList.add("active");
}, 100);
}, 100);
};
}, 4500);

let images2 = ["../../../assets/img/english.png", "../../../assets/img/queen.png", "../../../assets/img/king.png", "../../../assets/img/england.png", "../../../assets/img/britain.png"];
let currentImageIndex2 = 0;
let image2 = document.getElementById("image2");

// Set the opacity of the first image to 1 so it doesn't fade out
image2.classList.add("first-image");

setInterval(() => {
currentImageIndex2 = (currentImageIndex2 + 1) % images2.length;
let nextImage2 = new Image();
nextImage2.src = images2[currentImageIndex2];
nextImage2.onload = () => {
image2.classList.remove("active");
image2.classList.remove("first-image");
image2.style.opacity = 1;
setTimeout(() => {
image2.style.opacity = 0;
image2.src = nextImage2.src;
setTimeout(() => {
image2.style.opacity = 1;
image2.classList.add("active");
}, 100);
}, 100);
};
}, 4500);