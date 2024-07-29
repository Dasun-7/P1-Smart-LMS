noImgUrl = "";

function setSelections(element) {
    element.querySelectorAll('div').forEach(div => {
        div.addEventListener('click', () => {
            if (div.classList.contains('selected')) {
                div.classList.remove('selected');
            } else {
                div.classList.add('selected')
            }
        })
    })
}

function removeActives(divs) {
    divs.forEach(div => {
        div.classList.remove('active')
    });
}

function createDictionary(divs) {
    let object = {}
    divs.forEach(div => {
        let id = div.getAttribute('id');
        let text = div.innerText;
        object[id] = text
    })
    return object;
}

function getSelectedItems(ele) {
    selections = ele.querySelectorAll('.selected');
    return selections
}

function insertToSelecteclassBox(obj, form) {
    form.querySelectorAll('fieldset div').forEach(div => div.remove())
    let label = form.querySelector('fieldset label');

    if (Object.values(obj).length > 0) {
        label.style.display = 'none';
        Object.values(obj).forEach(value => {
            let div = document.createElement('div');
            div.innerText = value;
            form.querySelector('fieldset').append(div)
        })
    } else {
        label.style.display = 'flex';
    }

}

function AddToSelectionBox(box, obj) {
    Object.keys(obj).forEach(key => {
        let div = document.createElement('div');
        div.setAttribute('id', key);
        div.innerText = obj[key];
        box.append(div);
    })
    setSelections(box)
}

function showMsg(msg, timeout) {
    let msgBox = document.querySelector('.msg-box');
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

function fetchAllCS(cs, box) {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", '../php/database/fetch-all-cs.php?cs=' + cs, true);

    xhr.onload = function() {
        try {
            let dic = JSON.parse(this.responseText)
            if (box.tagName == 'SELECT') {
                addtoselect(dic, box)
            } else {
                AddToSelectionBox(box, dic)
            }
        } catch (err) {
            console.log('fucked', err)
        }

    }
    xhr.send()
}

function addtoselect(obj, selectEl) {
    Object.keys(obj).forEach(key => {
        let opt = document.createElement('option');
        opt.value = key;
        opt.innerText = obj[key];
        selectEl.append(opt)
    })
}

function selectedToArray(divs) {
    const arr = [];

    divs.forEach(div => {
        let id = div.getAttribute('id');
        arr.push(id)
    });
    return arr;
}