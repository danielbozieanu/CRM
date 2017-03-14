// JQUERY VALIDATOR
$.validator.addClassRules({
        "email": //your class name
            {
                required: true,
                email: true,
            },
        "passwordCheck":
            {
                required: true,
                minlength: 8
            },
        "passwordMatch":
        {
            equalTo: "#password"
        },
        "req":
            {
                required: true,
                minlength: 10
            },
        "array":
            {
                required: true
            }

    }
);

var validator = $('#form').validate({
    rules:{
        "question[]":{
            required: true
        },
        "answers[]":{
            required:true
        },
        "newQuestion[]":{
            required: true
        },
        "newAnswers[]":{
            required: true
        }

    },
    highlight: function (element) {
        $(element).closest('.form-group').addClass('has-error');
    },

    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },

    errorElement: 'span',
    errorClass: 'text-danger small error',
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    messages:{
    }
});

var validator = $('#feedback-form').validate({

    highlight: function (element) {
        $(element).closest('.form-group').addClass('has-error');
    },

    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },

    errorElement: 'p',
    errorClass: 'text-danger small error',
    errorPlacement: function (error, element) {

        switch(element){
            case element.attr("name") == "textAreas[]":
                error.insertBefore(element);
                break;
            case element.attr("name") == "checked[]":
                error.insertAfter(element);
                break;
            default:
                console.log('default');
        }
    },
    messages:{
    }
});

    function resetFormValidator(formId) {
        $(formId).removeData('validator');
        $(formId).removeData('unobtrusiveValidation');
        $.validator.unobtrusive.parse(formId);
    }

//Modals
function confirm_modal(url,title,button,color)
{

    jQuery('.default-modal .modal').addClass(color).modal('show', {backdrop: 'static',keyboard :false});
    jQuery('.default-modal .grt').text(title);
    jQuery('#link_m_n').attr("href" , url ).text(button).focus();

}


//Data table
$(function () {
    $("#data-table").DataTable();

});
