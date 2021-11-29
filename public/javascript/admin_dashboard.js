var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    setTimeout(function() {

        var i;
        var slides = document.getElementsByClassName("slides");
        if (n > slides.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = slides.length }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex - 1].style.display = "";
        //myMove(slides[slideIndex - 1]);
    }, 0);
}
// var id = null;

// function myMove(elem) {

//     var pos = 0;
//     clearInterval(id);
//     id = setInterval(frame, 10);

//     function frame() {
//         if (pos == 350) {
//             clearInterval(id);
//         } else {
//             pos++;
//             elem.style.width = pos + 'px';
//             elem.style.hight = pos + 'px';
//         }
//     }
// }
var image = document.getElementsByClassName("item-img");


// $(document).ready(function() {

//     $("#item-img").hover(function() {

//         $("#popup-page").css("display", "flex");
//     }, function() {
//         $("#popup-page").css("display", "none");
//     });
// });

function popupmsg(elem) {
    //  alert(elem.nextSibling.nextSibling.nodeName);
    elem.nextElementSibling.style.display = "flex";
    elem.nextElementSibling.nextElementSibling.style.display = "flex";
    //  elem.nextSibling.nextSibling.nextSibling.style.display = "flex";

}

function clearpopup(elem) {
    elem.nextElementSibling.style.display = "none";
    elem.nextElementSibling.nextElementSibling.style.display = "none";
}

function setbtnclick() {
    sessionStorage.setItem("acbtnclick", "click");
}

function rederect() {
    var lat = sessionStorage.getItem("acbtnclick");
    if (lat == "click") {

        currentSlide(5);
        //sessionStorage.setItem("acbtnclick", "");
    }
}