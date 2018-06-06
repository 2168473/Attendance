$(document)
    .ready(function() {

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
        $('.ui.form')
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
                    purpose: {
                        identifier: 'purpose',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select your purpose'
                            },
                        ]
                    }
                }
            })
        ;

        $('.ui.form')
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
                    }
                }
            })
        ;
    })
;
