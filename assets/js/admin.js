(function ($) {
    let $window = $(window),
        $sidebar = $('#sidebar'),
        $content = $('#content'),
        $logo = $('#logo');
    $window.resize(function () {
        if ($window.width() < 768) {
            return $sidebar.addClass('icon');
        }
        $sidebar.removeClass('icon');
    }).trigger('resize');
    $window.resize(function () {
        if ($window.width() < 768) {
            return $logo.removeClass('small');
        }
        $logo.addClass('small');
    }).trigger('resize');
    $window.resize(function () {
        if ($window.width() < 768) {
            return $sidebar.removeClass('left');
        }
        $sidebar.addClass('left');
    }).trigger('resize');
    $window.resize(function () {
        if ($window.width() < 768) {
            return $content.css('margin', '0 0 0 125px');
        }
        $content.css('margin', '0 10px 0 275px');
    }).trigger('resize');
})(jQuery);

// show dropdown on hover
$('.menu  .ui.dropdown').dropdown({
    on: 'hover'
});

let handleUsersLogButtons = function () {
    if ($("#users-log").length) {
        $("#users-log").DataTable({
            dom: '<"ui container"<"ui stackable grid"<"seven wide column"B><"four wide column"l><"right aligned ' +
            'five ' +
            'wide column"f>>t<"ui stackable two column grid"<"column"i><"right aligned column"p>>>',
            buttons: [{
                extend: "copy",
                className: "btn-sm"
            },
                {
                    extend: "csv",
                    className: "btn-sm"
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                },
                {
                    extend: "print",
                    className: "btn-sm",
                    customize: function (win) {
                        $(win.document.body).find('')
                            .css('display', 'none');
                    }
                }
            ],
            "order": [[4, "desc"]]
        });
    }
};
UsersLog = function () {
    "use strict";
    return {
        init: function () {
            handleUsersLogButtons();
        }
    };
}();
UsersLog.init();


let handleUsersButton = function () {
    if ($("#users").length) {
        $("#users").DataTable({
            dom: '<"ui container"<"ui stackable grid"<"seven wide column"B><"four wide column"l><"right aligned ' +
            'five ' +
            'wide column"f>>t<"ui stackable two column grid"<"column"i><"right aligned column"p>>>',
            buttons: [{
                extend: "copy",
                className: "btn-sm",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
                },
                {
                    extend: "csv",
                    className: "btn-sm",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: "print",
                    className: "btn-sm",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    customize: function (win) {
                        $(win.document.body).find('')
                            .css('display', 'none');
                    }
                }
            ],
        });
    }
};
UsersButton = function () {
    "use strict";
    return {
        init: function () {
            handleUsersButton();
        }
    };
}();
UsersButton.init();


$('#events').DataTable({
    columnDefs: [
        {
            "targets": [4, 5],
            "orderable": false,
        },
        {
            "width": "30%",
            "targets": 1
        }
    ],
    "order": [[2, "desc"]]
});

//open addevent modal
$('#add-event-modal')
    .modal('attach events', '#add-event', 'show')
;

$('#rangestart').calendar({
    type: 'date',
    endCalendar: $('#rangeend'),
    formatter: {
        date: function (date) {
            if (!date) return '';
            var day = date.getDate() + '';
            if (day.length < 2) {
                day = '0' + day;
            }
            var month = (date.getMonth() + 1) + '';
            if (month.length < 2) {
                month = '0' + month;
            }
            var year = date.getFullYear();
            return year + '-' + month + '-' + day;
        }
    }
});
$('#rangeend').calendar({
    type: 'date',
    startCalendar: $('#rangestart'),
    formatter: {
        date: function (date) {
            if (!date) return '';
            var day = date.getDate() + '';
            if (day.length < 2) {
                day = '0' + day;
            }
            var month = (date.getMonth() + 1) + '';
            if (month.length < 2) {
                month = '0' + month;
            }
            var year = date.getFullYear();
            return year + '-' + month + '-' + day;
        }
    }
});


$("input:text").click(function () {
    $(this).parent().find("input:file").click();
});

$('input:file', '.ui.action.input')
    .on('change', function (e) {
        var name = e.target.files[0].name;
        $('input:text', $(e.target).parent()).val(name);
    });
$('#addEvent')
    .form({
        fields: {
            title: 'empty',
            content: 'empty',
            start_date: 'empty',
            end_date: 'empty',
            cover_image_name: 'empty'
        }
    });
$('#editEvent')
    .form({
        fields: {
            title: 'empty',
            content: 'empty',
            start_date: 'empty',
            end_date: 'empty',
            cover_image_name: 'empty'
        }
    });
$('#editUser')
    .form({
        fields: {
            first_name: 'empty',
            last_name: 'empty',
            email: ['empty', 'email'],
            mobile: ['empty', 'maxLength[10]', 'minLength[7]'],
            company: 'empty',
            user_level: ['integer', 'empty']
        }
    });