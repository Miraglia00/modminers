function load_data(query) {
    $.ajax({
        url: "http://"+document.domain+"/users/search_user",
        method: "POST",
        data:{query:query},
        success: function(data) {
            $(".result").html(data);
        }     
    });
}

$('#search_username').keyup(function() {
    var search = $(this).val();
    if(search != '') {
        load_data(search);
    }else{
        $(".result").html("");
    }
});