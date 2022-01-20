var check = false;
var bar = $("progress");
var scrollValue = 0;

//progress bar
$(window).scroll(function () {
	bar.css("display", "block");

	scrollValue = $(window).scrollTop();

	bar.attr("max", $("body").outerHeight() - $(window).height());

	bar.attr("value", scrollValue);

	if (!scrollValue) {
		bar.css("display", "none");
	}
});

//change the sub totals of each items

function changeVal(el) {
	var qt = parseFloat(el.parent().children(".qt").html());
	var price = parseFloat(
		el.parent().children(".price").children(".price").html()
	);

	var eq = Math.round(price * qt * 100) / 100;

	el.parent().children(".full-price").html(eq);

	changeTotal(el);
}
// change grand total and sub total

function changeTotal(el) {
	var price = 0;
	var ele = document.getElementsByClassName("full-price");

	for (var i = 0; i < ele.length; i++) {
		price += parseFloat(ele[i].textContent);
	}

	price = Math.round(price * 100) / 100;

	var shipping = parseFloat($(".shipping span").html());

	var fullPrice = Math.round((price + shipping) * 100) / 100;

	if (price == 0) {
		fullPrice = 0;
	}

	$(".subtotal span").html(price);

	$(".total span").html(fullPrice);
}

//for remove item when the remove button click
$(document).ready(function () {
	$(".remove").click(function () {
		var el = $(this);

		el.parent().parent().addClass("removed");

		if (check == false) {
			setTimeout(function () {
				var $elid = el.closest("header");
				ppid = $elid.find(".pid").val();

				// ajex request for remove the relevent item from SESSION store
				$.ajax({
					url: "http://localhost/Project/FlyBuy/ProductController/updateCart",
					method: "POST",
					cache: false,
					data: {
						ppid: ppid,
					},
					success: function (response) {
						location.reload(true);
						console.log(response);
					},
				});
			}, 470);
		}
	});

	//to make the quantity increase when qt-minus button click
	$(".qt-plus").click(function () {
		child = $(this).parent().children(".qt");

		var $el = child.closest("footer");
		pid = $el.find(".pid").val();
		pamount = parseInt($(this).parent().children(".qt").html());
		pmaxAmount = Number($el.find(".pmaxAmount").val());

		if (pmaxAmount > pamount) {
			$(this)
				.parent()
				.children(".qt")
				.html(parseInt($(this).parent().children(".qt").html()) + 1);

			$(this).parent().children(".full-price").addClass("added");

			var el = $(this);

			window.setTimeout(function () {
				el.parent().children(".full-price").removeClass("added");
				changeVal(el);
			}, 150);

			pamount = parseInt($(this).parent().children(".qt").html());

			changeAmount(pid, pamount);
		}
	});
	//to make the quantity decrease when qt-minus button click
	$(".qt-minus").click(function () {
		child = $(this).parent().children(".qt");

		if (parseInt(child.html()) > 1) {
			child.html(parseInt(child.html()) - 1);

			var $el = child.closest("footer");
			var pid = $el.find(".pid").val();
			var pamount = parseInt(child.html());

			changeAmount(pid, pamount);
		}

		$(this).parent().children(".full-price").addClass("minused");

		var el = $(this);

		window.setTimeout(function () {
			el.parent().children(".full-price").removeClass("minused");

			changeVal(el);
		}, 150);
	});
	var download = false;

	window.setTimeout(function () {
		$(".is-open").removeClass("is-open");
	}, 1200);

	//checkout button
	$(".btn").click(function () {
		document.getElementById("popup-menu").style.zIndex = "100";
		var cartel = document.querySelector(".badge").innerHTML;

		if (cartel > 0) {
			document.querySelector(".badge").innerHTML = 0;

			popupbox();

			document.getElementById("popup-menu").style.opacity = "1";
			document.getElementById("btn").style.opacity = "0";
			document.getElementById("progress").style.opacity = "0";

			check = true;

			$(".remove").click();

			setTimeout(function () {
				var buy_id = document.querySelector(".buy_id").value;

				// ajex request for remove the relevent item from SESSION store
				$.ajax({
					url: "http://localhost/Project/FlyBuy/UserController/checkout",
					method: "POST",
					cache: false,
					data: {
						buy_id: buy_id,
					},
					success: function (response) {
						console.log(response);
					},
				});
			}, 20);
		} else {
			alertbox();
		}
	});
	$(".row").click(function () {
		window.setTimeout(function () {
			var buy_id = document.querySelector(".buy_id").value;
			var web =
				"http://localhost/Project/FlyBuy/PageController/downloadPdf/" + buy_id;

			window.location.replace(web);
		}, 3200);

		window.setTimeout(function () {
			var buy_id = document.querySelector(".buy_id").value;
			var web =
				"http://localhost/Project/FlyBuy/PageController/buyerAccount/" +
				buy_id +
				"/submit ";

			window.location.replace(web);
		}, 5200);
	});
});

/*alert box */

function alertbox() {
	$(".overlay").addClass("is-active");

	setTimeout(function () {
		$(".overlay").removeClass("is-active");
	}, 3000);
}

/*popup box*/
function popupbox() {
	$(".popup-menu").addClass("display");
}

function changeTot() {
	var el = $(this);

	changeVal(el);
}

function changeAmount(pid, pamount) {
	$.ajax({
		url: "http://localhost/Project/FlyBuy/ProductController/updateCart",
		method: "post",
		cache: false,
		data: {
			pid: pid,
			pamount: pamount,
		},
		success: function (response) {
			console.log(response);
		},
	});
}

$(window).on("unload", function () {
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
		//   ele[i].style.transform = "skewX(-17deg)";
		ele[i].classList.add("rotate");
	}
	window.setTimeout(function () {
		var ele = document.getElementsByTagName("article");

		for (i = 0; i < ele.length; i++) {
			ele[i].classList.remove("rotate");
		}
	}, 445);
}

// When document is ready...
$(document).ready(function () {
	// If cookie is set, scroll to the position saved in the cookie.
	if ($.cookie("scroll") !== null) {
		$(document).scrollTop($.cookie("scroll"));
	}

	// When scrolling happens....
	$(window).on("scroll", function () {
		// Set a cookie that holds the scroll position.
		$.cookie("scroll", $(document).scrollTop());
	});
});
