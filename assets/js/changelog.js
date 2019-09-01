var x = 1;
function add_field() {
    if(x <= 19) {
        x++;
        var cont = document.getElementById('fields');
        var dropid = "type" + x;
        var textid = "content" + x;
        var fieldid = "field" + x;
        $('.field_counter').html(x);



        $(cont).append("<div class=\"row\" id=" + fieldid + ">\n" +
            "                <div class=\"col-12\">\n" +
            "                    <div class=\"input-group mb-3\">\n" +
            "\n" +
            "                        <select class=\"custom-select col-4 col-lg-2\" name=" + dropid + ">\n" +
            "                            <option selected>Újítás</option>\n" +
            "                            <option value=\"1\">Eltávolítás</option>\n" +
            "                            <option value=\"2\">HotFix</option>\n" +
            "                            <option value=\"3\">Javítás</option>\n" +
            "                        </select>\n" +
            "\n" +
            "                        <input name=" + textid + " type=\"text\" class=\"form-control w-75\" aria-label=\"Text input with dropdown button\" placeholder=\"Rövid leírás (1 mondat)\">\n" +
            "\n" +
            "                        <button onclick=\"delete_field('" + fieldid + "');\" class=\"btn btn-outline-danger col-1\" type=\"button\"><i class=\"fas fa-times\"></i></button>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>");

    }
}

function delete_field(id) {
    $("#" + id).remove();
    x--;
    $('.field_counter').html(x);
}

function remove_all() {
    var i;
    for(i = 2; i<=20; i++) {
        console.log(i);
        $("#field" + i).remove();
    }
    $('.field_counter').html(1);
    x=1;
}