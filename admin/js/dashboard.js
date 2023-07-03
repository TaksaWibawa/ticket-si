document.addEventListener("DOMContentLoaded", function () {
  const menuItems = document.querySelectorAll(".menu-item");
  const navbarTitle = document.getElementById("navbar-title");
  const contentContainer = document.querySelector(".content");

  // Store the previous content and URL
  let previousContent = contentContainer.innerHTML;
  let previousUrl = null;

  // Initialize the first menu as active and load its content on page load
  menuItems[0].classList.add("active");
  const firstMenuUrl = menuItems[0].querySelector("a").getAttribute("href");
  loadContent(firstMenuUrl);

  menuItems.forEach((menuItem) => {
    // Exclude the logout button
    if (!menuItem.classList.contains("logout")) {
      menuItem.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent the default link behavior

        // Remove 'active' class from all menu items
        menuItems.forEach((item) => item.classList.remove("active"));
        // Add 'active' class to the clicked menu item
        menuItem.classList.add("active");

        const clickedTitle = menuItem.querySelector("a").textContent;
        navbarTitle.innerHTML = "Menu" + " " + clickedTitle;

        const targetUrl = menuItem.querySelector("a").getAttribute("href"); // Get the URL from the menu item's link

        // Load the content from the target URL
        loadContent(targetUrl);


      });
    }
  });

  function loadContent(url) {
    fetch(url)
      .then((response) => response.text())
      .then((content) => {
        // Update the content container with the loaded content
        contentContainer.innerHTML = content;

        // Add event listeners to each "Pilih Paket" button in the loaded content
        const pilihPaketButtons =
          contentContainer.querySelectorAll(".card-button");
        pilihPaketButtons.forEach((button) => {
          button.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent the default link behavior

            const targetUrl = button.getAttribute("href"); // Get the URL from the button's href attribute
            // Store the current content and URL as previous
            previousContent = contentContainer.innerHTML;
            previousUrl = url;
            loadContent(targetUrl);
          });
        });

        const backButton = document.getElementById("back-button");
        if (backButton) {
          // Check if the back button exists on the page
          backButton.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent the default link behavior

            if (previousUrl) {
              // Restore the previous content
              loadContent(previousUrl);
            }
          });
        }
      })
      .catch((error) => {
        console.error("Error loading content:", error);
      });
  }
});
