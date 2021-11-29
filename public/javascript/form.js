// toggle login and signup animation
const sign_in_btn   = document.querySelector('#sign-in-button');
const sign_up_btn   = document.querySelector('#sign-up-button');
const container     = document.querySelector('.container');


if(sign_in_btn){
    console.log("here");
    sign_up_btn.addEventListener('click', () => {
        container.classList.add('sign-up-mode');
        sessionStorage['signup'] = true;
    });
    
    sign_in_btn.addEventListener('click', () => {
        container.classList.remove('sign-up-mode');
        sessionStorage['signup'] = false;
    });

    // sessionStorage is used to set the login page to signin or signup when refreshed in submit

    // console.log(sessionStorage.getItem('signup'));

    if(sessionStorage.getItem('signup') == 'true'){
        // console.log("in signup");
        sign_up_btn.click();
    }
    else if(sessionStorage.getItem('signup') == 'false'){
        // console.log("in signin");
        sign_in_btn.click();
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

// add extra seller information
let radioBtns = document.querySelectorAll('.radioBtn');
let storeName = document.querySelector('.input-field.store');

function addField(){
    storeName.classList.remove('remove');

}

function removeField(){
    storeName.classList.add('remove');
}