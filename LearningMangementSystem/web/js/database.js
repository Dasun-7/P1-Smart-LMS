window.addEventListener("load", () => {

    const addclassBtn = document.getElementById('add-class-btn');
    const msgBox = document.querySelector('.msg-box');

    const addclassForm = document.getElementById('add-class-form');
    const addSubjectBtn = document.getElementById('add-subject-btn');
    const subjectForm = document.getElementById('add-subject-form');
    const allclassUl = document.getElementById('all-class-ul');
    const allSubsUl = document.getElementById('all-subs-ul');

    addclassBtn.addEventListener('click', () => {
        addclassBtn.classList.remove('active')
        addclassForm.classList.add('active')

    })
    addclassForm.querySelector('.close-btn').addEventListener('click', () => {
        addclassBtn.classList.add('active')
        addclassForm.classList.remove('active')
    })

    addSubjectBtn.addEventListener('click', () => {
        addSubjectBtn.classList.remove('active')
        subjectForm.classList.add('active')
    })

    subjectForm.querySelector('.close-btn').addEventListener('click', () => {
        addSubjectBtn.classList.add('active')
        subjectForm.classList.remove('active')
    })

    const addUserBox = document.querySelector(".add-user-bx");
    const addUserBtn = document.querySelector(".add-user-bx .add-icon");

    addUserBtn.addEventListener("click", () => {
        addUserBox.classList.toggle("active");
    })

    document.querySelector(".add-user-bx .close-btn").onclick = function() {
        addUserBox.classList.remove("active")
    }

    const stSearchClassSelect = document.getElementById('st-search-class');
    const teacherSearchSubSelect = document.getElementById('teacher-sub-search')

    subjectForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const sub_id = document.getElementById('sub-id-input').value;
        const sub_name = document.getElementById('sub-name-input').value;
        const param = `sub_id=${sub_id}&sub_name=${sub_name}`;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/database/add-cs.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            try {
                let msg = JSON.parse(this.response)
                if (msg['success']) {
                    showMsg(msg['success'], true);
                    subjectForm.reset();
                    fetchcstoDB('subject', allSubsUl)
                } else if (msg['failed']) {
                    showMsg(msg['failed'], false);
                }
            } catch (err) {
                showMsg(this.response, false)
            }

        }
        xhr.send(param)
    })

    addclassForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const class_no = document.getElementById('class-id-input').value;
        const class_name = document.getElementById('class-name-input').value;
        const param = `class_no=${class_no}&class_name=${class_name}`;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/database/add-cs.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            try {
                let msg = JSON.parse(this.response)
                if (msg['success']) {
                    showMsg(msg['success'], true);
                    addclassForm.reset();
                    fetchcstoDB('class', allclassUl)
                } else if (msg['failed']) {
                    showMsg(msg['failed'], false);
                }
            } catch (err) {
                showMsg(this.response, false)
            }

        }
        xhr.send(param)
    })

    const stSearchInput = document.getElementById('st-search-input');
    const stSearchSelect = document.getElementById('st-search-class');
    const stSearchUL = document.getElementById('st-search-ul');

    const thSearchInput = document.getElementById('th-search-input');
    const thSearchSelect = document.getElementById('teacher-sub-search')
    const thSearchUL = document.getElementById('th-search-ul')

    stSearchInput.addEventListener('keyup', () => {
        searchUser('student', stSearchInput, stSearchSelect, stSearchUL)
    })
    stSearchSelect.addEventListener('change', () => {
        searchUser('student', stSearchInput, stSearchSelect, stSearchUL)
    })

    thSearchInput.addEventListener('keyup', () => {
        searchUser('teacher', thSearchInput, thSearchSelect, thSearchUL)
    })
    thSearchSelect.addEventListener('change', () => {
        searchUser('teacher', thSearchInput, thSearchSelect, thSearchUL)
    })

    fetchAllCS('class', stSearchClassSelect)
    fetchAllCS('subject', teacherSearchSubSelect)

    searchUser('teacher', thSearchInput, thSearchSelect, thSearchUL)
    searchUser('student', stSearchInput, stSearchSelect, stSearchUL)

    ulClicks(thSearchUL)
    ulClicks(stSearchUL)

    fetchcstoDB('class', allclassUl)
    fetchcstoDB('subject', allSubsUl)



})





function showMsg(msg, timeout) {
    msgBox.classList.add('active');
    msgBox.getElementsByTagName('label')[0].innerText = msg

    if (timeout) {
        setTimeout(() => {
            msgBox.classList.remove('active')
        }, 5000)
    }
    msgBox.querySelector('.close-btn').addEventListener('click', () => {
        msgBox.classList.remove('active')
    })
}

function fetchcstoDB(type, box, func) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/database/fetch-cs-todatabase.php?cs=' + type, true);
    xhr.onload = function() {
        box.innerHTML = this.response;
        box.querySelectorAll('.delete-btn').forEach(div => {
            div.onclick = function() {
                let id = div.parentElement.getAttribute('id');
                deleteCS(type, id, box);
            }
        });
    }
    xhr.send()
}

function deleteCS(type, id, box) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/database/delete-cs.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        showMsg(this.responseText, true)
        fetchcstoDB(type, box)
    }
    xhr.send('cs=' + type + '&id=' + id)
}

function searchUser(type, input, select, box) {
    let name = input.value;
    let selection = select.value;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/database/search-user.php?user=' + type + '&name=' + name + '&select=' + selection, true)
    xhr.onload = function() {
        box.innerHTML = this.responseText;
    }
    xhr.send()
}

function ulClicks(ul) {
    ul.addEventListener('click', (e) => {
        if (e.target.tagName == "LI") {
            id = e.target.getAttribute('id')
        } else if (e.target.parentElement.tagName == "LI") {
            id = e.target.parentElement.getAttribute('id')
        }
    })
}