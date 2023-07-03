// Function to handle search functionality within the dynamically loaded content
function search() {
  var searchInput = document.getElementById("search-input").value.toLowerCase();
  var cards = document.getElementsByClassName("card");
  var tableRows = document.querySelectorAll("table tbody tr");

  if (cards) {
    for (var i = 0; i < cards.length; i++) {
      var title = cards[i]
        .querySelector(".card-title")
        .textContent.toLowerCase();

      if (title.includes(searchInput)) {
        cards[i].style.display = "block";
      } else {
        cards[i].style.display = "none";
      }
    }
  }
  
  if (tableRows) {
    for (var i = 0; i < tableRows.length; i++) {
      var ticketName = tableRows[i]
        .querySelector("td:nth-child(3)")
        .textContent.toLowerCase();
      var ticketName2 = tableRows[i]
        .querySelector("td:nth-child(4)")
        .textContent.toLowerCase();

      if (ticketName.includes(searchInput) || ticketName2.includes(searchInput)) {
        tableRows[i].style.display = "table-row";
      } else {
        tableRows[i].style.display = "none";
      }
    }
  }
}
