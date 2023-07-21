function readImage() {
	if (this.files && this.files[0]) {
		let file = new FileReader();
		file.onload = function (e) {
			document.querySelector('#recipe_image_preview').src = e.target.result;
		};
		file.readAsDataURL(this.files[0]);
	}
}

document
	.querySelector('#recipe_image')
	.addEventListener('change', readImage, false);
