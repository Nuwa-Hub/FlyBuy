const form = document.getElementById("item-form");

// add item input fields
const inputField = document.querySelectorAll('.input-field.addItem');

// edit item input fields
const editInputFields = document.querySelectorAll('.input-field.editItem');

const addItemBtn = document.querySelector('.add-item.btn');

let correct = true;

// add item form
if (form){
    addItemBtn.addEventListener('click', e => {

        correct = true
        
        for (let i = 0; i < inputField.length-1; i++){
            if (inputField[i].querySelector('input').value == ''){
                console.log(inputField[i]);
                setError(inputField[i], 'Cannot be blank');
                correct = false;
            }
            else{
                removeError(inputField[i]);
                setSuccess(inputField[i]);
            }
        }

        // console.log(correct);
        
        if (correct){
            
            const formData = new FormData(form);
            
            // fetch('../../app/ProductController.php', {
            //     method: 'post',
            //     body: formData
            // }).then(res => {
            //     return res.text();
            // }).then(text => {
            //     console.log(text);
            // }).catch(err => {
            //     console.error(err);
            // })

            fetch('http://localhost/Project/FlyBuy/ProductController/addItem', {
                method: "POST", // *GET, POST, PUT, DELETE, etc.
                mode: "same-origin", // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: "same-origin", // include, *same-origin, omit
                headers: {
                    "Content-Type": "application/json",  // sent request
                    "Accept":       "application/json"   // expected data sent back
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify( formData ), // body data type must match "Content-Type" header
            }).then(res => {
                return res.text();
            }).then(text => {
                console.log(text);
            }).catch(err => {
                console.error(err);
            })

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
        // console.log(element.parentElement.parentElement.getAttribute('id'));

        const itemDetails = element.parentElement.parentElement;
        const itemId = itemDetails.getAttribute('id');

        edit.querySelector('.item-id').value = itemId;

        const itemName = itemDetails.querySelector('.item-name').querySelector('div').innerText;
        const itemDescription = itemDetails.querySelector('.item-name').querySelector('small').innerText;
        const itemAmount = itemDetails.querySelector('.item-amount').innerText;
        const itemPrice = itemDetails.querySelector('.item-price').innerText;

        edit.querySelector('.itemName').value = itemName;
        edit.querySelector('.amount').value = parseInt(itemAmount.split(" ")[0], 10);
        edit.querySelector('.price').value = parseFloat(itemPrice.split(" ")[1]);
        edit.querySelector('.description').value = itemDescription;

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




