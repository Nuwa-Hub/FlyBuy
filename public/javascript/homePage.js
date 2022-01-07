let text = document.getElementById('text');
let btn = document.getElementById('btn');
let item2 = document.getElementById('item2');
let item1 = document.getElementById('item1');
window.addEventListener('scroll', function() {
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);

    let value = window.scrollY;
    text.style.top = 40 + value * -0.5 + '%';
    btn.style.marginTop = value * 1.5 + 'px';
    item2.style.top = value * 0.25 + 'px';
    item1.style.top = value * 0.25 + 'px';
});

var popupViews = document.querySelectorAll('.popup-view');
var popupBtns = document.querySelectorAll('.popup-btn');
var closeBtns = document.querySelectorAll('.close-btn');


var popup = function(popupClick) {
    popupViews[popupClick].classList.add('active');

    document.body.style.overflowY = 'hidden';
}

popupBtns.forEach((popupBtn, i) => {
    popupBtn.addEventListener("click", () => {
        popup(i)

    });
});

closeBtns.forEach((closeBtn) => {
    closeBtn.addEventListener("click", () => {
        popupViews.forEach((popupView) => {
            popupView.classList.remove('active');

            document.body.style.overflowY = '';
        });
    });
});




// When document is ready...
$(document).ready(function() {
    // alert("df");
    // If cookie is set, scroll to the position saved in the cookie.
    if ($.cookie("scroll") !== null) {
        $(document).scrollTop($.cookie("scroll"));
    }

    // When scrolling happens....
    $(window).on("scroll", function() {

        // Set a cookie that holds the scroll position.
        $.cookie("scroll", $(document).scrollTop());

    });

    //search products
    
    var allProducts = null;

    $.ajax({
        type :'POST',
        url :"http://localhost/Project/FlyBuy/UserController/getProductSearchResult",
        success:function(result = ''){
            allProducts = JSON.parse(result);
        }
    });

    $("#searchBox").on('keydown', function(event){

        var search = false;
        var productContainer = document.querySelector('.container');
        var page = productContainer.getAttribute('id');
        var searchText = $("#searchBox").val();

        if(page === 'buyerAccount'){
            var buyer_id = document.querySelector('.buyer_id').value;
        }
        
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
                var lowercaseStoreName = product.seller.storeName.toLowerCase();
    
                if(lowercaseItemName.includes(searchText.toLowerCase()) || lowercaseStoreName.includes(searchText.toLowerCase())){
    
                    var itemName = document.createElement('h3');
                    itemName.setAttribute('class', 'name');
                    itemName.innerText = product.itemName;
    
                    var itemPrice = document.createElement('span');
                    itemPrice.setAttribute('class', 'price');
                    itemPrice.innerText = "Rs. " + product.price;

                    var popupBtn = document.createElement('a');
                    popupBtn.setAttribute('class', 'popup-btn');
                    popupBtn.innerText = "View item";
    
                    var itemImg = document.createElement('img');
                    itemImg.setAttribute('src', "http://localhost/Project/FlyBuy/public/img/uploads/itemImages/" + product.item_image);
    
                    var productCard = document.createElement('div');
                    productCard.setAttribute('class', 'product-card');
                    productCard.appendChild(itemName);
                    productCard.appendChild(itemPrice);
                    productCard.appendChild(popupBtn);
                    productCard.appendChild(itemImg);
                    
                    var closebtn = document.createElement('i');
                    closebtn.setAttribute('class', 'fas fa-times close-btn');

                    var aTag = document.createElement('a');
                    aTag.appendChild(closebtn);

                    var productImg = document.createElement('img');
                    productImg.setAttribute('src', "http://localhost/Project/FlyBuy/public/img/uploads/itemImages/" + product.item_image);

                    var productImgDiv = document.createElement('div');
                    productImgDiv.setAttribute('class', 'product-img');
                    productImgDiv.appendChild(productImg);

                    var br = document.createElement('br');

                    var storeNameSpan = document.createElement('span');
                    storeNameSpan.innerText = product.seller.storeName

                    var itemNameH2 = document.createElement('h2');
                    // itemNameH2.innerHTML = product.itemName + "<br><span>" + product.seller.storeName + "</span>";
                    itemNameH2.innerText = product.itemName;
                    itemNameH2.appendChild(br);
                    itemNameH2.appendChild(storeNameSpan);


                    var starsSpan = document.createElement('span');
                    starsSpan.setAttribute('class', 'stars');
                    starsSpan.innerText = product.seller.rating;

                    var normalSpan = document.createElement('span');
                    normalSpan.innerText = product.seller.rating;

                    var starsH3 = document.createElement('h3');
                    starsH3.appendChild(starsSpan);
                    starsH3.appendChild(normalSpan);

                    var descriptionP = document.createElement('p');
                    descriptionP.innerText = product.description;

                    var priceSpan = document.createElement('span');
                    priceSpan.setAttribute('class', 'price');
                    priceSpan.innerText = "Rs. " + product.price + "/unit";

                    var infoDiv = document.createElement('div');
                    infoDiv.setAttribute('class', 'info');
                    infoDiv.appendChild(itemNameH2);
                    infoDiv.appendChild(starsH3);
                    infoDiv.appendChild(descriptionP);
                    infoDiv.appendChild(priceSpan);
                    if(page === 'buyerAccount'){

                        var quantitySpan = document.createElement('span');
                        quantitySpan.setAttribute('class', 'quantity');
                        quantitySpan.innerText = "Quantity :";
                        infoDiv.appendChild(quantitySpan);

                        //inputs

                        var pqty = document.createElement('input');
                        pqty.setAttribute('type', 'number');
                        pqty.setAttribute('name', 'quantity');
                        pqty.setAttribute('class', 'pqty');
                        pqty.setAttribute('value', '1');
                        pqty.setAttribute('id', 'quantity');
                        pqty.setAttribute('min', '1');
                        pqty.setAttribute('max', product.amount);
                        infoDiv.appendChild(pqty);

                        var pid = document.createElement('input');
                        pid.setAttribute('type', 'hidden');
                        pid.setAttribute('name', 'pid');
                        pid.setAttribute('class', 'pid');
                        pid.setAttribute('value', product.item_id);
                        infoDiv.appendChild(pid);

                        var buyerIdInput = document.createElement('input');
                        buyerIdInput.setAttribute('type', 'hidden');
                        buyerIdInput.setAttribute('name', 'buyer_id');
                        buyerIdInput.setAttribute('class', 'buyer_id');
                        buyerIdInput.setAttribute('value', buyer_id);
                        infoDiv.appendChild(buyerIdInput);

                        var pmaxAmount = document.createElement('input');
                        pmaxAmount.setAttribute('type', 'hidden');
                        pmaxAmount.setAttribute('name', 'pmaxAmount');
                        pmaxAmount.setAttribute('class', 'pmaxAmount');
                        pmaxAmount.setAttribute('value', product.amount);
                        infoDiv.appendChild(pmaxAmount);

                        //button
                        var cartI = document.createElement('i');
                        cartI.setAttribute('class', 'fas fa-cart-plus');

                        var addToCartBtn = document.createElement('button');
                        addToCartBtn.setAttribute('class', 'btn btn-info btn-block addItemBtn add-cart-btn');
                        addToCartBtn.setAttribute('name', 'addTocart')
                        // addToCartBtn.innerHTML = "<i class='fas fa-cart-plus'></i>&nbsp;&nbsp;Add tocart";
                        addToCartBtn.appendChild(cartI);
                        addToCartBtn.innerText = "&nbsp;&nbsp;Add tocart";
                        infoDiv.appendChild(addToCartBtn);
                    }

                    var popupCard = document.createElement('div');
                    popupCard.setAttribute('class', 'popup-card');
                    popupCard.appendChild(aTag);
                    popupCard.appendChild(productImgDiv);
                    popupCard.appendChild(infoDiv);

                    var popForm = document.createElement('form');
                    popForm.setAttribute('method', 'post');
                    if(page === 'buyerAccount'){
                        popForm.setAttribute('action', "http://localhost/Project/FlyBuy/ProductController/addToCart")
                    }
                    popForm.appendChild(popupCard)
    
                    var popup = document.createElement('div');
                    popup.setAttribute('class', 'popup-view');
                    popup.appendChild(popForm);
    
                    var productDiv = document.createElement('div');
                    productDiv.setAttribute('class', 'product');
                    productDiv.appendChild(productCard);
                    productDiv.appendChild(popup);
    
                    productContainer.appendChild(productDiv);
                }
            });
        }
    });

});