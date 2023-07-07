const stars = document.querySelectorAll('.rating .bi');

const updateStars = (stars, amountOfStars, classToBeRemoved, classToBeAdded) => {
	for (let index = 0; index < amountOfStars; index++) {
		stars[index].classList.remove(classToBeRemoved);
		stars[index].classList.add(classToBeAdded);
	}
};

if (stars) {
	const rating = document.querySelector('.rating');

	let alreadyVoted = false;

	let ratingValue = Number(rating.dataset.rating);

	if (ratingValue > 0) {
		alreadyVoted = true;

		updateStars(stars, ratingValue, 'bi-star', 'bi-star-fill');
	}

	stars.forEach((star) => {
		star.addEventListener('mouseover', () => {
			if (!alreadyVoted) {
				updateStars(stars, star.dataset.star, 'bi-star', 'bi-star-fill');
			}
		});
	});

	stars.forEach((star) => {
		star.addEventListener('mouseout', () => {
			if (!alreadyVoted) {
				updateStars(stars, stars.length, 'bi-star-fill', 'bi-star');
			}
		});
	});

	stars.forEach((star) => {
		star.addEventListener('click', () => {
			alreadyVoted = true;

			updateStars(stars, stars.length, 'bi-star-fill', 'bi-star');
			updateStars(stars, star.dataset.star, 'bi-star', 'bi-star-fill');
		});
	});
}
