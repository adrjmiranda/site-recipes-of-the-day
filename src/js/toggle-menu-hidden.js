const toggleMenu = document.querySelector('#toggle-menu');
const menuHidden = document.querySelector('#menu-hidden');
const closeMenu = document.querySelector('#close-menu');

toggleMenu.addEventListener('click', () => {
	menuHidden.classList.toggle('hidden');
	document.body.style.overflow = 'hidden';
});

closeMenu.addEventListener('click', () => {
	menuHidden.classList.toggle('hidden');
	document.body.style.overflow = '';
});
