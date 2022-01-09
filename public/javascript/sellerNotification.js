$(document).ready(function() {

    var seller_id = document.querySelector('.seller-id.notify').value;

    function load_unseen_notification(view = '') {

        $.ajax({
            url: "http://localhost/Project/FlyBuy/UserController/getNotificationCount",
            method: "POST",
            data: {
                view: view,
                seller_id: seller_id
            },
            dataType: "json",
            success: function(data) {

                if (data.rowCount > 0) {
                    $('.badge').html(data.rowCount);
                    document.getElementById('indicator').classList.add('badge-danger');
                } else {
                    $('.badge').html("0");
                    document.getElementById('indicator').classList.remove('badge-danger');
                }
            }
        });
    }

    load_unseen_notification();

    setInterval(function() {
        load_unseen_notification();
    }, 1000);

    //search products

    var allProducts = null;

    $.ajax({
        type :'POST',
        url :"http://localhost/Project/FlyBuy/UserController/getProductSearchResult",
        data : {
            seller_id : seller_id
        },
        success:function(result = ''){
            allProducts = JSON.parse(result); 
        }
    });

    $("#searchBox").on('keydown', function(event){

        var search = false;
        var productContainer = document.querySelector('.product-container');
        var searchText = $("#searchBox").val();
        
        if(event.keyCode === 8){
            searchText = searchText.substr(0, searchText.length - 1);
            productContainer.innerHTML = '';
            search = true;
        }
        else if((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 65 && event.keyCode <= 90) || event.keyCode === 32){
            searchText = searchText + event.key;
            productContainer.innerHTML = '';
            search = true;
        }

        if(search){

            allProducts.forEach(product => {

                var lowercaseItemName = product.itemName.toLowerCase();
    
                if(lowercaseItemName.includes(searchText.toLowerCase())){
    
                    var itemName = document.createElement('h2');
                    itemName.setAttribute('class', 'item name');
                    itemName.innerText = product.itemName;
    
                    var itemPrice = document.createElement('h2');
                    itemPrice.setAttribute('class', 'item price');
                    itemPrice.innerText = "Rs. " + product.price;
    
                    var itemImg = document.createElement('img');
                    itemImg.setAttribute('src', "http://localhost/Project/FlyBuy/public/img/uploads/itemImages/" + product.item_image)
    
                    var cardFront = document.createElement('div');
                    cardFront.setAttribute('class', 'front');
                    cardFront.appendChild(itemName);
                    cardFront.appendChild(itemPrice);
                    cardFront.appendChild(itemImg);
    
                    var itemDescription = document.createElement('p');
                    itemDescription.setAttribute('class', 'item description');
                    itemDescription.innerText = product.description;
    
                    var itemAmount = document.createElement('p');
                    itemAmount.setAttribute('class', 'item amount');
                    itemAmount.innerText = product.amount + " Available";
    
                    var itemDate = document.createElement('p');
                    itemDate.setAttribute('class', 'item date');
                    itemDate.innerText = product.created_at;
    
                    var trashIcon = document.createElement('i');
                    trashIcon.setAttribute('class', "fas fa-trash");
                    trashIcon.setAttribute('onclick', "toggleDelete(this)");
    
                    var editIcon = document.createElement('i');
                    editIcon.setAttribute('class', "fas fa-edit");
                    editIcon.setAttribute('onclick', "toggleEdit(this)");
    
                    var cardBack = document.createElement('div');
                    cardBack.setAttribute('class', 'back');
                    cardBack.appendChild(itemDescription);
                    cardBack.appendChild(itemAmount);
                    cardBack.appendChild(itemDate);
                    cardBack.appendChild(trashIcon);
                    cardBack.appendChild(editIcon);
    
                    var card = document.createElement('div');
                    card.setAttribute('class', 'card');
                    card.appendChild(cardFront);
                    card.appendChild(cardBack);
    
                    var wrapper = document.createElement('div');
                    wrapper.setAttribute('class', 'item-details wrapper');
                    wrapper.setAttribute('id', product.item_id);
    
                    wrapper.appendChild(card);
    
                    productContainer.appendChild(wrapper);
                }
            });
        }
    });
});

// notification marking

function expand(element){
    element.classList.toggle('expanded');

    const collapsible = element.parentElement.querySelector('.collapsible.content');
    collapsible.classList.toggle('active');
}

function mark(element){

    const notify_id = parseInt(element.parentElement.parentElement.querySelector('#order-id').innerText);

    $.ajax({
        type: "POST",
        url: "http://localhost/Project/FlyBuy/UserController/markNotificationAsRead",
        data: { 
            notify_id : notify_id 
        },
        success: function(result = '') {
            window.location.reload();
        },
        error: function(result = '') {
            alert('error');
        }
    });
}