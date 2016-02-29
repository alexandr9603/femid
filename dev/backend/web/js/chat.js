
$(document).ready(function () {
    var chat_scroll = $('.direct-chat-messages');
    chat_scroll.scrollTop(chat_scroll.prop('scrollHeight'));
    //send message
    $('.msg-txt').keyup(function(e) {
        if(e.keyCode == 13){
          $(".send-msg").trigger("click");//do something
        }
      });
    $(".send-msg").click(function(){
       var msg = $(".msg-txt" ).val();
       if (msg.length>0) { 
        $(".msg-txt" ).val("");
        $.ajax({
                 type: 'POST',
                 url: '?r=chat/sendmessage&msg='+msg+'&chat_id='+$(".chat_id").val(),
                 success: function(data) {
                     var res = $.parseJSON(data)
                     $(".direct-chat-messages").append(res.ret);
                     var chat_scroll = $('.direct-chat-messages');
                    chat_scroll.scrollTop(chat_scroll.prop('scrollHeight'));
                     
                 }
         });
       }
    });
    
    //get message
    
    
    function get_data(){ 
       $.ajax({
                 type: 'POST',
                 url: '?r=chat/getmessage&chat_id='+$(".chat_id").val(),
                 success: function(data) {
                    var res = $.parseJSON(data)
                    if(res.ret.length)
                    {
                        $(".direct-chat-messages").append(res.ret);
                        var chat_scroll = $('.direct-chat-messages');
                        chat_scroll.scrollTop(chat_scroll.prop('scrollHeight'));
                    }
                    if (res.close) {
                        $(".msg-txt" ).attr('disabled', true);
                        $(".send-msg").attr('disabled', true);
                    }
                 }
         });
        
         setTimeout(arguments.callee,3000);
    }
  
  setTimeout( get_data,3000 );
  //Close Chat
  $(".close-chat").click(function(){
            $(".btn-chat").css({"display":"none"});
            $(".close-btn").fadeIn();
            $(".msg-txt" ).css({"display":"none"});
            $(".ask-msg-close").fadeIn();
    });
  //Back close
  $(".close-btn.btn-default").click(function(){
    $(".close-btn").css({"display":"none"});
    $(".btn-chat").fadeIn();
    $(".ask-msg-close").css({"display":"none"});
    $(".msg-txt" ).fadeIn();
  });
  //send message and close chat
  $(".close-btn.btn-success").click(function(){
    var msg ="Диалог завершен";
        $.ajax({
                 type: 'POST',
                 url: '?r=chat/sendmessage&close=1&msg='+msg+'&chat_id='+$(".chat_id").val(),
                 success: function(data) {
                     var res = $.parseJSON(data)
                     $(".direct-chat-messages").append(res.ret);
                     var chat_scroll = $('.direct-chat-messages');
                     chat_scroll.scrollTop(chat_scroll.prop('scrollHeight'));
                     
                     $(".msg-txt" ).attr('disabled', true);
                     $(".ask-msg-close").css({"display":"none"});
                     $(".msg-txt" ).fadeIn();
                     $(".send-msg").attr('disabled', true);
                     $(".close-btn").remove();
                    $(".send-msg").fadeIn();
                 }
         });
  });
});