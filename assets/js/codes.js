var x = 1;
function add_field() {
    if(x <= 19) {
        x++;
        var cont = document.getElementById('fields');
        var name = "name" + x;
        var id = "id" + x;
        var meta = "meta" + x;
        var amount = "amount" + x;
        var fieldid = "field" + x;
        $('.field_counter').html(x);



        $(cont).append("<div class=\"row\" id=" + fieldid + ">\n" +
            "                    <div class=\"col-12\">\n" +
            "                        <div class=\"input-group mb-3\">\n" +
            "\n" +
            "                            <input name=" + name + " type=\"text\" class=\"form-control w-25\" aria-label=\"Text input with dropdown button\" placeholder=\"Item / Block neve\">\n" +
            "                            <input name=" + id + " type=\"text\" class=\"form-control w-25\" aria-label=\"Text input with dropdown button\" placeholder=\"Item / Block id\">\n" +
            "                            <input name=" + meta + " type=\"text\" class=\"form-control\" aria-label=\"Text input with dropdown button\" value=\"0\" placeholder=\"Meta (Alapból 0)\">\n" +
            "                            <input name=" + amount + " type=\"text\" class=\"form-control\" aria-label=\"Text input with dropdown button\" value=\"1\" placeholder=\"Mennyiség (Alapból 1)\">\n" +
            "\n" +
            "                            <button onclick=\"delete_field('" + fieldid + "');\" class=\"btn btn-outline-danger col-1\" type=\"button\"><i class=\"fas fa-times\"></i></button>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                </div>");

    }
}

function delete_field(id, delete_number) {
    $("#code" + id).remove();
    if(delete_number == true) {
        $('.field_counter').html(x);
        x--;
    }

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

function delete_code(id) {
    loading();
    if(document.domain === "localhost") {
        var target = "http://"+document.domain+"/"+location.pathname.split('/')[1]+"/api/delete";
    }else{
        var target = "http://"+document.domain+"/api/delete";
    }
    var table = "codes";
    var col = "id";
    const params = {
        table,
        col,
        id
    };

    const jsonstring = JSON.stringify(params);
    const http = new XMLHttpRequest();
    http.open("POST", target);
    http.setRequestHeader( "Content-Type", "application/json");
    http.send(jsonstring);

    http.onload = function () {
        delete_field(id, false);
        loading();

    }
}

function confirm_code() {
    var code = $('#code').val();

    if(document.domain === "localhost") {
        var target = "http://"+document.domain+"/"+location.pathname.split('/')[1]+"/api/select";
    }else{
        var target = "http://"+document.domain+"/api/delete";
    }
    var table = "codes";

    const params = {
        table,
        param : param = {
            code:code
        }
    };

    const jsonstring = JSON.stringify(params);
    const http = new XMLHttpRequest();
    http.open("POST", target);
    http.setRequestHeader( "Content-Type", "application/json");
    loading();
    http.send(jsonstring);
    var data = "";
    http.onload = function() {
        data = JSON.parse(http.responseText);
        http.abort();
        loading();

        if(data === false) {
            if(data.used_by != "") {
                $('#error-response').html('Ez a kód nem létezik!');
                $('#error-response').show();
                setTimeout(function () {
                    $('#error-response').hide('blind');
                }, 5000)
            }
        }else{
            if(data.used_by == "") {
                loading();
                var table = "codes";
                var col = "code";
                const params = {
                    table,
                    col,
                    id:code,
                    param : param= {
                        used_by:username
                    }
                };

                const jsonstring = JSON.stringify(params);

                if(document.domain === "localhost") {
                    var target = "http://"+document.domain+"/"+location.pathname.split('/')[1]+"/api/update";
                }else{
                    var target = "http://"+document.domain+"/api/update";
                }

                http.open("POST", target);
                http.setRequestHeader( "Content-Type", "application/json");
                http.send(jsonstring);

                http.onload = function() {
                    $('#success-response').html('Sikeres aktiválás!');
                    $('#success-response').show();
                    setTimeout(function() {
                        $('#success-response').hide('blind');
                    }, 5000)

                    $('#code-results').html("Ezt kaptad: '"+data.name+"', és ennyi mennyiségben: '"+data.amount+"'");
                    http.abort();

                    const params = {
                        title: "Kód aktiválás!",
                        username: username,
                        message: "aktiválta a következő kódot. ("+data.code+")",
                        type: 4
                    };

                    const jsonstring = JSON.stringify(params);

                    if(document.domain === "localhost") {
                        var target = "http://"+document.domain+"/"+location.pathname.split('/')[1]+"/api/add_admin_notification";
                    }else{
                        var target = "http://"+document.domain+"/api/add_admin_notification";
                    }

                    http.open("POST", target);
                    http.setRequestHeader( "Content-Type", "application/json");
                    http.send(jsonstring);
                    http.onload = function() {
                        http.abort();
                        loading();
                    }
                }
            }else{

                $('#error-response').html('Ez a kód már aktiválva van!');
                $('#error-response').show();
                setTimeout(function() {
                    $('#error-response').hide('blind');
                }, 5000)
            }
        }
    }
}