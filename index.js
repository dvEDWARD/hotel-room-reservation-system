

/* Swiper */
var swiper = new Swiper('.swiper-container', {
    pagination: {
      el: '.swiper-pagination',
      dynamicBullets: true,
    },
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
  });
  

  const dropdownToggle = document.querySelector('.btns');
  const dropdownMenu = document.querySelector('.dropdown-menu');
  
  dropdownToggle.addEventListener('click', () => {
    dropdownMenu.classList.toggle('show');
  });