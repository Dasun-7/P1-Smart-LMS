console.log('connected')
    //Sections
const classroomSec = document.querySelector('section.classroom');
const resourcesSec = document.querySelector('section.resources');



//classroom
const classroomContainers = classroomSec.querySelectorAll('.container');
const startSteam = classroomSec.querySelector('.start-stream')
const roomForm = classroomSec.querySelector('.create-room-form');
const subSelection = classroomSec.querySelector('.class-selection');

const createRoomBtn = document.getElementById('create-room-btn');
const chooseSubBtn = classroomSec.querySelector('.choose-subjects');
const launchRoomBtn = document.getElementById('launch-room-btn');
const classroomErrorBox = classroomSec.querySelector('.semi-error-box');

const streamingBox = classroomSec.querySelector(".end-stream");

const classFormSubSelect = document.getElementById('class-form-sub-select');

let roomClasses = {}

createRoomBtn.addEventListener('click', () => {
    showClassroomErrorRemove()
    removeActives(classroomContainers)
    roomForm.classList.add('active');
})

chooseSubBtn.addEventListener('click', () => {
    removeActives(classroomContainers)
    subSelection.classList.add('active')

})

subSelection.querySelector('.close-btn').addEventListener('click', () => {
    removeActives(classroomContainers)
    roomForm.classList.add('active')
    const choosenClasses = subSelection.querySelectorAll('.selected');
    roomClasses = createDictionary(choosenClasses)
    console.log(roomClasses)
    insertToSelecteclassBox(roomClasses, roomForm)
})

roomForm.querySelector('.close-btn').addEventListener('click', resetClassroom)
setSelections(subSelection);


function showClassroomError(msg) {
    classroomErrorBox.style.display = 'flex';
    classroomErrorBox.innerText = msg;
}

function resetClassroom() {
    removeActives(classroomContainers)
    showClassroomErrorRemove()
    startSteam.classList.add('active');

}

function showClassroomErrorRemove() {
    classroomErrorBox.style.display = 'none'
}


//Resources
const addresourceBtnBox = resourcesSec.querySelector('.add-resourse-btn-box')
const addresourceBtn = resourcesSec.querySelector('.add-resourse-btn')
const addresourceForm = resourcesSec.querySelector('.add-resourse-form');
const selectResclassBtn = resourcesSec.querySelector('.choose-class-btn')
const resourcesClassSelection = resourcesSec.querySelector('.class-selection');
const resUpLoadFom = document.getElementById('res-upload-form');

const resFormSubSelect = document.getElementById('res-form-sub-select');
const upResSubSelect = document.getElementById('upres-sub-select');
const upResClassSelect = document.getElementById('upres-class-select');
const upResUL = document.getElementById('upres-ul');

addresourceBtn.addEventListener('click', () => {
    removeActives([addresourceBtnBox, addresourceForm, resourcesClassSelection])
    setActive(addresourceForm)
})

selectResclassBtn.addEventListener('click', () => {
    removeActives([addresourceBtnBox, resourcesClassSelection])
    setActive(resourcesClassSelection)
})

addresourceForm.querySelector('div.close-btn').addEventListener('click', () => {
    removeActives([addresourceForm])
    setActive(addresourceBtnBox)
})

resourcesClassSelection.querySelector('.close-btn').addEventListener('click', () => {
    let selection = createDictionary(getSelectedItems(resourcesClassSelection))
    insertToSelecteclassBox(selection, addresourceForm)
    removeActives([resourcesClassSelection])
})

setSelections(resourcesClassSelection)


resUpLoadFom.addEventListener('submit', (e) => {
    e.preventDefault();
    let classes = selectedToArray(resourcesClassSelection.querySelectorAll('.selected'));

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/teacher/add-resource.php', true)
    if (classes.length > 0) {
        xhr.onload = function() {
            try {
                const dct = JSON.parse(this.responseText);
                if (dct.success) {
                    resUpLoadFom.reset();
                }
            } catch {
                showMainError(this.responseText);
            }
        }
        const fData = new FormData(resUpLoadFom);
        fData.append('res-class', classes);
        xhr.send(fData);
        fetchResource()
    } else {
        showMainError('Please Select the classes.')
    }
});

upResClassSelect.addEventListener('change', () => {
    fetchResource();
})

upResSubSelect.addEventListener('change', () => {
    fetchResource();
})

function setDeleteBtns(box, delfunction, main_fun) {
    box.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            id = btn.parentElement.getAttribute('id');
            delfunction(id, main_fun);
        })
    })
}

function deleteRes(id, main_fun) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/teacher/del-resource.php?id=" + id, true)
    xhr.onload = function() {
        showMainError(this.responseText)
        main_fun()
    }
    xhr.send()
}

function fetchResource() {
    const sub = upResSubSelect.value;
    const cls = upResClassSelect.value;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/teacher/fetch-resource.php?subject=" + sub + "&class=" + cls, true)
    xhr.onload = function() {
        upResUL.innerHTML = this.responseText;
        setDeleteBtns(upResUL, deleteRes, fetchResource)
    }

    xhr.send();

}
fetchResource();

//homeworks
const upHWsubSelect = document.getElementById('hw-sub-select');
const upHWclassSelect = document.getElementById('hw-class-select');

//Community
const comSearchInp = document.getElementById('com-search-input');
const comSearchUL = document.getElementById('com-search-ul')
const comLbls = document.querySelectorAll('.community-head-box label');

comLbls.forEach(lbl => {
    lbl.addEventListener('click', () => {
        comLbls.forEach(lbl => lbl.classList.remove('active'));
        lbl.classList.add('active')
        if (lbl.innerText == 'TEACHER') {
            conType = 'teacher'
        } else {
            conType = 'student'
        }
        communitySearch(conType, comSearchInp, comSearchUL)
    })
})
let conType = 'student'
comSearchInp.addEventListener('keyup', () => {
    communitySearch(conType, comSearchInp, comSearchUL)
})
communitySearch('student', comSearchInp, comSearchUL)



function setActive(element) {
    element.classList.add('active')
}

fetchUserData(insertUserData);

function insertUserData(obj) {
    console.log(obj)
    document.getElementById('pr-user-name').innerText = obj.name;
    document.getElementById("user-profile-pic").src = obj.pic_url;
    addtoselect(obj.subject, classFormSubSelect);
    addtoselect(obj.subject, resFormSubSelect);
    addtoselect(obj.subject, upResSubSelect);
    addtoselect(obj.subject, upHWsubSelect);
    addtoselect(obj.class, upResClassSelect);
    addtoselect(obj.class, upHWclassSelect);
    AddToSelectionBox(subSelection, obj.class)
    AddToSelectionBox(resourcesClassSelection, obj.class)
}

function communitySearch(type, input, box) {
    let name = input.value;
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/teacher/community-search.php?user_type=' + type + '&name=' + name, true)
    xhr.onload = function() {
        box.innerHTML = this.responseText;
    }
    xhr.send()
}


const createRoomForm = document.getElementById("create-room-form");
createRoomForm.addEventListener("submit", (e) => {
    e.preventDefault();
    let classes = selectedToArray(subSelection.querySelectorAll('.selected'));

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/teacher/start-room.php', true)
    if (classes.length > 0) {
        xhr.onload = function() {
            try {
                const dic = JSON.parse(this.responseText);
                if (dic['success']) {
                    checkforRoom()
                }
            } catch (err) {
                console.log(err);
                showMainError(this.responseText);
            }
        }
        const fData = new FormData(createRoomForm);
        fData.append('class', classes);
        xhr.send(fData);
    } else {
        showMainError('Please Select the classes.')
    }
})

function checkforRoom() {

    const xhr = new XMLHttpRequest()
    xhr.open("GET", "../php/teacher/check-room.php", true);

    xhr.onload = function() {
        try {
            const dic = JSON.parse(this.responseText);
            if (dic.status == 'in_room') {
                classStarted(dic);
            } else {
                resetClassroom()
            }
        } catch {
            showMainError(this.responseText);
        }
    }
    xhr.send();
}
checkforRoom()

function classStarted(obj) {
    removeActives(classroomContainers)
    streamingBox.classList.add("active");
    let classBox = streamingBox.querySelector(".streaming-clases");

    streamingBox.querySelector('#steaming-subject').innerText = obj.subject;
    classBox.innerHTML = "";
    for (let i = 0; obj.class.length > i; i++) {
        const label = document.createElement("label");
        label.innerText = obj.class[i];
        classBox.append(label);
    }
}

function endClass() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/teacher/del-room.php", true)
    xhr.onload = function() {
        console.log(this.responseText)
    }
    xhr.send();
}

document.getElementById("end-stream-btn").addEventListener("click", () => {
    endClass();
    checkforRoom();
})


function fetchStudentHomeworks() {
    const xhr = new XMLHttpRequest();
    const sub = upHWsubSelect.value;
    const cls = upHWclassSelect.value;

    xhr.open("GET", "../php/teacher/fetch-student-homework.php?subject=" + sub + "&class=" + cls, true)
    xhr.onload = function() {
        stHWUL.innerHTML = this.responseText;
    }
    xhr.send();
}
upHWclassSelect.addEventListener("change", fetchStudentHomeworks)
upHWsubSelect.addEventListener("change", fetchStudentHomeworks)
const stHWUL = document.getElementById("st-up-homeworks");

fetchStudentHomeworks()