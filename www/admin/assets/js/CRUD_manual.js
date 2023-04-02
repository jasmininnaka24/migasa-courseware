document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});
const fileInput = document.querySelector("#manual_pdf");
const dropZoneText = document.querySelector(".drop-zone__text");

fileInput.addEventListener("change", () => {
  if (fileInput.files.length > 0) {
    dropZoneText.textContent = fileInput.files[0].name;
  } else {
    dropZoneText.textContent = "Drop file here or click to upload";
  }
});

const updateFileInput = document.getElementById("manual_pdf");
const textDisplay = document.getElementById("file-display");

fileInput.addEventListener("change", function () {
  const fileName = fileInput.value.split("\\").pop(); // extract file name from input value
  textDisplay.innerHTML = fileName; // update text display with file name
});
