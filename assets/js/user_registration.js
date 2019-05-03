function load_data(id) {
    $.ajax({
        url: "http://www.modminers.hu/request/registration/intro/" + id,
        method: "POST",
        data:{data:true},
        success: function(data) {
            $(".result").html(data);
        }     
    });

    $.ajax({
        url: "http://www.modminers.hu/request/registration/intro/username/" + id,
        method: "POST",
        data:{data:true},
        success: function(data) {
            $(".regusername").html(data);
        }     
    });
}
