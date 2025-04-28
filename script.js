const sections = document.querySelectorAll("section");

window.addEventListener("scroll", () => {
  sections.forEach((section) => {
    const rect = section.getBoundingClientRect();
    if (rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2) {
      document.body.className = section.dataset.bg;
    }
  });
});


function openNav() {
  document.getElementById("sidenav").style.width = "250px";
  document.getElementById("overlay").style.display = "block";
}

function closeNav() {
  document.getElementById("sidenav").style.width = "0";
  document.getElementById("overlay").style.display = "none";
}

function closeForm() {
  document.getElementById("formOverlay").style.display = "none";
}

