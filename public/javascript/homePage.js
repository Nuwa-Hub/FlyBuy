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
<<<<<<< HEAD




// When document is ready...
$(document).ready(function() {
    
    // If cookie is set, scroll to the position saved in the cookie.
    if ($.cookie("scroll") !== null) {
        $(document).scrollTop($.cookie("scroll"));
    }

    // When scrolling happens....
    $(window).on("scroll", function() {

        // Set a cookie that holds the scroll position.
        $.cookie("scroll", $(document).scrollTop());

    });

});

//for search button

function searchElement() {

    var input, filter, ul, li, a, i, txtValue;

    input = document.getElementById("pinput");
    filter = input.value.toUpperCase();

    products = document.getElementsByClassName("product");


    for (i = 0; i < products.length; i++) {

        a = products[i].getElementsByTagName("h3")[0];

        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {

            products[i].style.display = "";

        } else {

            products[i].style.display = "none";

        }
    }
}


