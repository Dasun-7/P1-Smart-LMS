const selectSubsBtnBox = document.querySelector('.select-sub-btn-bx')
const subSelectBox = document.querySelector('.sub-select-box')
const selectSubsBtn = selectSubsBtnBox.querySelector('.select-btn')
const subSelectBoxClose = subSelectBox.querySelector('.close-btn')
const selectedSubjects = document.querySelector('.selected-subjects');
const profileImgInput = document.getElementById('user-pic');
const profileImg = document.getElementById('profile-img');

const addStudentForm = document.getElementById('add-student-form');

selectSubsBtn.addEventListener('click', () => {
    selectSubsBtnBox.classList.remove('active')
    subSelectBox.classList.add('active')
})

subSelectBoxClose.addEventListener('click', () => {
    selectSubsBtnBox.classList.add('active')
    subSelectBox.classList.remove('active')
    let obj = createDictionary(getSelectedItems(subSelectBox))
    insertToSelecteclassBox(obj, selectedSubjects)
})

profileImgInput.addEventListener('change', () => {
    const reader = new FileReader()
    reader.onload = (e) => {
        profileImg.src = e.target.result;
    }
    reader.readAsDataURL(profileImgInput.files[0])
})
const stClassSelect = document.getElementById('student-class-input');
fetchAllCS('subject', subSelectBox)
fetchAllCS('class', stClassSelect)

addStudentForm.addEventListener('submit', (e) => {
    e.preventDefault();

    let subjects = selectedToArray(getSelectedItems(subSelectBox));
    const xhr = new XMLHttpRequest();
    xhr.open("POST", '../php/database/add-user.php', true);
    xhr.onload = function() {
        console.log(this.responseText)
        try {
            let msg = JSON.parse(this.response);
            if (msg['success']) {
                let text = msg['success']
                showMsg(text, true);
                addStudentForm.reset();
                profileImg.src = noImgUrl;
            } else if (msg['failed']) {
                showMsg(msg['failed'], false);
            }
        } catch (err) {
            showMsg(this.response, false)
        }
    }

    let fData = new FormData(addStudentForm);
    fData.append('subject', subjects);
    xhr.send(fData);

})