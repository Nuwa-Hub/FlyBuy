$(document).ready(function(){
 
    function load_unseen_notification(view = '')
    {
     $.ajax({
      url:"fetch.php",
      method:"POST",
      data:{view:view},
      dataType:"json",
      success:function(data){

       $('.dropdown-menu').html(data.notification);
       if(data.unseen_notification > 0){
        $('.count').html(data.unseen_notification);
       }
      }
     });
    }
    
    load_unseen_notification();

});