$(document)
    .ready(function () {
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
                    purpose: {
                        identifier: 'purpose',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your e-mail'
                            },
                        ]
                    },
                }
            })
        ;

        $('#registration-form')
            .submit(function () {
                $.ajax({
                    url: 'php/register.php,',
                    type: 'post',
                }).done(function () {
                    //window.location = '/index.php';
                    alert('Successfully Registered!')
                }).fail(function () {
                    console.log('an error occurred')
                });
            }
        )
        ;

    })
;
