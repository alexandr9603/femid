$(document).ready(function () {
//get alerts

  function get_data(){ 
       $.ajax({
                 type: 'POST',
                 url: '?r=alerts/index',
                 success: function(data) {
                    var res = $.parseJSON(data)
                    if(res.ret.length)
                    {
                        $(".count-alerts").text(res.count);
                        $(".list-alerts").html(res.ret);
                    }
                 }
         });
        
         setTimeout(arguments.callee,2000);
    }
  setTimeout( get_data,2000 );
});