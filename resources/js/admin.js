const toggler = document.querySelector('.toggler');
const sidebar = document.querySelector('.sidebar');
const main_content = document.querySelector('.main-content');
const cross_btn_container = document.querySelector('.cross-btn-container');
const dropdown_toggle = document.querySelector('.dropdown-toggle');
const dropdown_menu = document.querySelector('.dropdown-menu');




document.querySelectorAll('.sidebar-link-toggle').forEach(link => {
  link.addEventListener('click', function () {
    const targetList = document.querySelector(this.dataset.target);
    targetList.classList.toggle('is-visible');
  });
});

// dropdown_toggle.addEventListener('click', function () {
//   dropdown_menu.classList.toggle('display-drop')
// })

toggler.addEventListener('click', function () {
  sidebar.classList.toggle('hiding')
  sidebar.classList.toggle('displaying')
  main_content.classList.toggle('pd-left-side');

})

cross_btn_container.addEventListener('click', function () {
  sidebar.classList.toggle('hiding')
  sidebar.classList.toggle('displaying')
  main_content.classList.toggle('pd-left-side');
})

function toggleSidebarAndContent() {
  sidebar.classList.toggle('hiding');
  sidebar.classList.toggle('displaying');
  main_content.classList.toggle('pd-left-side');

}

function toggleSidebar() {
  const body = document.body;
  const sidebar = document.querySelector('.sidebar');

  sidebar.classList.toggle('active');

  if (sidebar.classList.contains('active')) {
    body.style.overflow = 'hidden';
  } else {
    body.style.overflow = 'auto';
  }
}
////
