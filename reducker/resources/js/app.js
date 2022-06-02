$(function() {
    $('#generate').on('click',function(){
        var link = $('#fLink').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/short',
            type: "POST",
            data: {link:link},
            success: function (data) {
                $('#shLink').val('http://127.0.0.1:8000/'+data);
            },
            error: function (xhr, textStatus ) {
                alert( [ xhr.status, textStatus ] );
            }
        });
    });
});
