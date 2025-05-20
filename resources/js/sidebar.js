document.addEventListener("DOMContentLoaded", function () {
  const languageButton = document.getElementById("language-button");
  const languageDropdown = document.getElementById("language-dropdown");

  // Toggle dropdown when button is clicked
  languageButton.addEventListener("click", function (e) {
    e.stopPropagation();
    languageDropdown.classList.toggle("hidden");
  });

  // Close dropdown when clicking outside
  document.addEventListener("click", function (e) {
    if (!languageDropdown.contains(e.target) && !languageButton.contains(e.target)) {
      languageDropdown.classList.add("hidden");
    }
  });
});