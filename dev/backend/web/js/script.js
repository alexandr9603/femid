(function($){
    $(window).load(function(){
        $(".notes-list").mCustomScrollbar({
          // theme: '3d-dark'
          theme: 'dark-3'
        });
    });
})(jQuery);

$(document).ready(function () {
  // Gender change
  $('.sex-trigger span').click(function () {
    $(this)
      .toggleClass('active')
      .siblings()
        .toggleClass('active');
  })


  // Slide under left sidebar
  $('.drop-menu-link').click(thinnerSidebar)

  function thinnerSidebar () {
    $('.menu-bar').toggleClass('is-hidden');
    $('.page').toggleClass('is-hidden');
    // $('profile-prev').css({
    //   marginBottom: -89px
    // });

    // $('.menu-link span').css({
    //   display: 'none'
    // })
  }
  //выбор  юриста
  $(".btn-set-ur").click(function(){
    $(".bg-popup").fadeIn();  
  });
  
  $(".select-urist tr.body-ur").click(function(){
    $("#tasks-urist_id").val($(this).attr("data"));
    $(".ur-name").text($(this).find("td.td-ur-name").text());
    $(".bg-popup").fadeOut();
  });
  $(".admin-form-task").submit(function(){
    if (!parseInt($("#tasks-urist_id").val())) {
        alert("Пожалуйста, выберите юриста");
        return false;
    }
  });
  $(document).mouseup(function (e){ // событие клика по веб-документу
		var div = $(".content-popup"); // тут указываем ID элемента
		if (!div.is(e.target) // если клик был не по нашему блоку
		    && div.has(e.target).length === 0) { // и не по его дочерним элементам
			$(".bg-popup").fadeOut(); // скрываем его
		}
	});
  
})

