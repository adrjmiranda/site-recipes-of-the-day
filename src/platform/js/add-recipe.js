const ingredientInput = document.querySelector('#ingredient');
const buttonAddRecipe = document.querySelector('[data-add-recipe]');
const ingredientsArea = document.querySelector('#ingredients-area');

const ingredients = document.querySelector('#ingredients');

let newItems = document.querySelectorAll('#ingredients-area li');
let newItemsMinus = document.querySelectorAll('#ingredients-area li .bi');

let itemsField = document.querySelectorAll('#ingredients input');

buttonAddRecipe.addEventListener('click', () => {
	if (ingredientInput.value !== '') {
		let newIngredient = ingredientInput.value;
		newIngredient = newIngredient.toLowerCase();
		newIngredient = newIngredient[0].toUpperCase() + newIngredient.substr(1);

		let ingredientItem = document.createElement('li');
		ingredientItem.textContent = newIngredient;

		let minusItem = document.createElement('i');
		minusItem.classList.add('bi');
		minusItem.classList.add('bi-dash-square-fill');

		newItemsMinus = document.querySelectorAll('#ingredients-area li .bi');

		minusItem.setAttribute(
			'data-order',
			!newItemsMinus.length ? 0 : newItemsMinus.length
		);
		ingredientItem.appendChild(minusItem);

		ingredientItem.appendChild(minusItem);
		ingredientsArea.appendChild(ingredientItem);

		ingredientInput.value = '';
		ingredientInput.focus();

		let ingredient = document.createElement('input');
		ingredient.setAttribute('type', 'checkbox');
		ingredient.setAttribute('name', 'ingredients');
		ingredient.setAttribute('value', newIngredient);
		ingredient.setAttribute(
			'data-order',
			!newItemsMinus.length ? 0 : newItemsMinus.length
		);

		ingredients.appendChild(ingredient);

		newItems = document.querySelectorAll('#ingredients-area li');
		newItemsMinus = document.querySelectorAll('#ingredients-area li .bi');

		itemsField = document.querySelectorAll('#ingredients input');

		newItemsMinus.forEach((item, index) => {
			item.addEventListener('click', (e) => {
				newItems = document.querySelectorAll('#ingredients-area li');
				newItemsMinus = document.querySelectorAll('#ingredients-area li .bi');

				itemsField = document.querySelectorAll('#ingredients input');

				let order = parseInt(e.target.dataset.order);

				newItemsMinus.forEach((minus) => {
					if (parseInt(minus.getAttribute('data-order')) == order) {
						minus.parentNode.parentNode.removeChild(minus.parentNode);
					}
				});

				itemsField.forEach((item) => {
					if (parseInt(item.getAttribute('data-order')) == order) {
						item.parentNode.removeChild(item);
					}
				});
			});
		});
	}
});
