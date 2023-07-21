const cancelAddRecipe = document.querySelector('#cancel-add-recipe');
const showAddRecipe = document.querySelector('#nav-actions .add');
const addRecipe = document.querySelector('#add-recipe');

const home = document.querySelector('.home');

cancelAddRecipe.addEventListener('click', () => {
	addRecipe.classList.toggle('hide');
	home.classList.toggle('hide');
});

showAddRecipe.addEventListener('click', () => {
	addRecipe.classList.toggle('hide');
	home.classList.toggle('hide');
});
