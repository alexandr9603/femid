$(document).ready(function () {
    var param = $('meta[name=csrf-param]').attr("content");
    var token = $('meta[name=csrf-token]').attr("content");
    
    $(".finish").click(function(){
        var arr=[];
        $('.answers:checked').each(function(i,elem) {
            arr[i]=[{'id':$(this).attr("data"),'answer':$(this).val()}];
        });
        
        var data = {};
        data[param] = token;
        data['result']=arr;
         $.ajax({
            url: './?r=tests/getresult',
            type: 'POST',
            data: data,
            success: function(data) {
                    var res = $.parseJSON(data)
                    var msg="Вы ответили правильно на "+res.right+" из "+res.kol+" тестов\n";
                    msg+="Ваша оценка "+res.rating+" из "+res.max_rating;
                    alert(msg)
                }
        });
    })
});