const open = document.getElementById("open");
const close = document.getElementById("close");

open.addEventListener("click", openNav);
close.addEventListener("click", closeNav);

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
