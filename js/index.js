$('.ui.small.modal.register')
    .modal('attach events', '.mini.ui.button.signup', 'show')
;
$('#inquiry')
    .modal('attach events', '#inquire', 'show')
;

$(document).ready(function () {

    $("#owl-carousel").owlCarousel({
        autoplay: true,
        loop: true,
        slideSpeed: 300,
        items: 1,
        itemsDesktop: false,
        itemsDesktopSmall: false,
        itemsTablet: false,
        itemsMobile: false,
    });

});

$('.ui.selection.dropdown')
    .dropdown()
;
$(document)
    .ready(function () {
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