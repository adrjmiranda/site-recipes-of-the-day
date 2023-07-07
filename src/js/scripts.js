let banner = document.querySelector('#banner');

if (banner) {
	const categoryBackground = document.querySelectorAll('.category-bg');

	const timeStart = new Date().getTime();

	const animationTime = 2;
	const timeToStarAnimation = 5;
	const timeToRestartTheAnimation = 8;

	categoryBackground.forEach((item) => {
		item.style.animationDuration = animationTime + 's';
	});

	const startAnimation = () => {
		for (let index = 0; index < 4; index++) {
			banner.children[index].classList.add('move-left-' + (index + 1));
		}
	};

	const endAnimation = () => {
		for (let index = 0; index < 4; index++) {
			banner.children[index].classList.remove('move-left-' + (index + 1));
		}
	};

	const resetAnimation = () => {
		banner = document.querySelector('#banner');

		let first = banner.children[0];

		banner.removeChild(banner.children[0]);
		banner.appendChild(first);
	};

	setInterval(async () => {
		let time = new Date().getTime();
		let interval = Math.round((time - timeStart) / 1000);

		if (interval % timeToStarAnimation == 0) {
			startAnimation();
		}
	}, 1000);

	setInterval(() => {
		endAnimation();
		resetAnimation();
	}, timeToRestartTheAnimation * 1000);
}
