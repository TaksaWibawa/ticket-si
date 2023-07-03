document.addEventListener("DOMContentLoaded", function () {
  const tiketGoldRadio = document.getElementById("tiket_gold");
  const additionalFileUploadSection = document.getElementById(
    "additional-file-upload-section"
  );

  if (tiketGoldRadio && additionalFileUploadSection) {
    tiketGoldRadio.addEventListener("click", () => {
      if (tiketGoldRadio == "gold") {
        additionalFileUploadSection.classList.remove("hidden");
      } else {
        additionalFileUploadSection.classList.add("hidden");
      }
    });
  }
});
