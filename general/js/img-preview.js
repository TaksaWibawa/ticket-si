function handleFileUpload(input) {
  const uploadStatus = document.getElementById("upload-status");
  const imagePreview = document.getElementById("image-preview");
  const previousFile = uploadStatus.dataset.filename;

  if (input.files && input.files[0]) {
    const currentFile = input.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
      imagePreview.src = e.target.result;
    };

    reader.readAsDataURL(currentFile);

    if (previousFile === currentFile.name) {
      // File is the same as the previous one
      uploadStatus.textContent = "File unchanged";
    } else {
      // New file uploaded
      uploadStatus.textContent = "File uploaded";
      uploadStatus.dataset.filename = currentFile.name;
    }

    uploadStatus.classList.add("show"); // Show the alert
    imagePreview.classList.add("show"); // Show the image preview
    setTimeout(function () {
      uploadStatus.classList.remove("show"); // Hide the alert after 3 seconds
    }, 3000);
  } else {
    uploadStatus.textContent = "File not uploaded";
    uploadStatus.classList.add("show"); // Show the alert
    imagePreview.classList.remove("show"); // Hide the image preview
    setTimeout(function () {
      uploadStatus.classList.remove("show"); // Hide the alert after 3 seconds
    }, 3000);
  }
}
