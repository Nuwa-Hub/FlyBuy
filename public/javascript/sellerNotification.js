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
                } else {
                    $('.badge').html("0");
                    // document.querySelector('.badge').style.opasity = "0";
                }
            }
        });
    }

    load_unseen_notification();

    setInterval(function() {
        load_unseen_notification();
    }, 1000);

    // $("itemcard").click(function(e) {

    //     // e.preventDefault();

    //     // var notify_id = document.querySelector('notification_hidden_field').value;

    //     $.ajax({
    //         type: "POST",
    //         url: "http://localhost/Project/FlyBuy/UserController/markNotficationAsRead",
    //         data: { 
    //             notify_id : notify_id 
    //         },
    //         success: function(result = '') {
    //             alert('ok');
    //             load_unseen_notification();
    //         },
    //         error: function(result = '') {
    //             alert('error');
    //         }
    //     });
    // });

});