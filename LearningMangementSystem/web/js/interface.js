const loader = document.querySelector('.site-loader');

//Style mechanics
const marker = document.getElementById('marker');
const navBar = document.querySelector('nav');
const profileBx = document.querySelector('.profile-bx');
const backgroundAnineBx = document.querySelector('.background-anime-box');
const mainErrorBx = document.querySelector('.error-box');
const main = document.querySelector('main');
const mainSections = main.querySelectorAll('section');
//profile box toggle
profileBx.querySelector('.toggle-btn').addEventListener('click', () => {
    profileBx.classList.toggle('active');
    main.classList.toggle('profile-bx-active');
})


//background animation
backgroundAnineBx.querySelectorAll('ul li').forEach((li) => {
    setStyles(li)
    li.addEventListener("animationend", () => {
        setStyles(li);
        backgroundAnineBx.querySelector('ul').append(li)
    })

})


function setStyles(li) {
    li.style.left = Math.random() * 100 + '%';
    li.style.transform = 'scale(' + Math.random() * 3 + ')';
    li.style.animationDelay = Math.random() * 4 + 's';
}

//Show a error in interface main error box
function showMainError(msg) {
    mainErrorBx.classList.add('active');
    mainErrorBx.querySelector('label').innerText = msg
}

mainErrorBx.querySelector('.close-btn').addEventListener('click', () => {
    mainErrorBx.classList.remove('active');
})


//nav bar 
navLi = navBar.querySelectorAll('ul li');
navLi.forEach(li => {
    li.addEventListener('click', () => {
        navLi.forEach(i => i.classList.remove('active'));
        li.classList.add('active')

        id = li.getAttribute('id');
        cls = id.replace('-btn', '')
        activeSection(cls)
    })
})

//linking nav bar to sections
function activeSection(cls) {
    mainSections.forEach(sec => {
        if (sec.classList.contains(cls)) {
            removeActiveSection();
            sec.classList.add('active');
        }
    })
}

function removeActiveSection() {
    mainSections.forEach(sec => sec.classList.remove('active'))
}


function interfaceLoaded() {
    loader.style.display = 'none';
}

interfaceLoaded()

function fetchUserData(func) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/user-data.php', true);
    xhr.onload = function() {
        try {
            let user_data = JSON.parse(this.responseText);
            func(user_data);
        } catch (err) {
            console.log(err)
            showMainError(this.responseText);
        }
    }
    xhr.send();
}