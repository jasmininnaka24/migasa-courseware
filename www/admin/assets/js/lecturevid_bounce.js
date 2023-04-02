// Initialize variables
var image = document.getElementById("moving-image");
var x = 0; // initial horizontal position
var y = 0; // initial vertical position
var xSpeed = 2; // horizontal speed
var ySpeed = 1; // vertical speed

// Define the animate function
function animate() {
  // Update the position of the image
  x += xSpeed;
  y += ySpeed;
  image.style.left = x + "px";
  image.style.top = y + "px";
  
  // Reverse the direction if the image hits the edge of the screen
  if (x < 0 || x + image.width > window.innerWidth) {
    xSpeed = -xSpeed;
  }
  if (y < 0 || y + image.height > window.innerHeight) {
    ySpeed = -ySpeed;
  }
  
  // Call the animate function again
  requestAnimationFrame(animate);
}

// Call the animate function to start the animation
animate();
