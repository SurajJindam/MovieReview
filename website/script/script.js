history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};
const signUpButton = document.querySelector('.sign-up-button');
const loginButton = document.querySelector(".login-button");
const modal = document.querySelector('.modal');
const signUpModal = document.querySelector('.signup-modal');
const loginModal = document.querySelector('.login-modal');
const overlay = document.querySelector('.overlay');
const closeSignUpModalBtn = document.querySelector('.btn--close-modal')
const closeLoginModalBtn = document.querySelector('.btn--close-modal-login')

const openSignUpModal = function (e) {
    e.preventDefault();
    signUpModal.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
const closeSignUpModal = function () {
    signUpModal.classList.add('hidden');
    overlay.classList.add('hidden');
}
const openLoginModal = function (e) {
    e.preventDefault();
    loginModal.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
const closeLoginModal = function () {
    loginModal.classList.add('hidden');
    overlay.classList.add('hidden');
}
signUpButton.addEventListener('click', openSignUpModal);
closeSignUpModalBtn.addEventListener('click', closeSignUpModal);
loginButton.addEventListener('click', openLoginModal);
closeLoginModalBtn.addEventListener('click', closeLoginModal);