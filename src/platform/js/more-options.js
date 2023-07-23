const moreOptions = document.querySelector('#more-options');
const more = document.querySelector('#more');
const hideMenu = document.querySelector('#hide-menu');

let moreIcon = document.querySelector('#more .bi');

more.addEventListener('click', () => {
	moreOptions.classList.toggle('hide');
	hideMenu.classList.toggle('hide');
	moreIcon.classList.toggle('bi-caret-left');
	moreIcon.classList.toggle('bi-list');
});

hideMenu.addEventListener('click', () => {
	moreOptions.classList.toggle('hide');
	hideMenu.classList.toggle('hide');
	moreIcon.classList.toggle('bi-caret-left');
	moreIcon.classList.toggle('bi-list');
});
