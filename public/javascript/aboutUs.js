'use strict';

$(document).ready(function () {
    $(window).bind('scroll', function (e) {
        parallaxScroll();
    });
});

function parallaxScroll() {
    const scrolled = $(window).scrollTop();
    $('#team-image').css('top', (0 - (scrolled * .20)) + 'px');
    $('.img-1').css('top', (0 - (scrolled * .35)) + 'px');
    $('.img-2').css('top', (0 - (scrolled * .05)) + 'px');
}

window.addEventListener('scroll', function() {
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);

});



$('.button1').click(function(){
    $('.button1').toggleClass('active');
    $('.title1').toggleClass('active');
    $('.nav1').toggleClass('active');
  });

  $('.button2').click(function(){
    $('.button2').toggleClass('active');
    $('.title2').toggleClass('active');
    $('.nav2').toggleClass('active');
  });
  $('.button3').click(function(){
    $('.button3').toggleClass('active');
    $('.title3').toggleClass('active');
    $('.nav3').toggleClass('active');
  });
  $('.button4').click(function(){
    $('.button4').toggleClass('active');
    $('.title4').toggleClass('active');
    $('.nav4').toggleClass('active');
  });