document.addEventListener('DOMContentLoaded', function () {
  const orderButtons = document.querySelectorAll('.order-btn');
  const cartCounter = document.getElementById('cart-counter');

  // Initialize cart count from local storage
  let cartCount = parseInt(localStorage.getItem('cartCount')) || 0;
  cartCounter.textContent = cartCount;

  orderButtons.forEach(button => {
      button.addEventListener('click', () => {
          cartCount++;
          cartCounter.textContent = cartCount;
          localStorage.setItem('cartCount', cartCount);
      });
  });
});

// Mobile menu toggle
const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", (e) => {
navLinks.classList.toggle("open");
const isOpen = navLinks.classList.contains("open");
menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-line");
});

navLinks.addEventListener("click", (e) => {
navLinks.classList.remove("open");
menuBtnIcon.setAttribute("class", "ri-menu-line");
});

// Scroll Reveal Animations
const scrollRevealOption = {
distance: "50px",
origin: "bottom",
duration: 1000,
};

ScrollReveal().reveal(".header__image img", {
...scrollRevealOption,
origin: "right",
});
ScrollReveal().reveal(".header__content h2", {
...scrollRevealOption,
delay: 500,
});
ScrollReveal().reveal(".header__content h1", {
...scrollRevealOption,
delay: 1000,
});

ScrollReveal().reveal(".order__card", {
...scrollRevealOption,
interval: 500,
});

ScrollReveal().reveal(".event__content", {
duration: 1000,
});
