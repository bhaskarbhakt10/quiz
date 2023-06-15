$(document.body).on('change', 'input[type=checkbox]', function(e) {
    console.log($(this));
    $('label').removeClass('selected')
    if ($(this).is(':checked')) {
        let target_for = $(this).attr('id');
        $('label[for='+target_for+']').addClass('selected');
    }
})