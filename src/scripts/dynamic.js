document.getElementById("hamburger-btn").addEventListener("click", function () 
{
  var menu = document.getElementById("menu");
  var pageContent = document.getElementById("page-content");
  menu.classList.toggle("-translate-x-full");
  pageContent.classList.toggle("ml-64");
});