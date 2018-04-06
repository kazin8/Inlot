$(document).ready(function() {

    $('.add-field').click(function() {
        var field = '<div class="form-group"><input type="text" name="names[]" class="form-control"></div>';
        $('.fields-container').append(field);
    });

    $('.delete-record').click(function() {
        if (confirm('Запись будет удалена безвозвратно. Вы действительно хотите продолжить?')) {
            var action = $(this).attr('data-action');
            var id = $(this).attr('data-id');
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
                    $('.group-' + id).remove();
                    data = JSON.parse(data);
                    alert(data['msg']);
                }
            });
        }
    });

});