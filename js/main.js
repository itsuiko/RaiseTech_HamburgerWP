//main.javascript


const menu = document.querySelectorAll('.js-menu');
const sidebar = document.querySelectorAll('.js-sidebar');
const overlay = document.querySelector('.p-overlay');

menu.forEach(menuItem => {
    menuItem.addEventListener('click', () => {
        sidebar.forEach(sidebarItem => sidebarItem.classList.toggle('is-active'));
        overlay.classList.toggle('is-active');
    });
});

window.addEventListener('resize', () => {
    sidebar.forEach(sidebarItem => { 
        sidebarItem.classList.remove('is-active');
    overlay.classList.remove('is-active');    
    });
});