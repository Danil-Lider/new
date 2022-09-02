$(document).ready(function() {

$('.GetCupon').submit(function(e) {

    e.preventDefault(); 
    var $form = $(this);

    $.ajax({
        type: $form.attr('method'),
        cache: false,
        dataType: 'html',
        data: $form.serialize(),
        url: $form.attr('action'),
        success: function(msg) {

            console.log(msg);

            $('.succes').html(msg)
            

        }
    });

});


$('.Check').submit(function(e) {

    e.preventDefault(); 
    var $form = $(this);

    $.ajax({
        type: $form.attr('method'),
        cache: false,
        dataType: 'html',
        data: $form.serialize(),
        url: $form.attr('action'),
        success: function(msg) {

            console.log(msg);

            $('.succes').html(msg)
            

        }
    });

});


})