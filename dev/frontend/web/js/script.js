$(function(){
$(window).scroll(function() {
  var scrollY = $(window).scrollTop();
  if(scrollY >= 100){
  $('.header_block').addClass('active');
  }else{
    $('.header_block').removeClass('active');
  }
})

var y = $(".users_block").offset().top;
console.log(y);
$('.scroling_strell i').click(function(){
	$("html, body").animate({ scrollTop: y - 70 }, 1000);
})
});