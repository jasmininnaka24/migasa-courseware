let images2 = ["../../../assets/img/canva_1.png", "../../../assets/img/canva_2.png", "../../../assets/img/canva_3.png", "../../../assets/img/canva_4.png"];
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
}, 10000);