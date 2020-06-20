window.datatable = require('datatables');
window.select2 = require('select2');
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


function show_password() {
    var x = document.getElementById("new_password");
    var y = document.getElementById("repeat_password");
    if (x.value == '' || y.value == '') {
        alert('Enter Password First!!');
        $('.sp').prop('checked', false);
    } else {
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        if (y.type === "password") {
            y.type = "text";
        } else {
            y.type = "password";
        }
    }
}
//
$(document).ready(function () {
    $('#userlist').DataTable({
        responsive: true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ]
    });


    $('#movielist').DataTable({
        responsive: true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ]
    });

    $('.select2').select2();
});
