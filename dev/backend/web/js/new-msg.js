$(document).ready(function () {
//get alerts

  function get_data(){ 
       $.ajax({
                 type: 'POST',
                 url: '?r=chat/headmsg',
                 success: function(data) {
                    var res = $.parseJSON(data);
                    if(res.msg.length)
                    {
                          $(".head-new-msg").html('<i class="fa fa-envelope-o"></i><span class="label label-success">'+res.count+'</span>');
                          $(".cnt-new-msg").text(res.count);
                          $(".active-cht-msg").html(res.msg);
                        
                    }
                 }
         });
        
         setTimeout(arguments.callee,3000);
    }
  setTimeout( get_data,3000 );
});