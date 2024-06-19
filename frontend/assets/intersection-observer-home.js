const header = document.querySelector("header");
const sectionOne = document.querySelector(".home-box");

const sectionOneOptions = {
  threshold: 0,
  rootMargin: "-100px 0px 0px 0px",
};

const sectionOneObserver = new IntersectionObserver(function (
  entries,
  sectionOneObserver
) {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) {
      header.classList.add("nav_scrolled");
    } else if (
      entry.isIntersecting &&
      header.classList.contains("nav_scrolled")
    ) {
      header.classList.remove("nav_scrolled");
    }
  });
},
sectionOneOptions);

sectionOneObserver.observe(sectionOne);
