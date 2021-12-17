$(document).ready(function(){

    var seller_id = document.querySelector('.seller-id.notify').value;

    function load_unseen_notification(view = ''){

        $.ajax({
            url:"http://localhost/Project/FlyBuy/UserController/getNotificationCount",
            method:"POST",
            data:{
                view : view,
                seller_id : seller_id
            },
            dataType:"json",
            success:function(data){

                if(data.rowCount > 0){
                    $('.badge').html(data.rowCount);
                }
                else{
                    document.querySelector('.badge').style.opasity = "0";
                }
            }
        });
    }
    
    load_unseen_notification();

    setInterval(function(){
        load_unseen_notification();
    }, 1000);

});