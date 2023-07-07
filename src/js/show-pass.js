const passInput = document.querySelector('#password');
const confirmPassInput = document.querySelector('#confirm_password');

const showPass = document.querySelector('#show-pass .bi-unlock-fill');
const hiddenPass = document.querySelector('#show-pass .bi-lock-fill');

const showConfirmPass = document.querySelector('#show-confirm-pass .bi-unlock-fill');
const hiddenConfirmPass = document.querySelector('#show-confirm-pass .bi-lock-fill');

const hiddenInput = (input) => {
	input.setAttribute('type', 'password');
};

const showInput = (input) => {
	input.setAttribute('type', 'text');
};

showPass.addEventListener('click', () => {
	showInput(passInput);

	showPass.classList.add('hidden');
	hiddenPass.classList.remove('hidden');
});

hiddenPass.addEventListener('click', () => {
	hiddenInput(passInput);

	showPass.classList.remove('hidden');
	hiddenPass.classList.add('hidden');
});

showConfirmPass.addEventListener('click', () => {
	showInput(confirmPassInput);

	showConfirmPass.classList.add('hidden');
	hiddenConfirmPass.classList.remove('hidden');
});

hiddenConfirmPass.addEventListener('click', () => {
	hiddenInput(confirmPassInput);

	showConfirmPass.classList.remove('hidden');
	hiddenConfirmPass.classList.add('hidden');
});
