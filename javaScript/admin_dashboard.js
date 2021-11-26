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
    }, 600);
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