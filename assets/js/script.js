$(document)
    .ready(function() {
        $('#logoutl').click(function () {
                $.ajax({
                    url: 'php/logout.php',
                    type: 'get',
                }).done(function () {
                    window.location = '/index.php';
                }).fail(function () {
                    console.log('an error occurred');
                });
            }
        );

        // fix main menu to page on passing
        $('.main.menu').visibility({
            type: 'fixed'
        });
        $('.overlay').visibility({
            type: 'fixed',
            offset: 80
        });

        // lazy load images
        $('.image').visibility({
            type: 'image',
            transition: 'vertical flip in',
            duration: 500
        });

        // show dropdown on hover
        $('.main.menu  .ui.dropdown').dropdown({
            on: 'hover'
        });
        $('#register')
            .modal('attach events', '#signup', 'show')
        ;
        $('#register')
            .modal('attach events', '#signup-log', 'show')
        ;
        $('#login-modal')
            .modal('attach events', '#login', 'show')
        ;
        $('#logout-modal')
            .modal('attach events', '#logout', 'show')
        ;
        $('#inquiry')
            .modal('attach events', '#inquire', 'show')
        ;
        $('.ui.selection.dropdown')
            .dropdown()
        ;
        $('#dropdown')
            .dropdown()
        ;
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
                            }
                        ]
                    },
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your password'
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
            })
        ;

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
                                type   : 'empty',
                                prompt : 'Please enter a password'
                            },
                            {
                                type   : 'minLength[8]',
                                prompt : 'Your password must be at least {ruleValue} characters'
                            }
                        ]
                    },
                    confirm_password: {
                        identifier: 'confirm_password',
                        rules: [
                            {
                                type   : 'empty',
                            },
                            {
                                type   : 'match[password]',
                                prompt : 'Passwords do not match'
                            }
                        ]
                    },
                }
            })
        ;

    })
;
