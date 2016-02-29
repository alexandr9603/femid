$(function(){
var param = $('meta[name=csrf-param]').attr("content");
var token = $('meta[name=csrf-token]').attr("content");

function isValidEmail(email) {
    return /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(email);
}
  
$(".regusr").click(function(){
  $("#groups").val($(this).attr("data"));
  if($(this).attr("data")=="2")//Если юрист открываем тест
  {
    var err=false;
    //validation
    if (!isValidEmail($("#signupform-email").val()))
    {
        err=true;
        $("#signupform-email").focus();
    }
    if ($("#signupform-password").val()!=$("#signupform-password_repeat").val() || $.trim($("#signupform-password").val()).length<5) {
        err=true;
        $("#signupform-password").focus();
    }
    if ($.trim($("#signupform-username").val()).length<3) {
        $("#signupform-username").focus();
        err=true;
    }
    if ($.trim($("#signupform-last_name").val()).length<3) {
        $("#signupform-last_name").focus();
        err=true;
    }
    if ($.trim($("#signupform-tel").val()).length<6) {
        $("#signupform-tel").focus();
        err=true;
    }
    if (err) {
        return false;
    }
    
    
    $('.inner-sign-up').addClass('to-test')
    $("ol.tests .input-info").fadeIn();
    // $("ol.tests").fadeIn();
    $('html, body').animate({scrollTop:$('.container').offset().top}, 'slow');
  }
  else
  {
     $("#form-signup").submit();
  }
});
// Назад к заполнению полей
$("ol.tests .input-info").click(function(){
  $('.inner-sign-up').removeClass('to-test');
  $(this).fadeOut();
  $('html, body').animate({scrollTop:$('.container').offset().top}, 'slow');
})
// Позиционирование Кнопки "Ввод данных"
if($(window).scrollTop() < 105){
    $("ol.tests .input-info").css({
      top: 120 - $(window).scrollTop() + "px"
    })
  };
$(window).scroll(function(){
  if($(window).scrollTop() < 105){
    $("ol.tests .input-info").css({
      top: 120 - $(window).scrollTop() + "px"
    })
  } else {
    $("ol.tests .input-info").css({
      top: 15 + "px"
    })
  }
})
//Листалка тестов
$(".next.btn").click(function(){
  
  if (!$("[name=answers"+$('.is-active').attr('data')+"]").filter(":checked").val()) {
    return false;
  }
  $("li.is-active").removeClass('is-active').next("li").addClass("is-active");
  if ($('.is-active').attr('data')>19) {
    $(".next.btn").css({"display":"none"});
    $(".finish.btn").fadeIn();
  }
});

//Вывод результата теста и регистрация юриста
$(".finish").click(function(){
    var arr=[];
    $('.answers:checked').each(function(i,elem) {
        arr[i]=[{'id':$(this).attr("data"),'answer':$(this).val()}];
    });
    
    var data = {};
    data[param] = token;
    data['result']=arr;
     $.ajax({
        url: './?r=site/getresult',
        type: 'POST',
        data: data,
        success: function(data) {
                var res = $.parseJSON(data)
                var msg1="Вы ответили правильно на "+res.right+" из "+res.kol+" тестов\n",
                msg2="Ваша оценка "+res.rating+" из "+res.max_rating;
                //if (parseInt(res.rating)<3)msg+="\nК сожалению вы не прошли тест";
                $('li.is-active').removeClass('is-active');
                $('ol.tests .title').text('Результаты тестирования');
                $('ol.tests .sub-title').css({
                  display: 'none'
                })
                $('#testRespond .line1').text(msg1);
                $('#testRespond .line2').text(msg2);
                $('#testRespond').fadeIn();
                // $('#testRespond').text(msg1+" <br> "+msg2).fadeIn();
                // alert(msg);
                $(".finish").css({"display":"none"});
                if (parseInt(res.rating)>=3) {
                    $("#lvl").val(res.rating);
                    $(".сonfirm-reg").fadeIn();
                }
                else
                {
                  $(".restart").fadeIn();
                }
            }
    });
});
//Submit form
$(".сonfirm-reg").click(function(){
  $("#form-signup").submit();
});
$(".restart").click(function(){
  $(".restart").css({"display":"none"});
  //Обновление тестов
 var data = {};
    data[param] = token;
     $.ajax({
        url: './?r=site/gettest',
        type: 'POST',
        data: data,
        success: function(data) {
                var res = $.parseJSON(data)
               $('ol.tests li').remove();
               $('.sub-title').after(res.txt);
            }
    });
  $(".next.btn").fadeIn();  
});



});