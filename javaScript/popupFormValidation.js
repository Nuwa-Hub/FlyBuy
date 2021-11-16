const form = document.getElementById("item-form");

const inputField = document.querySelectorAll('.input-field');

const addItemBtn = document.querySelector('.add-item.btn');

let correct = true;

if (form){
    form.addEventListener('submit', e => {

        correct = true
        
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
            
            const formData = new FormData(form);

            fetch('../view/sellerAccount.php', {
                method: 'post',
                body: formData
            }).then(res => {
                return res.text();
            }).then(text => {
                // console.log(text);
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
