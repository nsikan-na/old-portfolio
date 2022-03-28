$(document).ready(function(){
    $('.btnSubmit').click(function(){
        $('#myAlert').show('fade');

        setTimeout(function(){
            $('#myAlert').hide('fade');
        },2500);
    });

    $('#linkClose').click(function(){
        $('#myAlert').hide('fade');
    });
    


});
setTimeout(function(){
    $('.success').hide('fade');
},2500);