$(document).ready(() => {
    $('#datatable').DataTable({
        language: {
            paginate: {
                next: '<i class="fas fa-angle-right"></i>',
                previous: '<i class="fas fa-angle-left"></i>',
                first: '<i class="fas fa-angle-double-left"></i>',
                last: '<i class="fas fa-angle-double-right"></i>'
            }
        }
    });
});
