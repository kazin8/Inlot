/* Universal removal of row */
$(document).on('click', '.ajax-delete', function() {
    if (confirm('Вы уверены, что хотите удалить эту запись?')) {
        var id = $(this).attr('data-id');
        var action = $(this).attr('data-action');
        var token = $('meta[name="_token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        $.ajax({
            type: 'DELETE',
            url: action,
            dataType: 'text',
            data: {'id': id},
            success: function(data) {
                data = JSON.parse(data);
                alert(data['msg']);
                if (data['status'] == 'success') {
                    location.reload();
                }
            }
        });
    }
});

$(document).ready(function() {

    $('.single-select').select2();

    /* Universal multiple removal of rows */
    $('.ajax-delete-many').click(function() {
        var table = window.LaravelDataTables['dataTableBuilder'];
        var idsArr = [];
        table.rows('.selected').ids().each(function(item) {
            idsArr.push(item);
        });
        if (idsArr.length) {
            if (confirm('Вы уверены, что хотите удалить эти записи?')) {
                var token = $('meta[name="_token"]').attr('content');
                var action = $(this).attr('data-action');
                var idsJSON = JSON.stringify(idsArr);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: action,
                    dataType: 'text',
                    data: {'ids': idsJSON},
                    success: function(data) {
                        data = JSON.parse(data);
                        alert(data['msg']);
                        if (data['status'] == 'success') {
                            location.reload();
                        }
                    }
                });
            }
        } else {
            alert('Не выбрано ни одной записи для удаления!');
        }
    });

});