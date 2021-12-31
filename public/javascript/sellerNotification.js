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