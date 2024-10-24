import './bootstrap';

//jquery
const $ = require('jquery');
window.$ = window.jQuery = $;

require('datatables.net-bs4');

$(document).ready(function (){
    $('#supplierTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
});