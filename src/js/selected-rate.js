const stars = document.querySelectorAll('.rating .bi');

if (stars) {
	let alreadyVoted = false;

	stars.forEach((star) => {
		star.addEventListener('mouseover', () => {
			if (!alreadyVoted) {
				for (let i = 0; i < star.dataset.star; i++) {
					stars[i].classList.remove('bi-star');
					stars[i].classList.add('bi-star-fill');
				}
			}
		});
	});

	stars.forEach((star) => {
		star.addEventListener('mouseout', () => {
			if (!alreadyVoted) {
				for (let i = 0; i < stars.length; i++) {
					stars[i].classList.remove('bi-star-fill');
					stars[i].classList.add('bi-star');
				}
			}
		});
	});

	stars.forEach((star) => {
		star.addEventListener('click', () => {
			alreadyVoted = true;

			for (let i = 0; i < stars.length; i++) {
				stars[i].classList.remove('bi-star-fill');
				stars[i].classList.add('bi-star');
			}

			for (let i = 0; i < star.dataset.star; i++) {
				stars[i].classList.remove('bi-star');
				stars[i].classList.add('bi-star-fill');
			}
		});
	});
}
