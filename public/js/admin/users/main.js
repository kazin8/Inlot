$(document).ready(function() {

    $('.select-region').change(function() {
        var regionId = $(this).val();
        var token = $('meta[name="_token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $.ajax({
            type: 'POST',
            url: '/choose-region',
            dataType: 'text',
            data: {'regionId': regionId},
            success: function(data) {
                data = $.parseJSON(data);
                var cities = [];
                $.each(data, function(index, value) {
                    cities.push({'id': index, text: value});
                });
                $('.select-cities').empty().select2({
                    data: cities
                });
            }
        });
    });

});