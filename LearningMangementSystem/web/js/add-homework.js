const classSelectBox = document.querySelector('.class-select-bx')
const selectedclassBox = document.querySelector('.selected-classes')
const subSelect = document.getElementById("sub-select")

classSelectBox.querySelector('.close-btn').addEventListener('click', () => {
    let obj = createDictionary(getSelectedItems(classSelectBox))
    insertToSelecteclassBox(obj, selectedclassBox)
    selectedclassBox.classList.add('active')
    classSelectBox.classList.remove('active')

})

selectedclassBox.querySelector('.select-cls-btn').addEventListener('click', () => {
    selectedclassBox.classList.remove('active')
    classSelectBox.classList.add('active')
})

setSelections(classSelectBox)

fetchCS();

homeworkForm = document.getElementById("homework-form");
homeworkForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const classes = selectedToArray(getSelectedItems(classSelectBox));
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/teacher/homework-form.php", true);
    xhr.onload = function() {
        try {
            let opt = JSON.parse(this.responseText);

            if (opt.success) {
                homeworkForm.reset();
            }
        } catch {
            console.log(this.responseText);
        }
    }
    const fData = new FormData(homeworkForm);
    fData.append("class", classes)
    xhr.send(fData);
})





function fetchCS() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/teacher/fetch-cs-data.php", true);
    xhr.onload = function() {
        try {
            const dct = JSON.parse(this.responseText);
            addtoselect(dct.subject, subSelect)
            AddToSelectionBox(classSelectBox, dct.class)
        } catch {
            console.log(this.responseText);
        }

    }

    xhr.send();
}