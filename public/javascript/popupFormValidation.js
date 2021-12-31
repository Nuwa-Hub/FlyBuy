const form = document.querySelector(".add.item-form");

// add item input fields
const inputField = document.querySelectorAll('.input-field.addItem');

// edit item input fields
const editInputFields = document.querySelectorAll('.input-field.editItem');

const addItemBtn = document.querySelector('.add-item.btn');

let correct = true;

// add item form
if (form){

    addItemBtn.addEventListener('click', (e) => {

        correct = true
        console.log(correct);
        for (let i = 0; i < inputField.length-1; i++){
            if (inputField[i].querySelector('input').value == ''){
                setError(inputField[i], 'Cannot be blank');
                correct = false;
            }
            else{
                removeError(inputField[i]);
                setSuccess(inputField[i]);
            }
        }
        
        if (correct){
            form.submit();
        }
        else{
            e.preventDefault();
        }
    });
}


function setError(element, msg){
    element.classList.add('error');
    element.querySelector('.tooltip-text').innerText = msg;
}

function setSuccess(element){
    element.classList.add('success');
}

function removeError(element){
    element.classList.remove('error')
}


function toggleDisplay(){
    let addItem = document.querySelector('.popup-window.addItem');
    addItem.classList.toggle('active');

    // Closing the popup window will remove the displayed errors
    for (let i = 0; i < inputField.length-1; i++){
        removeError(inputField[i]);
    }
}

function toggleLogout(){
    let logout = document.querySelector('.popup-window.logout');
    logout.classList.toggle('active');
}

function toggleEdit(element){

    let edit = document.querySelector('.popup-window.editItem');
    edit.classList.toggle('active');

    if (element != null){

        const itemDetails = element.parentElement.parentElement.parentElement;
        const itemId = itemDetails.getAttribute('id');

        edit.querySelector('.item-id').value = itemId;

        const itemName = itemDetails.querySelector('.item.name').innerText;
        const itemDescription = itemDetails.querySelector('.item.description').innerText;
        const itemAmount = itemDetails.querySelector('.item.amount').innerText;
        const itemPrice = itemDetails.querySelector('.item.price').innerText;

        edit.querySelector('.itemName').value = itemName;
        edit.querySelector('.amount').value = parseInt(itemAmount.split(" ")[0], 10);
        edit.querySelector('.price').value = parseFloat(itemPrice.split(" ")[1]);
        edit.querySelector('.description').value = itemDescription;

    }

}

function toggleDelete(element){
    
    let deleteItem = document.querySelector('.popup-window.delete-item');
    deleteItem.classList.toggle('active');

    if (element != null){

        const itemDetails = element.parentElement.parentElement.parentElement;
        const itemId = itemDetails.getAttribute('id');

        deleteItem.querySelector('.item-id').value = itemId;
    }
}

// toggle password view---------------------------------------------------------------
let toggleView      = document.querySelectorAll('.togglePassword');

function togglePasswordView(toggleView){
    for (let i = 0; i < toggleView.length; i++){
        let pswField = toggleView[i].parentElement.querySelector('input');

        toggleView[i].addEventListener('click', (event) => {
            // toggle the type attribute
            let type = pswField.getAttribute('type') === 'password' ? 'text' : 'password';
            pswField.setAttribute('type', type);
            // toggle the eye slash icon
            toggleView[i].classList.toggle('fa-eye-slash');
        });
    }
};

if (toggleView){
    togglePasswordView(toggleView);
}

// product list horizontal scrolling

const scrollLeft = document.querySelector('.scroll-left');
const scrollRight = document.querySelector('.scroll-right');

const productContainer = document.querySelector('.product-container');

if (productContainer){
    scrollRight.addEventListener('click', e => {
        productContainer.scrollLeft += 300;
    });
    
    scrollLeft.addEventListener('click', e => {
        productContainer.scrollLeft -= 300;
    });
}