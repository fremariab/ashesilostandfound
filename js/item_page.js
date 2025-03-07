function toggleCustomLocationInput() {
  var locationSelect = document.getElementById("location-select");
  var customLocationInput = document.getElementById("custom-location-input");
  if (locationSelect.value === "other") {
    customLocationInput.style.display = "block";
  } else {
    customLocationInput.style.display = "none";
  }
}
document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const sidebarToggle = document.getElementById("sidebarToggle");
  const content = document.querySelector(".items");

  sidebar.style.left = "0px";
  content.classList.add("shifted-content");
  sidebar.classList.add("shifted-sidebar");
  sidebarToggle.classList.add("shifted-sidebar");

  function toggleSidebar() {
    console.log("in toggle func");
    if (sidebar.style.left === "0px") {
      sidebar.style.left = "-250px";
      content.classList.remove("shifted-content");
      sidebar.classList.remove("shifted-sidebar");
      sidebarToggle.classList.remove("shifted-sidebar");
      sidebarToggle.style.left = "10px";
    } else {
      sidebar.style.left = "0px";
      content.classList.add("shifted-content");
      sidebar.classList.add("shifted-sidebar");
      sidebarToggle.classList.add("shifted-sidebar");
      sidebarToggle.style.left = "220px";
    }
  }

  sidebarToggle.addEventListener("click", toggleSidebar);
});

document.addEventListener("DOMContentLoaded", function () {
  const menuItems = document.querySelectorAll(".side-menu li");

  function setActiveMenuItemFromURL() {
    const currentURL = window.location.href;
    const relativePath = currentURL.split("/").pop();
    console.log("Relative Path:", relativePath);
    menuItems.forEach((menuItem) => {
      const link = menuItem.querySelector("a");
      const menuItemURL = link.getAttribute("href");
      console.log("Menu Item URL:", menuItemURL);
      if (menuItemURL && menuItemURL.includes(relativePath)) {
        menuItem.classList.add("active");
      } else {
        menuItem.classList.remove("active");
      }
    });
  }

  setActiveMenuItemFromURL();

  menuItems.forEach((menuItem) => {
    menuItem.addEventListener("click", function (event) {
      console.log("Clicked menu item:", menuItem);

      menuItems.forEach((item) => {
        item.classList.remove("active");
      });

      menuItem.classList.add("active");
    });
  });
});

var currentPage = 1;

function loadNextPage() {
  currentPage++;
  loadData(currentPage);
}

function loadPreviousPage() {
  if (currentPage > 1) {
    currentPage--;
    loadData(currentPage);
  }
}

document.getElementById("apply-filters").addEventListener("click", function () {
  currentPage = 1;
  loadData(currentPage);
});

loadData(currentPage);
