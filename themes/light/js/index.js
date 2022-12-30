//
// let slider = document.querySelector('.slider');
// let categoryGroup = document.querySelector('.category-group');
//
// window.addEventListener('resize',check);
// document.addEventListener('readystatechange',check);
//
//
// function check(){
//     let width = +document.body.clientWidth;
//     if(width<900 && categoryGroup.classList.contains('col-2')) {
//         slider.classList.remove('col-10')
//         categoryGroup.classList.remove('col-2')
//         slider.classList.add('col-12')
//         categoryGroup.classList.add('col-12')
//     }
//     if(width>=900 && !categoryGroup.classList.contains('col-2'))
//     {
//             slider.classList.remove('col-12')
//             categoryGroup.classList.remove('col-12')
//             slider.classList.add('col-10')
//             categoryGroup.classList.add('col-2')
//     }
// }





// let addProduct= document.querySelectorAll('.btnProductAddToBasket');
// let productInBasket = document.querySelectorAll('.btnProductInBasket');
// let productList = document.querySelector('.product-list');
// let countProductsInBasket = document.querySelector('.countProductsInBasket');
//
// productList.addEventListener('click',(event)=>{
//     let targetClick = event.target;
//     if(targetClick.classList.contains('btnProductAddToBasket')){
//         targetClick.classList.add('d-none');
//         targetClick.nextElementSibling.classList.remove('d-none');
//         let number = +countProductsInBasket.textContent.trim();
//         number+=1;
//         countProductsInBasket.textContent = number.toString();
//     }else if(targetClick.classList.contains('btnAddToLikeList') || targetClick.classList.contains('btnProductInLikeList')){
//         let elements = targetClick.parentElement.children;
//         for(let i = 0;i<elements.length;i++){
//             elements[i].classList.toggle('d-none');
//         }
//         // classList.toggle('d-none');
//         // targetClick.nextElementSibling.classList.toggle('d-none');
//     }
// })
//
// productList.addEventListener('click',(event)=>{
//     let targetClick = event.target;
//     if(targetClick.classList.contains('btnProductInBasket')){
//         location = "views/basket/index.php";
//     }
//
// })


function printFileImage(fileSelector,divPrinterFiles,width,heigth,showAll, url = false){
    let files = fileSelector.files;
    let counter = 0;
    if(files.length>0){

        for(let i = divPrinterFiles.children.length-1;i>=0;i--){
            divPrinterFiles.children[i].remove()
        }

        for (const file of files) {
            let img = document.createElement('img');
            let obj = URL.createObjectURL(file)
            img.setAttribute('src',obj);
            img.style.width = width;
            img.style.height = heigth;
            if(divPrinterFiles.children.length>0 && showAll===false){
                divPrinterFiles.firstElementChild.remove();
            }

            if(files.length>1){
                let radio = document.createElement('input');
                let label = document.createElement('label');
                let inputUrl = document.createElement('input');
                inputUrl.setAttribute('name','url'+counter)

                radio.setAttribute('type','radio');
                radio.setAttribute('name','photoSelected');
                radio.setAttribute('value',counter.toString())
                radio.setAttribute('id',file.name);
                label.setAttribute('for',file.name);
                inputUrl.setAttribute('url','text')
                inputUrl.style.marginLeft = "10px"
                inputUrl.setAttribute('placeholder','URL');
                label.append(img);
                label.append(inputUrl);
                let divWrapper = document.createElement('div');
                if(counter>0){
                    divWrapper.style.marginTop = "10px";
                }
                divWrapper.append(radio);
                divWrapper.append(label);
                divPrinterFiles.append(divWrapper);
                counter++;
            }else if(files.length===1 && url===true){
                let inputUrl = document.createElement('input');
                inputUrl.setAttribute('url','text')
                inputUrl.style.marginLeft = "10px"
                inputUrl.setAttribute('placeholder','URL');
                inputUrl.setAttribute('name','url')
                let divWrapper = document.createElement('div');
                divWrapper.append(img);
                divWrapper.append(inputUrl);
                divPrinterFiles.append(divWrapper);
            }else{
                let divWrapper = document.createElement('div');
                divWrapper.append(img)
                divPrinterFiles.append(divWrapper);
            }
        }
    }
}

let selectorSlider = document.querySelector('.filesSelectedForSlider');
if(selectorSlider!=null){
    selectorSlider.addEventListener('change',()=>{
        let divSelectedFilesForSlider = document.querySelector('.divSelectedFilesForSlider');
        divSelectedFilesForSlider.classList.add('mb-3')
        printFileImage(selectorSlider,divSelectedFilesForSlider,"450px", "150px",true,true)
    })
}

let fileSelectorCategory= document.querySelector('.filesSelectedForCategory');
if(fileSelectorCategory!=null){
    fileSelectorCategory.addEventListener('change',()=>{
        let divSelectedFilesForCategory = document.querySelector('.divSelectedFilesForCategory');
        divSelectedFilesForCategory.classList.add('mb-3')
        printFileImage(fileSelectorCategory,divSelectedFilesForCategory,"60px", "60px",false)
    })
}
