const categoryDropdown = document.querySelector(".dropdown-hover");
const categoryToggle = categoryDropdown.querySelector(".dropdown-toggle");
const hoverDropdownContent = document.querySelector(".dropdown-hover-content");

//Opens dropdown items
function openDropdown() {
    console.log("open");
    // categoryToggle.ariaExpanded = "true";
    categoryDropdown.classList.add("show");
    hoverDropdownContent.classList.add("show");
}

//Closes dropdown items
function closeDropdown() {
    console.log("close");
    // categoryToggle.ariaExpanded = "false";
    categoryDropdown.classList.remove("show");
    hoverDropdownContent.classList.remove("show");
}

//Sends user to the categories page, because the href on the dropdown toggle does not work
function redirectToCategories() {
    window.location = "http://fnoj.localhost/categories";
}

//Activates eventlistener
categoryDropdown.addEventListener("mouseenter", openDropdown);
categoryDropdown.addEventListener("mouseleave", closeDropdown);
categoryToggle.addEventListener("click", redirectToCategories);