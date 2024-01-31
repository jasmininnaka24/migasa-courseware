// Define an array of image URLs
// const images = [
//     "../../../user/assets/img/BIT TYP LOGO.png",
//     "../../../user/assets/img/g_peopl1.png",
//     "../../../user/assets/img/g_people2.png"
//   ];
  
//   // Initialize the current image index
//   let currentImageIndex = 0;
  
//   // Get references to the navigation buttons
//   const prevButton = document.querySelector('.btn-prev');
//   const nextButton = document.querySelector('.btn-next');
  
//   // Get a reference to the card image element
//   const cardImage = document.querySelector('.card-img-top');
  
//   // Update the card image with the current image URL
//   cardImage.src = images[currentImageIndex];
  
//   // Add event listeners to the navigation buttons
//   prevButton.addEventListener('click', function() {
//     if (currentImageIndex > 0) {
//       currentImageIndex--;
//       cardImage.src = images[currentImageIndex];
//     }
//   });
  
//   nextButton.addEventListener('click', function() {
//     if (currentImageIndex < images.length - 1) {
//       currentImageIndex++;
//       cardImage.src = images[currentImageIndex];
//     }
//   });

// // Get a reference to the download link
// const downloadLink = document.getElementById('download-link');

// // Add an event listener to the download link
// downloadLink.addEventListener('click', function() {
//   // Set the download URL to the current image URL
//   downloadLink.href = cardImage.src;
// });