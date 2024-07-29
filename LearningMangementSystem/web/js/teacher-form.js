const selectSubsBtnBox = document.querySelector('.select-sub-btn-bx')
const subSelectBox = document.querySelector('.sub-select-box')
const selectSubsBtn = selectSubsBtnBox.querySelector('.select-btn')
const subSelectBoxClose = subSelectBox.querySelector('.close-btn')
const selectedSubjects = document.querySelector('.selected-subjects');
const profileImgInput = document.getElementById('user-pic');
const profileImg = document.getElementById('profile-img');

const selectClassBtnBox = document.querySelector('.select-class-btn-bx')
const classSelectBox = document.querySelector('.class-select-box')
const selectClasssBtn = selectClassBtnBox.querySelector('.select-btn')
const classSelectBoxClose = classSelectBox.querySelector('.close-btn')
const selectedClasses = document.querySelector('.selected-classes');

const msgBox = document.querySelector('.msg-box');
const addTeacheForm = document.getElementById('teacher-form');

selectSubsBtn.addEventListener('click', () => {
    selectSubsBtnBox.classList.remove('active')
    subSelectBox.classList.add('active')

})

selectClasssBtn.addEventListener('click', () => {
    selectClassBtnBox.classList.remove('active')
    classSelectBox.classList.add('active')

})

subSelectBoxClose.addEventListener('click', () => {
    selectSubsBtnBox.classList.add('active')
    subSelectBox.classList.remove('active')
    let obj = createDictionary(getSelectedItems(subSelectBox))
    insertToSelecteclassBox(obj, selectedSubjects)
})

classSelectBoxClose.addEventListener('click', () => {
    selectClassBtnBox.classList.add('active')
    classSelectBox.classList.remove('active')
    let obj = createDictionary(getSelectedItems(classSelectBox))
    insertToSelecteclassBox(obj, selectedClasses)
})

profileImgInput.addEventListener('change', () => {
    const reader = new FileReader()
    reader.onload = (e) => {
        profileImg.src = e.target.result;
    }
    reader.readAsDataURL(profileImgInput.files[0])
})

fetchAllCS('subject', subSelectBox)
fetchAllCS('class', classSelectBox)

addTeacheForm.addEventListener('submit', (e) => {
    e.preventDefault();

    let subjects = selectedToArray(getSelectedItems(subSelectBox));
    let classes = selectedToArray(getSelectedItems(classSelectBox));

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '../php/database/add-user.php', true);
    xhr.onload = function() {
        console.log(this.responseText)
        try {
            let msg = JSON.parse(this.response);
            if (msg['success']) {
                let text = msg['success']
                showMsg(text, true);
                addTeacheForm.reset();
            } else if (msg['failed']) {
                showMsg(msg['failed'], false);
            }
        } catch (err) {
            showMsg(this.response, false)
        }
    }
    let fData = new FormData(addTeacheForm);
    fData.append('subject', subjects);
    fData.append('class', classes);
    xhr.send(fData);

})