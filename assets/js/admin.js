// function to check if the text contains an element from the array
$.fn.form.settings.rules.containsInArray = function (value, csv) {
    let array = String(csv).split(','); // you're separating the string by commas
    let isContains = false; // return value
    // for each element check it usign contains function
    $.each(array, function (index, elem) {
        if ($.fn.form.settings.rules.contains(value, $.trim(elem))) {
            // if condition are meet set the result as true
            // and breaks the loop
            isContains = true;
            return false;
        }
    });
    return isContains;
};

/*===============Make the Admin Responsive===============*/
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
$('.dropdown').dropdown({
    on: 'hover'
});


/*===============Handle Buttons on the User Logs Table===============*/
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


/*===============Handle Buttons on the User Payments Table===============*/
let handlePaymentsButtons = function () {
    if ($("#payments").length) {
        $("#payments").DataTable({
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
            ]
        });
    }
};
Payments = function () {
    "use strict";
    return {
        init: function () {
            handlePaymentsButtons();
        }
    };
}();
Payments.init();

/*===============Handle Buttons on the Users Table===============*/
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

/*===============Set Column Definitions on the Events Table===============*/
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


/*===============Add Event===============*/
$('#add-event-modal')
    .modal('attach events', '#add-event', 'show')
;
//Set Range Dates Format
$('#rangestart').calendar({
    type: 'date',
    endCalendar: $('#rangeend'),
    formatter: {
        date: function (date) {
            if (!date) return '';
            let day = date.getDate() + '';
            if (day.length < 2) {
                day = '0' + day;
            }
            let month = (date.getMonth() + 1) + '';
            if (month.length < 2) {
                month = '0' + month;
            }
            let year = date.getFullYear();
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
            let day = date.getDate() + '';
            if (day.length < 2) {
                day = '0' + day;
            }
            let month = (date.getMonth() + 1) + '';
            if (month.length < 2) {
                month = '0' + month;
            }
            let year = date.getFullYear();
            return year + '-' + month + '-' + day;
        }
    }
});

/*===============File Upload===============*/
$("input:text").click(function () {
    $(this).parent().find("input:file").click();
});

$('input:file', '.ui.action.input')
    .on('change', function (e) {
        let name = e.target.files[0].name;
        $('input:text', $(e.target).parent()).val(name);
    });

/*===============Add Event===============*/
$('#addEvent')
    .form({
        fields: {
            title: 'empty',
            content: 'empty',
            start_date: 'empty',
            end_date: 'empty',
            cover_image_name: 'containsInArray[.png, .jpg, .jpeg, .gif, .tiff, .tif]'
        }
    }).ajaxForm(function () {
    $('#add-event-modal').modal('hide');
    swal({
        title: "Success!",
        text: "Event added!",
        icon: "success",
        timer: 2500,
        button: false
    });
    setTimeout(location.reload.bind(location), 1000);
});
/*===============Edit Event===============*/
$('#editEvent')
    .form({
        fields: {
            title: 'empty',
            content: 'empty',
            start_date: 'empty',
            end_date: 'empty',
            cover_image_name: 'containsInArray[.png, .jpg, .jpeg, .gif, .tiff, .tif]'
        }
}).ajaxForm(function () {
    $('#edit-event-modal').modal('hide');
    swal({
        title: "Success!",
        text: "Changes saved!",
        icon: "success",
        timer: 2500,
        button: false
    });
    setTimeout(location.reload.bind(location), 1000);
});
/*===============Edit User===============*/
$('#editUser')
    .form({
        fields: {
            first_name: 'empty',
            last_name: 'empty',
            email: ['empty', 'email'],
            mobile: ['empty', 'maxLength[10]', 'minLength[7]'],
            company: 'empty',
        }
    }).ajaxForm(function () {
    $('#edit-user-modal').modal('hide');
    swal({
        title: "Success!",
        text: "Changes saved!",
        icon: "success",
        timer: 2500,
        button: false
    });
    setTimeout(location.reload.bind(location), 1000);
});

function editEvent(id) {
    $.get("php/functions.php?getAnnouncement=" + id, function (data) {
        $('#eventStart').calendar({
            type: 'date',
            endCalendar: $('#eventEnd'),
            formatter: {
                date: function (date) {
                    if (!date) return '';
                    let day = date.getDate() + '';
                    if (day.length < 2) {
                        day = '0' + day;
                    }
                    let month = (date.getMonth() + 1) + '';
                    if (month.length < 2) {
                        month = '0' + month;
                    }
                    let year = date.getFullYear();
                    return year + '-' + month + '-' + day;
                }
            },
        });
        $('#eventStart').calendar("set date", new Date(data['start_date']));
        $('#eventEnd').calendar({
            type: 'date',
            startCalendar: $('#eventStart'),
            formatter: {
                date: function (date) {
                    if (!date) return '';
                    let day = date.getDate() + '';
                    if (day.length < 2) {
                        day = '0' + day;
                    }
                    let month = (date.getMonth() + 1) + '';
                    if (month.length < 2) {
                        month = '0' + month;
                    }
                    let year = date.getFullYear();
                    return year + '-' + month + '-' + day;
                }
            }
        });
        $('#eventEnd').calendar("set date", new Date(data['end_date']));
        $('#title').val(data['title']);
        $('#cover_image_name').val(data['cover_image_name']);
        $('#text_content').val(data['content']);
        $('#eventId').val(id);
        $('#edit-event-modal')
            .modal('show')
        ;
    });
}

function deleteEvent(id) {
    $.get("php/functions.php", {getAnnouncement: id}, function (data) {
        swal({
            title: "Are you sure?",
            text: "Delete " + data['title'],
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! " + data['title'] + " has been deleted!", {
                        icon: "success", buttons: false
                    });
                    $.ajax({
                        url: 'php/del-event.php',
                        data:{
                            eventId: id
                        }
                    });
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    swal(data['title'] + " is safe!");
                }
            });
    });
}

function editUser(id) {
    $.get("php/functions.php?getUser=" + id, function (data) {
        $('#first_name').val(data['first_name']);
        $('#last_name').val(data['last_name']);
        $('#email').val(data['userEmail']);
        $('#mobile').val(String(data['userMobile']).substring(3));
        $('#company').val(data['userCompany']);
        $('#userId').val(id);
        $('#edit-user-modal')
            .modal('show')
        ;
    });

}

function deleteUser(id) {
    $.get("php/functions.php?getUser=" + id, function (data) {
        swal({
            title: "Are you sure?",
            text: "Delete " + data['first_name'] + ' ' + data['last_name'],
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("Poof! " + data['first_name'] + ' ' + data['last_name'] + " has been deleted!", {
                    icon: "success", buttons: false
                });
                $.ajax({
                    url: 'php/del-user.php',
                    data:{
                        userId: id
                    }
                });
                setTimeout(location.reload.bind(location), 1000);
            } else {
                swal(data['first_name'] +' ' + data['last_name'] + " is safe!");
            }
        });
    });
}

$.fn.form.settings.rules.ip_address = function (value) {
    let expression = /((^\s*((([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))\s*$)|(^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$))/;
    return expression.test(value);
};
$('#sendSMS').form({
    fields: {
        recipient: ['empty', 'integer', 'minLength[7]', 'maxLength[11]'],
        message: ['empty']
    }
}).ajaxForm({
    url: 'http://' + $('#ip').val() + ':' + $('#port').val() + '/',
    data: {
        token: $('#token').val(),
    },
    success: function () {
        swal({
            title: "Success!",
            text: "Message Sent",
            icon: "success",
            timer: 2500,
        });
        $('#ip').val('');
        $('#port').val('');
    }
});
$("#sms").form({
    fields: {
        ip_address: ['ip_address', 'empty'],
        port: ['empty', 'integer'],
        number: ['empty', 'integer', 'minLength[7]', 'maxLength[11]'],
    }
}).ajaxForm({
    url: 'php/functions.php',
    method: 'post',
    success: function () {
        swal({
            title: "Success!",
            text: "Changes have been saved!",
            icon: "success",
            timer: 2500,
            button: false
        });
    }
});
