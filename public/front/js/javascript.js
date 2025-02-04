document.addEventListener("DOMContentLoaded", function () {
  const navbarToggler = document.querySelector(".navbar-toggler");
  const navbar = document.getElementById("mainNavbar");
  const navLinks = document.querySelectorAll(".nav-link");
  const followUs = document.querySelector(".follow-us");
  const headerDivider = document.querySelector("span.header-divider");

  navbarToggler.addEventListener("click", function () {
    navbar.classList.toggle("navbar-dark");

    if (!navbar.classList.contains("navbar-dark")) {
      followUs.style.color = "gray";
      headerDivider.style.display = "none";
    } else {
      followUs.style.color = "white";
      headerDivider.style.display = "";
    }
  });

  const searchInput = document.getElementById("searchInput");

  if (searchInput) {
    // Check if the element exists
    searchInput.addEventListener("input", function () {
      const searchQuery = this.value.toLowerCase();
      console.log(searchQuery);
      const realisationItems = Array.from(
        document.querySelectorAll(".realisation-item")
      );

      realisationItems
        .filter((item) => {
          const title = item.getAttribute("data-title");
          const city = item.getAttribute("data-city");

          // Check if the search query matches the title or city
          return title.includes(searchQuery) || city.includes(searchQuery);
        })
        .forEach((item) => (item.style.display = ""));

      realisationItems
        .filter((item) => {
          const title = item.getAttribute("data-title");
          const city = item.getAttribute("data-city");

          // Check if the search query does not match the title or city
          return !title.includes(searchQuery) && !city.includes(searchQuery);
        })
        .forEach((item) => (item.style.display = "none"));
    });
  }
});
