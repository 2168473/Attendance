$.fn.api.settings.debug = true;
/*===============Login Validations===============*/
//Check if Email is Existing
$.fn.form.settings.rules.checkEmail = function (value) {
    let result = false;
    $.ajax({
        async: false,
        url: 'php/checkEmail',
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
        url: 'php/functions',
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
let intervals = [];
$.get('php/functions?logs=true', function (data) {
    for (let x = 0; x < data.length; x++) {
        let sessionId = data[x].sessionId;
        let number = data[x].userMobile;
        let message = "Your maximum login time has been reached (14 hours) making your account  automatically" +
            " logged out. Please login on the terminal to restore session.";
        intervals[sessionId] = setInterval(function () {
            $.get('php/functions?sessionId=' + sessionId, function (data) {
                if (new Date() >= new Date(data.sessionOut)) {
                    $.get('php/logout?sessionId=' + sessionId);
                    $.get('php/sms_config', function (value) {
                        let ip = value['ip address'];
                        let port = value['port'];
                        let token = value['token'];
                        let url = 'http://' + ip + ':' + port + '/?number=' + number + '&message=' + message;
                        if (token !== '') {
                            url = 'http://' + ip + ':' + port + '/?number=' + number + '&message=' + message + '&token=' + token;
                        }
                        $.get(url);
                    });
                    clearInterval(intervals[sessionId]);
                }
            });
        }, 3600000);//3600000 -1 hour
    }
});

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
        url: 'php/login',
        method: 'post',
        serializeForm: true,
        dataType: 'json',
        success: function (data) {
            let number;
            let ip;
            let port;
            let token;
            let url;
            let message = encodeURIComponent(data['message']);
            $.get('php/sms_config', function (value) {
                number = value['number'];
                ip = value['ip address'];
                port = value['port'];
                token = value['token'];
                url = 'http://' + ip + ':' + port + '/?number=' + number + '&message=' + message;
                if (token !== '') {
                    url = 'http://' + ip + ':' + port + '/?number=' + number + '&message=' + message + '&token=' + token;
                }
                $.get(url);
            });
            let userEmail = data.email;
            let sessionId = '';
            $.get('php/functions?user_email=' + userEmail, function (data) {
                sessionId = data['sessionId'];
                console.log(sessionId);
                intervals[sessionId] = setInterval(function () {
                    $.get('php/functions?sessionId=' + sessionId, function (data) {
                        if (new Date() >= new Date(data.sessionOut)) {
                            $.get('php/logout?sessionId=' + sessionId);
                            $.get('php/sms_config', function (value) {
                                let ip = value['ip address'];
                                let port = value['port'];
                                let token = value['token'];
                                let url = 'http://' + ip + ':' + port + '/?number=' + number + '&message=' + message;
                                if (token !== '') {
                                    url = 'http://' + ip + ':' + port + '/?number=' + number + '&message=' + message + '&token=' + token;
                                }
                                $.get(url);
                            });
                            clearInterval(intervals[sessionId]);
                        }
                    });
                }, 3600000);//3600000 -1 hour
                if (data['Drop-in Coworking']) {
                    (async function () {
                        const {value: payment} = await swal({
                            title: 'Amount to be paid:',
                            html: '<table class="ui very basic collapsing celled table" style="margin: 0 auto">' +
                            '<tr>' +
                            '<td>Regular</td>' +
                            '<td>Php500.00</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td>Off-Members</td>' +
                            '<td>Php350.00</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td>Student</td>' +
                            '<td>Php250.00</td>' +
                            '</tr>' +
                            '</table>' +
                            '<p style="margin: 0 auto">For Students, please present a valid ID</p>',
                            input: 'select',
                            inputOptions: {
                                '500.00': 'Regular',
                                '350.00': 'Off-Members',
                                '250.00': 'Student',
                                '0.00': 'Already Paid'
                            },
                            inputPlaceholder: 'Type',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            inputValidator: (value) => {
                                return new Promise((resolve) => {
                                    if (value === '') {
                                        resolve('You need to select an Option :)')
                                    } else {
                                        resolve();
                                    }
                                })
                            }
                        });

                        if (payment) {
                            swal({
                                type: 'success',
                                title: "Successfully Paid " + payment,
                                text: "You are now Logged in! \nDon't forget to logout!",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            $.get('php/functions?sessionId=' + sessionId + '&payment=' + payment);
                        }
                    })();

                } else {
                    swal({
                        type: 'success',
                        title: 'Success!',
                        text: "You are now logged in! \nDon't forget to logout!",
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            });
            $('#login_email').val("");
            $('#login_purpose').dropdown('clear');
        }

    }
);
/*===============Logout Validations===============*/
//Check if users is logged out
$.fn.form.settings.rules.loggedOut = function (value) {
    let result = true;
    $.ajax({
        async: false,
        url: 'php/functions',
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
    async: false,
    url: 'php/logout',
    method: 'post',
    dataType: 'json',
    success: function (data) {
        clearInterval(intervals[data['sessionId']]);
        let message = encodeURIComponent(data['message']);
        $.get('php/sms_config', function (value) {
            let number = value['number'];
            let ip = value['ip address'];
            let port = value['port'];
            let token = value['token'];
            let url = 'http://' + ip + ':' + port + '/?number=' + number + '&message=' + message;
            if (token !== '') {
                url = 'http://' + ip + ':' + port + '/?number=' + number + '&message=' + message + '&token=' + token;
            }
            $.get(url);
        });
        swal({
            type: 'success',
            title: 'Success!',
            text: "You are now logged out! \nDon't forget to come back!",
            showConfirmButton: false,
            timer: 2500
        });
        $('#logout_email').val("");
    }
});

/*===============Registration Validations===============*/
//Check if Email already Taken
$.fn.form.settings.rules.existingEmail = function (value) {
    let result = true;
    $.ajax({
        async: false,
        url: 'php/checkEmail',
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
    },
    keyboardShortcuts: false
}).ajaxForm({
    url: 'php/register',
    method: 'post',
    success: function () {
        swal({
            type: 'success',
            title: 'Success!',
            text: "You are now Registered. You may now Log in!",
            showConfirmButton: false,
            timer: 2500
        });
        $('#first_name').val("");
        $('#last_name').val("");
        $('#email').val("");
        $('#company').val("");
        $('#mobile').val("");
    }
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
}).api(
    {
        url: 'php/inquire',
        method: 'post',
        serializeForm: true,

        onSuccess: function () {
            swal({
                title: "Success!",
                text: "Your Inquiry has been sent!",
                type: "success",
                timer: 2500,
            });
            $('#name').val("");
            $('#subject').val("");
            $('#message').val("");
            $('#email_address').val("");
            $('#mobile_number').val("");
        }
    }
);

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

let viewEvent = function (eventId) {
    $.get('php/functions?eventId=' + eventId, function (data) {
        document.getElementById('view_header').innerHTML = data['title'];
        document.getElementById('view_content').innerHTML = data['content'];
        document.getElementById('view_cover_image').src = data['cover_image'];
        $('#viewEvent').modal('show');
    });
};