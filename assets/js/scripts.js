
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
            }
    }
);




var validator = $('#form').validate({
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

    function resetFormValidator(formId) {
        $(formId).removeData('validator');
        $(formId).removeData('unobtrusiveValidation');
        $.validator.unobtrusive.parse(formId);
    }

