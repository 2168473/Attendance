/*===============Login Validations===============*/
//Check if Password is Correct
$.fn.form.settings.rules.checkPassword = function (value) {
    let email = document.getElementById('ea').value;
    let result = false;
    $.ajax({
        async: false,
        url: 'php/checkPassword.php',
        type: "POST",
        data: {
            password: value,
        },
        dataType: "html",
        success: function (data) {
            result = data;
        }
    });
    return result;
};

//Check if Email is Existing
$.fn.form.settings.rules.checkEmail = function (value) {
    let email = document.getElementById('ea').value;
    let result = false;
    $.ajax({
        async: false,
        url: 'php/checkEmail.php',
        type: "POST",
        data: {
            email: value,
        },
        dataType: "html",
        success: function (data) {
            result = data;
        }
    });
    return result;
};

//Login Form Validation Rules
$('#login-form')
    .form({
        fields: {
            email: {
                identifier: 'email',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter your e-mail'
                    },
                    {
                        type: 'email',
                        prompt: 'Please enter a valid e-mail'
                    },
                    {
                        type: 'checkEmail',
                        prompt: 'Email Address not found'
                    }
                ]
            },
            password: {
                identifier: 'password',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter your password'
                    },

                ]
            },
            purpose: {
                identifier: 'purpose',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter your purpose'
                    },
                ]
            },
        }
    })
;

/*===============Registration Validations===============*/
//Check if Email is Existing
$.fn.form.settings.rules.existingEmail = function (value) {
    let result = true;
    $.ajax({
        async: false,
        url: 'php/checkEmail.php',
        type: "POST",
        data: {
            email: value,
        },
        dataType: "html",
        success: function (data) {
            if (data) {
                result = false;
            }else{
                result = true;
            }
        }
    });
    return result;
};

//Registration Form Validation Rules
$('#registration-form')
    .form({
        fields: {
            first_name: {
                identifier: 'first_name',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter your first name'
                    }
                ]
            },
            last_name: {
                identifier: 'last_name',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter your last name'
                    }
                ]
            },
            email: {
                identifier: 'email',
                rules: [
                    {
                        type: 'email',
                        prompt: 'Please enter a valid email address'
                    },
                ]
            },
            mobile: {
                identifier: 'mobile',
                rules: [
                    {
                        type: 'maxLength[10]',
                        prompt: 'Please enter a valid mobile number'
                    },
                    {
                        type: 'minLength[7]',
                        prompt: 'Please enter a valid mobile number'
                    },
                ]
            },
            company: {
                identifier: 'company',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter your company/organization/school'
                    },
                ]
            },
            password: {
                identifier: 'password',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter a password'
                    },
                    {
                        type: 'minLength[8]',
                        prompt: 'Your password must be at least {ruleValue} characters'
                    }
                ]
            },
            confirm_password: {
                identifier: 'confirm_password',
                rules: [
                    {
                        type: 'empty',
                    },
                    {
                        type: 'match[password]',
                        prompt: 'Passwords do not match'
                    }
                ]
            },
        }
    })
;

/*===============Registration Validations===============*/
$('#inquiry-form')
    .form({
        fields: {
            name: {
                identifier: 'name',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter your full name'
                    }
                ]
            },

            email: {
                identifier: 'email',
                rules: [
                    {
                        type: 'email',
                        prompt: 'Please enter a valid email address'
                    }
                ]
            },
            mobile: {
                identifier: 'mobile',
                rules: [
                    {
                        type: 'maxLength[10]',
                        prompt: 'Please enter a valid mobile number'
                    },
                    {
                        type: 'minLength[7]',
                        prompt: 'Please enter a valid mobile number'
                    },
                ]
            },
            subject: {
                identifier: 'subject',
                rules: [
                    {
                        type: 'empty',
                    }
                ]
            },
            message: {
                identifier: 'message',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter your message'
                    }
                ]
            },
        }
    })
;
$('#inquiry-form').submit(
    function () {
        $.ajax({
            async: false,
            url: 'php/inquire.php',
            type: 'post',
        });
    });
/*===============Logout===============*/
$('#logoutl').click(function () {
        $.ajax({
            url: 'php/logout.php?logout=true',
            type: 'get',
        }).done(function () {
            window.location = '/index.php';
        }).fail(function () {
            console.log('an error occurred');
        });
    }
);

// lazy load images
$('.image').visibility({
    type: 'image',
    transition: 'vertical flip in',
    duration: 500
});
/*===============Modals===============*/
//Open Registration Modal From Menu
$('#register')
    .modal('attach events', '#signup', 'show')
;
//Open Registration modal from Login Form
$('#register')
    .modal('attach events', '#signup-log', 'show')
;
//Open Login Modal
$('#login-modal')
    .modal('attach events', '#login', 'show')
;

//Open Logout Modal
$('#logout-modal')
    .modal('attach events', '#logout', 'show')
;

//Open Inquiry Modal
$('#inquiry')
    .modal('attach events', '#inquire', 'show')
;
//Activate all dropdowns
$('.dropdown')
    .dropdown()
;
