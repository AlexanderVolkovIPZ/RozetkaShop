////////////// SLIDER RESIZE SCREEN ADAPTIVE ///////////////////
let slider = document.querySelector('.slider');
let categoryGroup = document.querySelector('.category-group');

window.addEventListener('resize', check);
document.addEventListener('readystatechange', check);

function check() {
    let width = +document.body.clientWidth;
    if (width < 900 && categoryGroup != null && categoryGroup.classList.contains('col-2')) {
        slider.classList.remove('col-10')
        categoryGroup.classList.remove('col-2')
        slider.classList.add('col-12')
        categoryGroup.classList.add('col-12')
    }
    if (width >= 900 && categoryGroup != null && !categoryGroup.classList.contains('col-2')) {
        slider.classList.remove('col-12')
        categoryGroup.classList.remove('col-12')
        slider.classList.add('col-10')
        categoryGroup.classList.add('col-2')
    }
}


//////////////////////////// BUTTON CUSTOMER BUY PRODUCT IN CATEGORY///////////////////////////////
function sendRequestAddProductToBasket(productId) {
    const xhr = new XMLHttpRequest();
    productId = encodeURIComponent(productId);
    xhr.open("GET", `/basket/add?id=${productId}`);
    xhr.onload = () => {
        document.querySelector('.countProductsInBasket').textContent = JSON.parse(xhr.response);
    }
    xhr.send();
}

let productList = document.querySelector('.product-list');
let addProduct = document.querySelectorAll('.btnProductAddToBasket');
let productInBasket = document.querySelectorAll('.btnProductInBasket');
let countProductsInBasket = document.querySelector('.countProductsInBasket');
addProduct.forEach(button => {
    button.addEventListener('click', (event) => {
        let idProduct = event.currentTarget.dataset.id
        sendRequestAddProductToBasket(idProduct)
        event.preventDefault();
    })
})

if (productList != null) {
    productList.addEventListener('click', (event) => {
        let targetClick = event.target;
        if (targetClick.parentNode.classList.contains('btnProductAddToBasket')) {
            targetClick.parentNode.classList.add('d-none');
            targetClick.parentNode.nextElementSibling.classList.remove("d-none")
        }



        // else if (targetClick.parentElement.classList.contains('btnAddToLikeList') || targetClick.parentElement.classList.contains('btnProductInLikeList')) {
        //     let elements = targetClick.parentElement.parentElement.children;
        //     for (let i = 0; i < elements.length; i++) {
        //         elements[i].classList.toggle('d-none');
        //     }
        // }

    })
}
//////////////////////////// BUTTON CUSTOMER BUY PRODUCT IN PRODUCT///////////////////////////////

let buttonsAddProduct = document.querySelectorAll('.btnAddProductToBasket')
buttonsAddProduct.forEach(button => {
    button.addEventListener('click', (event) => {

    if(!event.currentTarget.lastElementChild.classList.contains('d-none')){
        event.currentTarget.lastElementChild.classList.add('d-none');
        event.currentTarget.firstElementChild.classList.toggle('d-none');
        let idProduct = +event.currentTarget.dataset.id
        sendRequestAddProductToBasket(idProduct)
    }
    })
})


////////////// BUTTON CUSTOMER LIKE PRODUCT///////////////////
function sendRequestAddProductToWishList(productId){
     const xhr = new XMLHttpRequest();
    xhr.open("GET",`/wish/add?idProduct=${productId}`);
    xhr.onload = ()=>{

    }
    xhr.send();
}

let addProductInLikeList = document.querySelectorAll('.btnAddToLikeList');
let elem = document.querySelector('.wishListCount');
addProductInLikeList.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        let elemValue = +elem.textContent;
        elemValue+=1;
        elem.textContent = elemValue;
        let productId = +event.currentTarget.dataset.id;
        event.currentTarget.classList.toggle('d-none');
        event.currentTarget.nextElementSibling.classList.toggle('d-none')
        sendRequestAddProductToWishList(productId)
    })
})
function sendRequestRemoveProductFromWishList(productId){
    const xhr = new XMLHttpRequest();
    xhr.open("GET",`/wish/remove?idProduct=${productId}`);
    xhr.onload = ()=>{

    }
    xhr.send();
}

let btnProductInLikeList = document.querySelectorAll('.btnProductInLikeList');
let wishListMainWrapper = document.querySelector('.wishListMainWrapper');
btnProductInLikeList.forEach(button=>{
    button.addEventListener('click', (event)=>{
        event.preventDefault();
        let elemValue = +elem.textContent;
        elemValue-=1;
        elem.textContent = elemValue;
        let productId = +event.currentTarget.dataset.id;

        event.currentTarget.classList.toggle('d-none')
        event.currentTarget.previousElementSibling.classList.toggle('d-none')
        sendRequestRemoveProductFromWishList(productId)
        if(event.currentTarget.classList.contains('wishSection')){
            event.currentTarget.closest('.wishSectionWrapper').remove();
        }
        if(wishListMainWrapper.children.length===0){
            location.reload();
        }
    })
})




////////////// SLIDER OPERATION///////////////////
function printFileImage(fileSelector, divPrinterFiles, width, heigth, showAll, url = false) {
    let files = fileSelector.files;
    let counter = 0;
    if (files.length > 0) {

        for (let i = divPrinterFiles.children.length - 1; i >= 0; i--) {
            divPrinterFiles.children[i].remove()
        }

        for (const file of files) {
            let img = document.createElement('img');
            let obj = URL.createObjectURL(file)
            img.setAttribute('src', obj);
            img.style.width = width;
            img.style.height = heigth;
            if (divPrinterFiles.children.length > 0 && showAll === false) {
                divPrinterFiles.firstElementChild.remove();
            }

            if (files.length > 1) {
                let radio = document.createElement('input');
                let label = document.createElement('label');
                let inputUrl = document.createElement('input');
                inputUrl.setAttribute('name', 'url' + counter)

                radio.setAttribute('type', 'radio');
                radio.setAttribute('name', 'photoSelected');
                radio.setAttribute('value', counter.toString())
                radio.setAttribute('id', file.name);
                label.setAttribute('for', file.name);
                inputUrl.setAttribute('url', 'text')
                inputUrl.style.marginLeft = "10px"
                inputUrl.setAttribute('placeholder', 'URL');
                label.append(img);
                label.append(inputUrl);
                let divWrapper = document.createElement('div');
                if (counter > 0) {
                    divWrapper.style.marginTop = "10px";
                }
                divWrapper.append(radio);
                divWrapper.append(label);
                divPrinterFiles.append(divWrapper);
                counter++;
            } else if (files.length === 1 && url === true) {
                let inputUrl = document.createElement('input');
                inputUrl.setAttribute('url', 'text')
                inputUrl.style.marginLeft = "10px"
                inputUrl.setAttribute('placeholder', 'URL');
                inputUrl.setAttribute('name', 'url')
                let divWrapper = document.createElement('div');
                divWrapper.append(img);
                divWrapper.append(inputUrl);
                divPrinterFiles.append(divWrapper);
            } else {
                let divWrapper = document.createElement('div');
                divWrapper.append(img)
                divPrinterFiles.append(divWrapper);
            }
        }
    }
}

let selectorSlider = document.querySelector('.filesSelectedForSlider');
if (selectorSlider != null) {
    selectorSlider.addEventListener('change', () => {
        let divSelectedFilesForSlider = document.querySelector('.divSelectedFilesForSlider');
        divSelectedFilesForSlider.classList.add('mb-3')
        printFileImage(selectorSlider, divSelectedFilesForSlider, "450px", "150px", true, true)
    })
}

let fileSelectorCategory = document.querySelector('.filesSelectedForCategory');
if (fileSelectorCategory != null) {
    fileSelectorCategory.addEventListener('change', () => {
        let divSelectedFilesForCategory = document.querySelector('.divSelectedFilesForCategory');
        divSelectedFilesForCategory.classList.add('mb-3')
        printFileImage(fileSelectorCategory, divSelectedFilesForCategory, "60px", "60px", false)
    })
}


////////////////////////////////// AJAX REQUEST (CHANGE TYPE ACCESS)//////////////////////////////////////////
function sendRequestAccess(userId, typeAccess) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/user/access?id=${userId}&type=${typeAccess}`);
    xhr.onerror = () => {
        alert("Error 404!")
    }
    xhr.send();
}

let buttons = document.querySelectorAll('.changeUserAccess');
buttons.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();

        let valueTypeAccess = +event.target.closest('td').previousElementSibling.firstElementChild.value
        let userId = +event.target.closest('td').previousElementSibling.firstElementChild.dataset.access;
        if (Number.isFinite(valueTypeAccess) && (valueTypeAccess === 10 || valueTypeAccess === 1) && Number.isFinite(userId)) {
            sendRequestAccess(userId, valueTypeAccess);
        }
    })
})

//////////////////////////////////////////////BUTTONS ADD PRODUCT IN BASKET///////////////////////////////////////////

let addProductBsk = document.querySelectorAll('.addProductCountBasket');
let removeProductBsk = document.querySelectorAll('.removeProductCountBasket');
let inputCountProductBasket = document.querySelectorAll('.basketFormInputCountProduct');

inputCountProductBasket.forEach(button => {
    button.addEventListener('input', (event) => {
        event.currentTarget.value = event.currentTarget.value.replace(/[^0-9]/gi, '')
    })

})

function updateMethodCountProductBsk(productId, count) {
    const xhr = new XMLHttpRequest();
    console.log(xhr.responseText)
    xhr.open("GET", `/basket/update?id=${productId}&count=${count}`);
    xhr.onload = () => {
        document.querySelector('.countProductsInBasket').textContent = JSON.parse(xhr.response);
    }
    xhr.send();
}

function getSumBasket() {
    const xhr = new XMLHttpRequest();
    console.log(xhr.responseText)
    xhr.open("GET", `/basket/sum`);
    xhr.onload = () => {
        document.querySelector('.allSumBasket').textContent = JSON.parse(xhr.response);
    }
    xhr.send();
}

function getSumOneRecord(id, count) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/basket/sum_one_record?id=${id}&count=${count}`);
    xhr.onload = () => {
        document.getElementById(id).textContent = JSON.parse(xhr.response);
    }
    xhr.send();
}

addProductBsk.forEach(button => {
    button.addEventListener('click', (event) => {
        let eventTarget = event.currentTarget.previousElementSibling;
        let count = +eventTarget.value;
        count += 1;
        eventTarget.value = count;
        let productId = +eventTarget.dataset.id;
        updateMethodCountProductBsk(productId, count);
        getSumOneRecord(productId, count)
        getSumBasket();
    })
})

removeProductBsk.forEach(button => {
    button.addEventListener('click', (event) => {
        let eventTarget = event.currentTarget.nextElementSibling;
        let count = +eventTarget.value;
        if (count > 1) {
            count -= 1;
            eventTarget.value = count;
            let productId = +eventTarget.dataset.id;
            updateMethodCountProductBsk(productId, count);
            getSumOneRecord(productId, count)
            getSumBasket();
        }
    })
})

///////////////////////////////////////BUTTONS DELETE PRODUCTS FROM BASKET//////////////////////////////////////
function deleteProductFromBsk(idProduct) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/basket/delete?id=${idProduct}`);
    xhr.onload = () => {
        document.querySelector('.countProductsInBasket').textContent = JSON.parse(xhr.response);
    }
    xhr.send();
}

let deleteProductFromBasket = document.querySelectorAll('.btnDeleteProductFromBasket')
deleteProductFromBasket.forEach(button => {
    let dataIdAttribute;
    button.addEventListener('click', (event) => {
        if (event.target.tagName === 'path') {
            dataIdAttribute = +event.target.parentElement.dataset.id;
        } else if (event.target.tagName === 'svg') {
            dataIdAttribute = +event.target.dataset.id
        }
        event.currentTarget.parentElement.parentElement.remove();
        deleteProductFromBsk(dataIdAttribute);
        getSumBasket();
        if (document.querySelector('.tableBody').children.length === 0) {
            location.reload();
        }
    })
})


///////////////////////////////////////VALIDATION REGISTER USER//////////////////////////////////////
function validationMethodFIO(fieldName) {
    var pattern = /[А-ЯЇІ][а-яії]+/i;

    if (fieldName.value === "" || fieldName.value.length < 3 || pattern.test(fieldName.value) === false) {
        fieldName.classList.add('is-invalid');
        fieldName.classList.remove('is-valid');
    } else {
        fieldName.classList.add('is-valid');
        fieldName.classList.remove('is-invalid');
    }
}

let firstNameField = document.getElementById('firstname');
let middleNameField = document.getElementById('middlename');
let lastNameField = document.getElementById('lastname');
let loginField = document.getElementById('login');
let password1Field = document.getElementById('password1');
let password2Field = document.getElementById('password2');
let invalidFeedback = document.querySelectorAll('.invalid-feedback');

if (firstNameField != null)
    firstNameField.addEventListener('change', () => {
        validationMethodFIO(firstNameField)
    })

if (middleNameField != null)
    middleNameField.addEventListener('change', () => {
        validationMethodFIO(middleNameField)
    })

if (lastNameField != null)
    lastNameField.addEventListener('change', () => {
        validationMethodFIO(lastNameField)
    })

if (loginField != null)
    loginField.addEventListener('change', () => {
        var pattern = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
        if (loginField.value === "" || pattern.test(loginField.value) === false) {
            loginField.classList.add('is-invalid');
            loginField.classList.remove('is-valid');
        } else {
            loginField.classList.add('is-valid');
            loginField.classList.remove('is-invalid');
        }
    })

function validPassword(password1Field, password2Field) {
    let pattern = /^(?=.*[a-z])(?=.*[A-Z]*)(?=.*\d)[a-zA-Z\d]{8,}$/
    password1Field.addEventListener('change', () => {
        if (password1Field.value === "" || (password2Field.value !== "" && password1Field.value !== password2Field.value) || password1Field.value.length < 3 || pattern.test(password2Field.value) === false) {
            password1Field.classList.add('is-invalid');
            password1Field.classList.remove('is-valid');
        } else {
            password1Field.classList.add('is-valid');
            password1Field.classList.remove('is-invalid');
            if (password1Field.value === password2Field.value) {
                password2Field.classList.add('is-valid');
                password2Field.classList.remove('is-invalid');
            }
        }
    })
}

if (password1Field != null) {
    validPassword(password1Field, password2Field)
}

if (password2Field != null) {
    validPassword(password2Field, password1Field)
}

for (let i = 0; i < invalidFeedback.length; i++) {
    if (invalidFeedback[i].innerText.trim().length !== 0) {
        invalidFeedback[i].previousElementSibling.classList.add('is-invalid');
        invalidFeedback[i].previousElementSibling.classList.remove('is-valid');
    }
}

/////////////////////////////////// EDIT USER DATES ///////////////////////////////////////////////////
let buttonEdit = document.querySelector('.btnEditUserDates');
let buttonChange = document.querySelector('.btnCreateChange');
let buttonNoEdit = document.querySelector('.btnNoChange');

let firstNameLabel = document.querySelector('.firstNameLabel')
let middleNameLabel = document.querySelector('.middleNameLabel')
let lastNameLabel = document.querySelector('.lastNameLabel')

if (buttonEdit != null) {
    buttonEdit.addEventListener('click', (event) => {
        event.currentTarget.parentElement.classList.toggle('d-none');
        event.target.parentElement.nextElementSibling.classList.toggle('d-none')
        firstNameLabel.nextElementSibling.setAttribute('value', firstNameLabel.textContent)
        toggleClassesLable(firstNameLabel)
        middleNameLabel.nextElementSibling.setAttribute('value', middleNameLabel.textContent)
        toggleClassesLable(middleNameLabel)
        lastNameLabel.nextElementSibling.setAttribute('value', lastNameLabel.textContent)
        toggleClassesLable(lastNameLabel)
    })
}
if (buttonChange != null) {
    buttonChange.addEventListener('click', (event) => {
        event.currentTarget.parentElement.classList.toggle('d-none')
        buttonEdit.parentElement.classList.toggle('d-none')

        firstNameLabel.classList.toggle('d-none')
        firstNameLabel.nextElementSibling.classList.toggle('d-none')

        middleNameLabel.classList.toggle('d-none')
        middleNameLabel.nextElementSibling.classList.toggle('d-none')

        lastNameLabel.classList.toggle('d-none')
        lastNameLabel.nextElementSibling.classList.toggle('d-none')

    })
}

if (buttonNoEdit != null) {
    buttonNoEdit.addEventListener('click', (event) => {
        event.currentTarget.parentElement.classList.toggle('d-none')
        buttonEdit.parentElement.classList.toggle('d-none')


        toggleClassesLable(firstNameLabel)
        toggleClassesLable(middleNameLabel)
        toggleClassesLable(lastNameLabel)
    })
}

function toggleClassesLable(labelName) {
    labelName.classList.toggle('d-none')
    labelName.nextElementSibling.classList.toggle('d-none')
}


// function returnLabelUserInfo(){
//     firstNameLabel.classList.toggle('d-none')
//     middleNameLabel.classList.toggle('d-none')
//     lastNameLabel.classList.toggle('d-none')
// }

/////////////////////////////////EDIT SHOW/HIDE PASSWORD/////////////////////////////////////////////
if (document.querySelector('.img-edit-password1') != null) {
    document.querySelector('.img-edit-password1').addEventListener('click', (event) => {
        showHidePasswordInSettings('.editPassword1', event);
    })
}
if (document.querySelector('.img-edit-password2') != null) {
    document.querySelector('.img-edit-password2').addEventListener('click', (event) => {
        showHidePasswordInSettings('.editPassword2', event);
    })
}


function showHidePasswordInSettings(editPasswordFieldClass, event) {
    let input = document.querySelector(editPasswordFieldClass);
    if (input.getAttribute('type') === 'password') {
        event.target.classList.add('view');
        input.setAttribute('type', 'text');
    } else {
        event.target.classList.remove('view');
        input.setAttribute('type', 'password');
    }
}

////////////////////////////////////////////////////PRODUCT REITING COMMENT WRITE///////////////////////////////////////////////
let reitingRadious = document.querySelectorAll('.reitingRadio');
let markStars = document.querySelectorAll('.mark-star');
reitingRadious.forEach(mark => {
    mark.addEventListener('click', (event) => {
        let id = +event.target.value;
        for (let i = 0; i < 5; i++) {
            if (i < id) {
                markStars[i].style.backgroundImage = "url('/files/additionalsForCSS/reitingStars/mark-star-yellow.png')";
            } else {
                markStars[i].style.backgroundImage = "url('/files/additionalsForCSS/reitingStars/mark-star-black.png')";
            }
        }
    })
})

// let commentArea = document.querySelector('.commentArea');
// commentArea.addEventListener('click',()=>{
//     alert(12);
// })
// commentArea.addEventListener('change', ()=>{
//     if(commentArea.textContent.length<5){
//         commentArea.classList.toggle('is-invalid');
//     }
// })

////////////////////////////////////////////////////PRODUCT REITING COMMENT PRINT///////////////////////////////////////////////
let reitingScores = document.querySelectorAll('.scoreReiting');

reitingScores.forEach(value => {
    let reitingValue = +value.dataset.reiting;
    for (let i = 0; i < 5; i++) {
        if (i < reitingValue) {
            value.children[i].style.backgroundImage = "url('/files/additionalsForCSS/reitingStars/mark-star-yellow.png')";
        } else {
            value.children[i].style.backgroundImage = "url('/files/additionalsForCSS/reitingStars/mark-star-black.png')";
        }
    }
})

//////////////////////////////////////////////////////SELECT TOWN AND DESTINATION////////////////////////////////////////


function requestGetDestinations(id, selectDestination) {
    const xhr = new XMLHttpRequest();
    // console.log(xhr.responseText)
    xhr.open("GET", `/basket/destinations?id=${id}`);
    xhr.onload = () => {
        let objs = JSON.parse(xhr.response)

        if (selectDestination.children.length > 1) {
            for (let i = selectDestination.children.length - 1; i > 0; i--) {
                selectDestination.children[i].remove();
            }
        }

        for (let obj of objs) {
            let option = document.createElement('option');
            option.setAttribute('value', obj['id'])
            option.textContent = obj['name'];
            selectDestination.append(option);
        }
    }
    xhr.send();
}

let selectTown = document.querySelector('.selectTown');
let selectDestination = document.querySelector('.selectDestination');

if (selectTown != null) {
    selectTown.addEventListener('change', (event) => {
        let selectedValue = +event.target.value;
        if (selectedValue != null) {
            requestGetDestinations(selectedValue, selectDestination)
        }
    })
}

///////////////////////////////////////////// CHANGE STATUS PRODUCT ///////////////////////////////
function sendRequestChangeStatusOrder(orderId) {
    const xhr = new XMLHttpRequest();
    // console.log(xhr.responseText)
    xhr.open("GET", `/basket/order_status?id=${orderId}`);
    xhr.onload = () => {
    }
    xhr.send();
}


let svgBtnChangeStatusProduct = document.querySelectorAll('.productWasSend');
svgBtnChangeStatusProduct.forEach(button => {
    button.addEventListener('click', (event) => {
        let orderId = +event.currentTarget.closest('tr').dataset.order;
        sendRequestChangeStatusOrder(orderId)
        event.currentTarget.closest('tr').remove();
    })
})
