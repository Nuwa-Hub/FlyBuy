const form = document.getElementById("item-form");

// add item input fields
const inputField = document.querySelectorAll('.input-field.addItem');

// edit item input fields
const editInputFields = document.querySelectorAll('.input-field.editItem');

const addItemBtn = document.querySelector('.add-item.btn');

let correct = true;

if (form){
    form.addEventListener('submit', e => {

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

        console.log(correct);

        if (correct){
            
            const formData = new FormData(form);

            fetch('../view/sellerAccount.php', {
                method: 'post',
                body: formData
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


// const logoutForm = document.querySelector('.logoutForm');
// const logoutBtn = document.querySelector('.logout.btn');

// if (logoutForm){
//     logoutBtn.addEventListener('click', e => {
//         e.preventDefault();

//         toggleLogout();

//         logoutForm.submit();
//     });
// }


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

function toggleEdit(){
    let edit = document.querySelector('.popup-window.editItem');
    edit.classList.toggle('active');
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




