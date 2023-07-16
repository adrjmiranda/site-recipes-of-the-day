const ingredientInput = document.querySelector('#ingredient');
const buttonAddRecipe = document.querySelector('[data-add-recipe]');
const ingredientsArea = document.querySelector('#ingredients-area');

buttonAddRecipe.addEventListener('click', () => {
	if (ingredientInput.value !== '') {
		ingredientsArea.textContent =
			ingredientsArea.textContent + ingredientInput.value + ', ';

		ingredientInput.value = '';
		ingredientInput.focus();
	}
});
