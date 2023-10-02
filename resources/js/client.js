var swiper = new Swiper(".mySwiper", {
  slidesPerView: 6,
  spaceBetween: 35,
  freeMode: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    // when window width is >= 320px
    100: {
      slidesPerView: 1,
      spaceBetween: 5
    },
    270: {
      slidesPerView: 2,
      spaceBetween: 5
    },
    320: {
      slidesPerView: 2,
      spaceBetween: 10
    },
    470: {
      slidesPerView: 3,
      spaceBetween: 15
    },
    770: {
      slidesPerView: 4,
      spaceBetween: 20
    },

    1024: {
      slidesPerView: 6,
      spaceBetween: 35
    }
  }
});
const cat_nav = document.querySelector('.cat-navbar');
const search_nav = document.querySelector('.search-navbar');
const nav_item_cat_drop = document.querySelector('.nav-item-cat-drop');
const search_icons = document.querySelector('.search-icons');


nav_item_cat_drop.addEventListener('click', function (e) {
  cat_nav.classList.toggle('dropdown-catnav-display');
  cat_nav.classList.toggle('dropdown-cat-nav');
})
search_icons.addEventListener('click', function (e) {
  search_nav.classList.toggle('dropdown-search-nav-display');
  search_nav.classList.toggle('dropdown-search-nav');
})



if (window.location.pathname === '/category') {
  window.scrollToTop = function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
  window.onscroll = function () {
    var button = document.getElementById("scrollTopButton");
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      button.style.display = "flex";
    } else {
      button.style.display = "none";
    }
  };
}