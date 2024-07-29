const formErrorBox = document.querySelector('.form .error-box');
const mainErroBox = document.querySelector('.container .main-error-box');
const passwordInput = document.getElementById('password-input');
const usernameInput = document.getElementById('username-input');
const inputForm = document.querySelector('form');
const inputUsername = document.getElementById('username-input');
const inputPassword = document.getElementById('password-input');

//show and hide password
document.getElementById('show-pass-btn').addEventListener('click', () => {
    showHidePassword(passwordInput);
});

//password wrong alert
function wrongPassword() {
    wrongInput(passwordInput, formErrorBox, 'password');
}

//username wrong alert 
function wrongUserName() {
    wrongInput(usernameInput, formErrorBox, 'user name');
}

[usernameInput, passwordInput].forEach(input => {
    input.onclick = function() {
        if (input.parentElement.classList.contains('wrong')) {
            input.parentElement.classList.remove('wrong');
            formErrorBox.innerText = "";
        }
    }
})


//ReUseble functions
function showHidePassword(inputBx) {
    if (inputBx.type == 'password') {
        inputBx.type = 'text';
    } else {
        inputBx.type = 'password';
    }
}

function showMainErrorBox(erroBx, msg) {
    erroBx.querySelector('label').innerText = msg;
    erroBx.style.transform = 'translateY(0%)';
    erroBx.querySelector('.close-btn').addEventListener('click', () => {
        erroBx.style.transform = 'translateY(-100%)';
    })
}

function wrongInput(input, errorBx, text) {
    input.parentElement.classList.add('wrong');
    errorBx.innerText = text;
    errorBx.style.display = 'flex';
}

function errorHandling(error) {
    if (error == 'username') {
        let msg = 'Your user name is not found';
        wrongInput(inputUsername, formErrorBox, msg)
    }
    if (error == 'password') {
        let msg = 'Your Password is Wrong.';
        wrongInput(inputPassword, formErrorBox, msg)
    }
}

inputForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let userName = inputUsername.value;
    let userPassword = inputPassword.value;
    let param = `user_name=${userName}&password=${userPassword}`;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/login.php", true)
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    xhr.onload = function() {
        try {
            let dic = JSON.parse(this.responseText);
            if (dic['success']) {
                close();
                window.open('../php/index.php');
                window.close("../html/login.html");

            }
            if (dic['error']) {
                errorHandling(dic['error'])
            }
        } catch (er) {
            showMainErrorBox(mainErroBox, this.responseText)
        }
    }
    xhr.send(param);
})