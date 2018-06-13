$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error : function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0 || jqXHR.readyState === 0 || jqXHR.status === 422) {
                return;
            }

            alert('Er ging iets fout met het laden. Probeer het later opnieuw.');
        }
    });
});
