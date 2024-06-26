const faders = document.querySelectorAll(".fade-in");
const fade_options = { threshold: 0.25 };

const observer_fade = new IntersectionObserver(function (
  entries,
  observer_fade
) {
  entries.forEach((entry) => {
    console.log(entry);
    if (!entry.isIntersecting) {
      return;
    } else {
      entry.target.classList.add("appear", entry.isIntersecting);
      observer_fade.unobserve(entry.target);
    }
  });
},
fade_options);

faders.forEach((fader) => {
  observer_fade.observe(fader);
});
console.log("post observer");
