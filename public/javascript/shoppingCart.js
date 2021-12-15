var check = false;

//change the sub totals of each items

function changeVal(el) {

    var qt = parseFloat(el.parent().children(".qt").html());
    var price = parseFloat(el.parent().children(".price").children(".price").html());
    var eq = Math.round(price * qt * 100) / 100;

    el.parent().children(".full-price").html(eq);

    changeTotal(el);
}
// change grand total and sub total

function changeTotal(el) {
    var price = 0;
    var ele = document.getElementsByClassName("full-price");
    //   alert(parseFloat(ele[0].textContent) + 1);
    // ele.each(function(index) {
    //     price += parseFloat(ele[index].textContent);
    // });
    for (var i = 0; i < ele.length; i++) {
        price += parseFloat(ele[i].textContent);
    }

    price = Math.round(price * 100) / 100;
    // var tax = Math.round(price * 0.05 * 100) /
    //100;

    var shipping = parseFloat($(".shipping span").html());
    var fullPrice = Math.round((price + shipping) * 100) / 100;

    if (price == 0) {
        fullPrice = 0;
    }

    $(".subtotal span").html(price);

    $(".total span").html(fullPrice);
}

//for remove item when the remove button click
$(document).ready(function() {

    $(".remove").click(function() {
        //  alert(this.length);
        var el = $(this);
        el.parent().parent().addClass("removed");


        if (check == false) {
            setTimeout(function() {
                location.reload(true);

                var $elid = el.closest('header');
                ppid = $elid.find(".pid").val();

                // ajex request for remove the relevent item from SESSION store
                $.ajax({
                    url: 'http://localhost/OOP%20project/FlyBuy/ProductController/removeFromCart',
                    method: 'POST',
                    cache: false,
                    data: {
                        ppid: ppid,
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            }, 470);
        }




    });


    //to make the quantity increase when qt-minus button click
    $(".qt-plus").click(function() {

        child = $(this).parent().children(".qt");
        //  location.reload(true);

        var $el = child.closest('footer');

        pid = $el.find(".pid").val();
        pamount = parseInt($(this).parent().children(".qt").html());
        pmaxAmount = Number($el.find(".pmaxAmount").val());

        if (pmaxAmount > pamount) {
            $(this).parent().children(".qt").html(parseInt($(this).parent().children(".qt").html()) + 1);
            //  alert(pmaxAmount);
            $(this).parent().children(".full-price").addClass("added");

            var el = $(this);
            window.setTimeout(function() {
                el.parent().children(".full-price").removeClass("added");
                changeVal(el);
            }, 150);
            pamount = parseInt($(this).parent().children(".qt").html());

            //var pamount = $el.find(".pamount").val() + 1;
            //  location.reload(true);

            //call fuction (http request)
            changeAmount(pid, pamount);
        }

    });
    //to make the quantity decrease when qt-minus button click
    $(".qt-minus").click(function() {

        child = $(this).parent().children(".qt");

        if (parseInt(child.html()) > 1) {
            child.html(parseInt(child.html()) - 1);

            var $el = child.closest('footer');

            var pid = $el.find(".pid").val();
            var pamount = parseInt(child.html());
            //  alert(typeof pamount);
            //  location.reload(true);

            //call fuction (http request)
            changeAmount(pid, pamount);
        }

        $(this).parent().children(".full-price").addClass("minused");

        var el = $(this);
        window.setTimeout(function() {
            el.parent().children(".full-price").removeClass("minused");
            changeVal(el);
        }, 150);



    });

    window.setTimeout(function() { $(".is-open").removeClass("is-open") }, 1200);


    //checkout button
    $(".btn").click(function() {
        check = true;
        $(".remove").click();

        document.getElementById("site-header").style.opacity = "0";
        document.getElementById("site-footer").style.opacity = "0";
        document.getElementById("popup-form").style.opacity = "1";

        lorryMove();

    });




});


function lorryMove() {
    var id = null;
    var ele = document.getElementById("lorry");
    var pos = 0;
    clearInterval(id);
    id = setInterval(frame, 5);


    function frame() {
        if (pos == 650) {
            clearInterval(id);
            ele.style.left = '20px';
        } else {
            pos++;
            //  elem.style.top = pos + 'px';
            ele.style.left = pos + 'px';
        }
    }

}

function changeTot() {
    var el = $(this);
    changeVal(el);
}



function changeAmount(pid, pamount) {
    $.ajax({
        url: 'http://localhost/OOP%20project/FlyBuy/ProductController/removeFromCart',
        method: 'post',
        cache: false,
        data: {
            pid: pid,
            pamount: pamount
        },
        success: function(response) {
            console.log(response);

        }
    });

}




$(window).on('unload', function() {
    $(window).scrollTop(0);
});




//for search button

function searchFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("pinput");
    filter = input.value.toUpperCase();

    li = document.getElementsByTagName("li");


    for (i = 3; i < li.length; i++) {
        a = li[i].getElementsByTagName("h1")[0];

        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

//Find scroll percentage on scroll(using cross - browser properties), and offset dash same amount as percentage scrolled /
window.addEventListener("scroll", changeItem);

function changeItem() {

    var ele = document.getElementsByTagName("article");
    for (i = 0; i < ele.length; i++) {

        ele[i].style.transform = "skewX(-17deg)";
    }
    window.setTimeout(function() {
        var ele = document.getElementsByTagName("article");
        for (i = 0; i < ele.length; i++) {
            ele[i].style.transform = "skewX(0deg)";
        }
    }, 445);
    //  location.reload(true);
    //  ele.style.transform = "skewX(-7deg)";
}


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