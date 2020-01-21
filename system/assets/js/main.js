const signupModel = document.querySelector('.signup-form-wrapper');
const loginModel = document.querySelector('.login-form-wrapper');
const signupBtn = document.querySelector('.signup-btn');
const loginBtn = document.querySelector('.login-btn');
const signupX = document.querySelector('.signup-x');
const loginX = document.querySelector('.login-x');



signupBtn.addEventListener('click', function() {
    signupModel.classList.add('.bg-active');
});

loginBtn.addEventListener('onclick', function() {
    loginModel.classList.add('bg-active');
});