function load_data(id) {
    $.ajax({
        url: "http://www.modminers.hu/request/registration/info/" + id,
        method: "POST",
        data: {data: true},
        success: function (data) {
            var obj = JSON.parse(data);

            $(".result").html(obj.introduction);
            $(".regusername").html(obj.username);
            $(".reg_date").html(obj.reg_date);
        }
    });
}

    /*$.ajax({
        url: "http://www.modminers.hu/request/registration/intro/username/" + id,
        method: "POST",
        data:{data:true},
        success: function(data) {
            $(".regusername").html(data);
        }     
    });
}*/
