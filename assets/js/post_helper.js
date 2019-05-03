function reveal_text(id) {
    $('#need_to_toggle_' + id).toggle();
    $('#show_' + id).hide();
    $('#hide_' + id).show();
}

function hide_text(id) {
    $('#need_to_toggle_' + id).toggle();
    $('#show_' + id).show();
    $('#hide_' + id).hide();
}