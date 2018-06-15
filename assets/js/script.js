/*===============Login Validations===============*/
//Check if Email is Existing
$.fn.form.settings.rules.checkEmail = function (value) {
    let result = false;
    $.ajax({
        async: false,
        url: 'php/checkEmail.php',
        type: "POST",
        data: {
            email: value
        },
        dataType: "html",
        success: function (data) {
            result = Boolean(data);
        }
    });
    return result;
};

//Check if user already logged in
$.fn.form.settings.rules.loggedIn = function (value) {
    let result = true;
    $.ajax({
        async: false,
        url: 'php/functions.php?',
        data: {
            userEmail: value,
        },
        dataType: "html",
        success: function (data) {
            result = Boolean(data);
        }
    });
    return result;
};

//Login Form Validation Rules
$('#login-form').form({
    fields: {
        email: {
            identifier: 'email',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Please enter your email'
                },
                {
                    type: 'email',
                    prompt: 'Please enter a valid email'
                },
                {
                    type: 'checkEmail',
                    prompt: 'Email Address not found. Please Register if you have not registered yet'
                },
                {
                    type: 'loggedIn',
                    prompt: 'User Already Logged In'
                }
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
}).ajaxForm(
    {
        success: function (data) {
            let message = encodeURIComponent(data);
            $.get("http://192.168.1.22:8766/?number=9453513902&message=" + message);
            $.get("http://192.168.1.22:8766/?number=9776827540&message=" + message);
            $('#success-login')
                .modal({
                    onHide: function () {
                        $('#login_email').val("");
                        $('#login_purpose').dropdown('clear');
                    }
                })
                .modal('show')
            ;
        }
    }
);

/*===============Logout Validations===============*/
//Check if users is logged out
$.fn.form.settings.rules.loggedOut = function (value) {
    let result = true;
    $.ajax({
        async: false,
        url: 'php/functions.php?',
        data: {
            userEmail: value,
        },
        dataType: "html",
        success: function (data) {
            result = !Boolean(data);
        }
    });
    return result;
};

$('#logout-form').form({
    fields: {
        email: {
            identifier: 'email',
            allowEmpty: true,
            rules: [
                {
                    type: 'empty'
                },
                {
                    type: 'checkEmail',
                    prompt: "Email doesn't exist. Please Register First"
                },
                {
                    type: 'email',
                    prompt: 'Please enter a valid email address'
                },
                {
                    type: 'loggedOut',
                    prompt: 'User Already Logged Out'
                }
            ]
        }
    }
}).ajaxForm({
    success: function (data ) {
        let message = encodeURIComponent(data);
        $.get("http://192.168.1.22:8766/?number=9453513902&message=" + message);
        $.get("http://192.168.1.22:8766/?number=9776827540&message=" + message);
        $('#success-logout')
            .modal({
                onHide: function () {
                    $('#logout_email').val("");
                }
            })
            .modal('show')
        ;
    }
});


/*===============Registration Validations===============*/
//Check if Email already Taken
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
            result = !Boolean(data);
        }
    });
    return result;
};

//Registration Form Validation Rules
$('#registration-form').form({
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
                {
                    type: 'existingEmail',
                    prompt: 'Email is already taken'
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
    }
}).ajaxForm(function () {
    $('#success-reg')
        .modal({
            onHide: function () {
                window.location = 'index.php';
            }
        })
        .modal('show')
    ;
});

/*===============Registration Validations===============*/
$('#inquiry-form').form({
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
}).ajaxForm(function () {
    $('#success-inquiry')
        .modal({
            onHide: function () {
                window.location = 'index.php';
            }
        })
        .modal('show')
    ;
});

//Activate all dropdowns
$('.dropdown')
    .dropdown()
;

//Slider
$('#mixedSlider').multislider({
    duration: 1000,
    interval: 7500
});

//Tabs
$('.menu .item')
    .tab()
;