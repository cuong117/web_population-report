$(document).ready(()=> {
    fetch_data();
    function fetch_data() {
    var action = "fetch_data";
    $.ajax({
        url: "./controllers/action.php",
        method: "POST",
        data: {action:action},
        success: function(data) {
            $('#province-table').html(data);

        }
    })
}
    $('div.add-div').hide();
    $('#add-button').click(function(){
        $('div.add-div').toggle();
    });
})