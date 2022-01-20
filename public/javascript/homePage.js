let text = document.getElementById("text");
let btn = document.getElementById("btn");
let item2 = document.getElementById("item2");
let item1 = document.getElementById("item1");
window.addEventListener("scroll", function () {
	var header = document.querySelector("header");
	header.classList.toggle("sticky", window.scrollY > 0);

	let value = window.scrollY;
	text.style.top = 40 + value * -0.5 + "%";
	btn.style.marginTop = value * 1.5 + "px";
	item2.style.top = value * 0.25 + "px";
	item1.style.top = value * 0.25 + "px";
});

var popupViews = document.querySelectorAll(".popup-view");
var popupBtns = document.querySelectorAll(".popup-btn");
var closeBtns = document.querySelectorAll(".close-btn");

var popup = function (popupClick) {
	popupViews[popupClick].classList.add("active");

	document.body.style.overflowY = "hidden";
};

popupBtns.forEach((popupBtn, i) => {
	popupBtn.addEventListener("click", () => {
		popup(i);
	});
});

closeBtns.forEach((closeBtn) => {
	closeBtn.addEventListener("click", () => {
		popupViews.forEach((popupView) => {
			popupView.classList.remove("active");

			document.body.style.overflowY = "";
		});
	});
});
//rating popup start

var popupViews2 = document.querySelectorAll(".container-new");
var popupBtns2 = document.querySelectorAll(".popup-rate");
var closeBtns2 = document.querySelectorAll(".close-btn-rate");

var popup1 = function (popupClick) {
	popupViews2[popupClick].classList.add("active1");

	document.body.style.overflowY = "hidden";
};

popupBtns2.forEach((popupBtn, i) => {
	popupBtn.addEventListener("click", () => {
		popup1(i);
	});
});

closeBtns2.forEach((closeBtn) => {
	closeBtn.addEventListener("click", () => {
		popupViews2.forEach((popupView) => {
			popupView.classList.remove("active1");
		});
	});
});
//rating popup end

//for search button

function searchElement() {
	var input, filter, ul, li, a, i, txtValue;

	input = document.getElementById("pinput");
	filter = input.value.toUpperCase();

	products = document.getElementsByClassName("product");

	$(document).scrollTop(1300);

	for (i = 0; i < products.length; i++) {
		a = products[i].getElementsByTagName("h3")[0];
		store = products[i]
			.getElementsByTagName("div")[1]
			.getElementsByTagName("span")[0];

		if (
			a.innerHTML.toUpperCase().indexOf(filter) > -1 ||
			store.innerHTML.toUpperCase().indexOf(filter) > -1
		) {
			products[i].style.display = "";
		} else {
			products[i].style.display = "none";
		}
	}
}

//rating
function rate(rating, seller_id, buyer_id) {
	var ratedivs = document.querySelectorAll(".container-new");

	setTimeout(function () {
		// ajex request for remove the relevent item from SESSION store
		$.ajax({
			url: "http://localhost/Project/FlyBuy/UserController/giveRating",
			method: "POST",
			cache: false,
			data: {
				seller_id: seller_id,
				rating: rating,
				buyer_id: buyer_id,
			},
			success: function (response) {
				//alert("dff");
				console.log(response);
			},
		});
	}, 20);
}

var now = new Date();
var millisTill10 =
	new Date(now.getFullYear(), now.getMonth(), now.getDate(), 17, 19, 0, 0) -
	now;

if (millisTill10 < 0) {
	millisTill10 += 86400000;
}

setTimeout(function () {
	$.ajax({
		type: "POST",
		url: "http://localhost/Project/FlyBuy/UserController/updateRating",
		success: function (result = "") {
			window.location.reload();
		},
	});
}, millisTill10);

var added = 0;

function addtoCart(pid, buyer_id) {
	cartel = document.querySelector(".badge").innerHTML;

	pqty = document.getElementById(pid).value;

	setTimeout(function () {
		var popupViews = document.querySelectorAll(".popup-view");

		// ajex request for add product to SESSION store
		$.ajax({
			url: "http://localhost/Project/FlyBuy/ProductController/addToCart",
			method: "POST",
			cache: false,
			data: {
				pid: pid,
				pqty: pqty,
				buyer_id: buyer_id,
			},
			dataType: "json",

			success: function (data) {
				if (data.add == 1) {
					added = 1;

					setTimeout(function () {
						popupViews.forEach((popupView) => {
							popupView.classList.remove("active");

							document.body.style.overflowY = "";
						});
						document.querySelector(".badge").innerHTML = parseInt(cartel) + 1;
					}, 1200);
				} else {
					added = 0;
				}
			},
		});
	}, 20);
}

$(document).ready(function () {
	$(".add-cart-btn").on("click", function () {
		var button = $(this);

		setTimeout(function () {
			if (added == 1) {
				var cart = $("#cart");

				button.addClass("sendtocart");

				setTimeout(function () {
					button.removeClass("sendtocart");

					cart.addClass("shake");

					setTimeout(function () {
						cart.removeClass("shake");
					}, 500);
				}, 1000);
			} else {
				alertbox();
				button.addClass("shake");

				setTimeout(function () {
					var popupViews = document.querySelectorAll(".popup-view");
					popupViews.forEach((popupView) => {
						popupView.classList.remove("active");

						document.body.style.overflowY = "";
					});
				}, 1200);
			}
		}, 200);
	});
});

/*alert box */

function alertbox() {

    $('.overlay').addClass('is-active');

    setTimeout(function() {

        $('.overlay').removeClass('is-active');

    }, 1200);
}