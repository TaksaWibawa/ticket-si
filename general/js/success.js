const urlParams = new URLSearchParams(window.location.search);
const alertType = urlParams.get("alert");
const alertMessage = urlParams.get("message");
const alertElement = document.getElementById("success-msg");

if (alertType && alertMessage) {
  // Set the alert message and class based on the alert type
  alertElement.textContent = alertMessage;
  alertElement.classList.add(alertType);
  alertElement.classList.add("show");

  // Reset the URL
  history.replaceState({}, document.title, window.location.pathname);

  // Remove the alert after 3 seconds
  setTimeout(function () {
    alertElement.classList.remove("show");
  }, 3000);
}
