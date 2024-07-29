//homewoks
const main2 = document.querySelector('main');

const todoHomeworksBtn = document.getElementById('todo-homeworks-btn');
const finishedHomeworksBtn = document.getElementById('finished-homeworks-btn');
const homeworkContainer = document.querySelector('main section.homeworks .container');
const todoHomework = document.querySelector('main section.homeworks .container .user-homework');
const finishedHomework = document.querySelector('main section.homeworks .container .uploaded-homeworks');
const homewoksHeadLabels = document.querySelectorAll('main section.homeworks .container-head label');


todoHomeworksBtn.addEventListener('click', () => {
    removeActives(homewoksHeadLabels)
    todoHomeworksBtn.classList.add('active')
    todoHomework.style.display = 'block';
    finishedHomework.style.display = 'none';
})

finishedHomeworksBtn.addEventListener('click', () => {
    removeActives(homewoksHeadLabels)
    finishedHomeworksBtn.classList.add('active')
    todoHomework.style.display = 'none';
    finishedHomework.style.display = 'block';
})

function removeActives(els) {
    els.forEach(el => {
        el.classList.remove('active')
    });
}

window.addEventListener('resize', () => {
    if (window.innerWidth > 1500) {
        finishedHomework.style.display = 'block';
        todoHomework.style.display = 'block';
    } else if (!finishedHomeworksBtn.classList.contains('active')) {
        finishedHomework.style.display = 'none';
    }
})



fetchUserData(insertUserData);

function insertUserData(obj) {
    document.getElementById('pr-user-name').innerText = obj.name;
    document.getElementById('pr-class-name').innerText = obj.class_name;
    document.getElementById("user-profile-pic").src = obj.pic_url;

}

function checkForClass() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/student/check-for-class.php", true)
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xhr.onload = function() {
        try {
            const stat = JSON.parse(this.responseText);
            if (stat.status == "has_class") {
                hasClass(stat);
            }
            if (stat.status == "no_class") {
                noClass();
            }
        } catch {
            showMainError(this.responseText);
        }
    }

    xhr.send();
}
checkForClass()
setInterval(() => {
    checkForClass()
}, 3000)


const classroomContainer = document.querySelector("section.classroom");
const startedClassBox = document.querySelector(".class-started");
const noClassTitle = document.getElementById("no-class-title");
const streamingClassesbx = startedClassBox.querySelector(".steaming-classes-info");
const loginClassBtn = document.getElementById("login-class-btn");


function hasClass(obj) {
    noClassTitle.style.display = 'none';
    startedClassBox.classList.add("active");
    startedClassBox.querySelector(".sub_title").innerText = obj.subject;
    startedClassBox.querySelector(".teacher-info-bx label").innerText = obj.teacher;
    startedClassBox.querySelector(".class-time-box").innerText = obj.time;
    streamingClassesbx.innerHTML = "";
    for (let i = 0; obj.class.length > i; i++) {
        const div = document.createElement("div");
        div.innerText = obj.class[i];
        streamingClassesbx.append(div);
    }
    loginClassBtn.href = obj.link;
    document.getElementById("steaming-teacher-pic").src = obj.pic_url;
}

function noClass() {
    noClassTitle.style.display = "block";
    startedClassBox.classList.remove("active");
    startedClassBox.querySelector(".sub_title").innerText = "";
    startedClassBox.querySelector(".teacher-info-bx label").innerText = "";
    startedClassBox.querySelector(".class-time-box").innerText = "";
    streamingClassesbx.innerHTML = "";
}

function fetchResource() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/student/fetch-resources.php", true)
    xhr.onload = function() {
        resourceBx.innerHTML = this.responseText;
    }

    xhr.send();
}
const resourceBx = document.getElementById("resource-box");
const classmatesUl = document.getElementById("student-community-ul");

fetchResource();

function fetchClassmates() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/student/fetch-classmates.php", true)
    xhr.onload = function() {
        classmatesUl.innerHTML = this.responseText;
    }

    xhr.send();
}

fetchClassmates();

function fetchHomeworks() {
    const xhr = new XMLHttpRequest;
    xhr.open("GET", "../php/student/fetch-student-homework.php", true)

    xhr.onload = function() {
        stHomeworkUL.innerHTML = this.responseText;
        setHomeworkLiListeners();
    }

    xhr.send()
}
const stHomeworkUL = document.getElementById("st-homework-ul");

function setHomeworkLiListeners() {
    stHomeworkUL.querySelectorAll('li').forEach(li => {
        li.addEventListener('click', () => {
            const id = li.getAttribute("id");
            window.open("../html/do-homework.php?homework_id=" + id);
        })
    })
}
fetchHomeworks();

function fetchUploadedHomeworks() {
    const xhr = new XMLHttpRequest;
    xhr.open("GET", "../php/student/fetch-uploaded-homework.php", true)

    xhr.onload = function() {
        uploadedtHomeworkUL.innerHTML = this.responseText;
    }

    xhr.send()
}
fetchUploadedHomeworks()
const uploadedtHomeworkUL = document.getElementById("uploaded-homework-ul");