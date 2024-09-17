/* 
 * Include common Js code here
 */

//This section initialize the all elements

$('.numeric').on('input', function (event) {
    var val = $(this).val();
    if (isNaN(val)) {
        val = val.replace(/[^0-9\.]/g, '');
        if (val.split('.').length > 2)
            val = val.replace(/\.+$/, "");
    }
    $(this).val(val);
});
//End of This section initialize the all elements
$('input[name=hq_price_type]').click(function () {
    if ($(this).val() == 'Paid') {
        $('#priceInput').show();
    } else {
        $('#priceInput').hide();
    }
})
$('input[name=hq_late_joiner]').click(function () {
    if ($(this).val() == 'Accepted') {
        $('#hq_late_join_date').show();
    } else {
        $('#hq_late_join_date').hide();
    }
})
$(document).ready(function () {

    $(".pull-right1").on('click', '.glyphicon-chevron-up, .glyphicon-chevron-down', function () {

        $(this).toggleClass("glyphicon-chevron-down glyphicon-chevron-up");

    });


    var date1 = new Date($('#hq_start_date').val());
    var date2 = new Date($('#hq_end_date').val());
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    $('#hq_duration').val(diffDays)
    $('#duration').html(diffDays)
    $('select.e1').select2({maximumSelectionLength: 1});


    var date1 = new Date($('#m_start_date').val());
    var date2 = new Date($('#m_end_date').val());
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600));
    $('#m_duration').val(diffDays);
    $('#duration').html(diffDays)

});
$('.newFile').click(function () {
    $(this).parents('.fileinput').find('.thumbnail').trigger('click');
})

function bulkAction() {
    //alert('test');
    var action = $('#actionButton').val();
    var ids = new Array();
    $("[id*='action_']").each(function (row, val) {
        if ($(this).hasClass('active') == true) {
            var id = $(this).attr('id').split('_');
            ids.push(id[1]);
        }
    })

    if (ids.length > 0) {
        if (action == 'Delete') {
            bootbox.confirm({
                message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY !ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
                buttons: {
                    confirm: {
                        label: 'YES, DELETE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {
                    if (result == true) {

                        $.ajax({
                            type: "POST",
                            url: "backend/hq_thematics/delete_thematic",
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });

        }
    } else {
        alert('Please select any thematics');
    }

}

function bulkActionCategory() {
    //alert('test');
    var action = $('#actionButton').val();
    var ids = new Array();
    $("[id*='action_']").each(function (row, val) {
        if ($(this).hasClass('active') == true) {
            var id = $(this).attr('id').split('_');
            ids.push(id[1]);
        }
    })

    if (ids.length > 0) {
        if (action == 'Delete') {

            bootbox.confirm({
                message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY !ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
                buttons: {
                    confirm: {
                        label: 'YES, DELETE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        $.ajax({
                            type: "POST",
                            url: "backend/ms_categories/delete_category",
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });

        }
    } else {
        alert('Please select any Category');
    }

}

function changeAction() {
    var action = $('#actionButton').val();
    var ids = new Array();
    $("[id*='action_']").each(function (row, val) {
        if ($(this).hasClass('active') == true) {
            var id = $(this).attr('id').split('_');
            ids.push(id[1]);
        }
    })
    if (ids.length > 0) {
        if (action == 'Archive') {
            bootbox.confirm({
                message: "<div class='boot-header'>DO YOU REALY WANT TO ARCHIVE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in archive and won't be available into front anymore</div>",
                buttons: {
                    confirm: {
                        label: 'ARCHIVE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        var ids = new Array();
                        $("[id*='action_']").each(function (row, val) {
                            if ($(this).hasClass('active') == true) {
                                var id = $(this).attr('id').split('_');
                                ids.push(id[1]);
                            }
                        })
                        if (ids.length > 0) {
                            $.ajax({
                                type: "POST",
                                url: "backend/health_quest/add_to_archive",
                                data: "ids=" + ids,
                                dataType: "text",
                                success: function (data) {
                                    location.reload();
                                }
                            })
                        } else {
                            alert('Please select any health quest');
                        }
                    }

                }
            });
        } else if (action == 'Restore') {
            bootbox.confirm({
                message: "<div class='boot-header'>DO YOU REALY WANT TO RESTORE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in published and this will be available into front</div>",
                buttons: {
                    confirm: {
                        label: 'RESTORE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        $.ajax({
                            type: "POST",
                            url: "backend/health_quest/add_to_restore",
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });




        } else if (action == 'Delete') {
            bootbox.confirm({
                message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY ! ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
                buttons: {
                    confirm: {
                        label: 'YES, DELETE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        $.ajax({
                            type: "POST",
                            url: "backend/health_quest/delete_health_quest",
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });



        } else {
            location.href = "backend/health_quest/details_health_quest/" + ids[0];
        }
    } else {
        alert('Please select any health quest');
    }
}

function singleRestore(id) {
    bootbox.confirm({
        message: "<div class='boot-header'>DO YOU REALY WANT TO RESTORE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in published and this will be available into front</div>",
        buttons: {
            confirm: {
                label: 'RESTORE',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true) {
                $.ajax({
                    type: "POST",
                    url: "backend/health_quest/add_to_restore",
                    data: "ids=" + id,
                    dataType: "text",
                    success: function (data) {
                        location.reload();
                    }
                })
            }

        }
    });
}

$('#barchive').click(function () {
    bootbox.confirm({
        message: "<div class='boot-header'>DO YOU REALY WANT TO ARCHIVE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in archive and won't be available into front anymore</div>",
        buttons: {
            confirm: {
                label: 'ARCHIVE',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true) {
                var ids = new Array();
                $("[id*='action_']").each(function (row, val) {
                    if ($(this).hasClass('active') == true) {
                        var id = $(this).attr('id').split('_');
                        ids.push(id[1]);
                    }
                })
                if (ids.length > 0) {
                    $.ajax({
                        type: "POST",
                        url: "backend/health_quest/add_to_archive",
                        data: "ids=" + ids,
                        dataType: "text",
                        success: function (data) {
                            location.reload();
                        }
                    })
                } else {
                    alert('Please select any health quest');
                }
            }

        }
    });



})

$('#restore').click(function () {

    bootbox.confirm({
        message: "<div class='boot-header'>DO YOU REALY WANT TO RESTORE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in published and this will be available into front</div>",
        buttons: {
            confirm: {
                label: 'RESTORE',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true) {
                var ids = new Array();
                $("[id*='action_']").each(function (row, val) {
                    if ($(this).hasClass('active') == true) {
                        var id = $(this).attr('id').split('_');
                        ids.push(id[1]);
                    }
                })
                if (ids.length > 0) {
                    $.ajax({
                        type: "POST",
                        url: "backend/health_quest/add_to_restore",
                        data: "ids=" + ids,
                        dataType: "text",
                        success: function (data) {
                            location.reload();
                        }
                    })
                } else {
                    alert('Please select any health quest');
                }
            }

        }
    });


})


$('#hq_end_date').blur(function () {
    var date1 = new Date($('#hq_start_date').val());
    var date2 = new Date($('#hq_end_date').val());
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    $('#hq_duration').val(diffDays);
    $('#duration').html(diffDays)
})

$('#m_end_date').blur(function () {
    var date1 = new Date($('#m_start_date').val());
    var date2 = new Date($('#m_end_date').val());
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600));
    $('#m_duration').val(diffDays);
    $('#duration').html(diffDays)
})

$('.selectAll').click(function () {
    if ($(this).hasClass('active') == false) {
        $('#' + $(this).parents('table').attr('id')).find("[id*='action_']").each(function (row, val) {
            $(val).addClass('active');
        })
    } else {
        $('#' + $(this).parents('table').attr('id')).find("[id*='action_']").each(function (row, val) {
            $(val).removeClass('active');
        })
    }
});

function singleArchive(id, status) {
    if (status == 'Published' || status == 'Ongoing') {
        bootbox.alert({
            message: "<div class='boot-header'>THIS HEALTH QUEST IS ALREADY PUBLISHED. ?</div><div class='boot-text'>This health quest is already published. If you want to archive this then you need to unpublished this first.</div>",
        });
    } else {
        bootbox.confirm({
            message: "<div class='boot-header'>DO YOU REALY WANT TO ARCHIVE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in archive and won't be available into front anymore</div>",
            buttons: {
                confirm: {
                    label: 'ARCHIVE',
                    className: 'boot-confirm'
                },
                cancel: {
                    label: 'CANCEL',
                    className: 'boot-no'
                }
            },
            callback: function (result) {
                if (result == true)
                    location.href = site_url + 'health_quest/add_to_archive_individual/' + id;
            }
        });
    }
}
function singleDelete(id, status) {
    if (status == 'Published' || status == 'Ongoing') {
        bootbox.alert({
            message: "<div class='boot-header'>THIS HEALTH QUEST IS ALREADY PUBLISHED. ?</div><div class='boot-text'>This health quest is already published. If you want to delete this then you need to unpublished this first.</div>",
        });
    } else {
        bootbox.confirm({
            message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY ! ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
            buttons: {
                confirm: {
                    label: 'YES, DELETE',
                    className: 'boot-confirm'
                },
                cancel: {
                    label: 'CANCEL',
                    className: 'boot-no'
                }
            },
            callback: function (result) {
                if (result == true)
                    location.href = site_url + 'health_quest/delete_health_quest_manual/' + id;
            }
        });
    }
}

function singleDeleteMission(id, status) {
    if (status == 'Ongoing') {
        bootbox.alert({
            message: "<div class='boot-header'>THIS HEALTH QUEST MISSION IS ALREADY PUBLISHED. ?</div><div class='boot-text'>This health quest mission is already published. If you want to delete this then you need to unpublished this first.</div>",
        });
    } else {
        bootbox.confirm({
            message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY ! ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
            buttons: {
                confirm: {
                    label: 'YES, DELETE',
                    className: 'boot-confirm'
                },
                cancel: {
                    label: 'CANCEL',
                    className: 'boot-no'
                }
            },
            callback: function (result) {
                if (result == true)
                    location.href = site_url + 'health_quest/delete_health_quest_mission/' + id;
            }
        });
    }
}

function delete_categories(id) {
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY ! ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
        buttons: {
            confirm: {
                label: 'YES, DELETE',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = site_url + 'ms_categories/delete_single_category/' + id;

        }
    });
}

function approve(url) {
    bootbox.confirm({
        message: "<div class='boot-header'>ARE YOU SURE TO APPROVE ?</div>",
        buttons: {
            confirm: {
                label: 'YES, APPROVE',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = url;

        }
    });
}

function reject(url) {
    bootbox.confirm({
        message: "<div class='boot-header'>ARE YOU SURE TO REJECT ?</div>",
        buttons: {
            confirm: {
                label: 'YES, REJECT',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = url;

        }
    });
}

function delete_row(url) {
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY ! ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
        buttons: {
            confirm: {
                label: 'YES, DELETE',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = url;

        }
    });
}
function userActivition(id) {
    
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO DEACTIVET THIS USER ! ARE YOU SURE ?</div>",
        buttons: {
            confirm: {
                label: 'YES, DEACTIVATE',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = 'user/user_deactivate/'+id;

        }
    });
}
function userDeActivition(id) {
    
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO ACTIVET THIS USER ! ARE YOU SURE ?</div>",
        buttons: {
            confirm: {
                label: 'YES, ACTIVATE',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = 'user/user_activate/'+id;

        }
    });
}
function cancle(url) {
    bootbox.confirm({
        message: "<div class='boot-header'>DO YOU REALLY WANT TO LEAVE WITHOUT APPLYING CHANGES ?</div><div class='boot-text'>All update will be lost</div>",
        buttons: {
            confirm: {
                label: 'LEAVE ANYWAY',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'STAY',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true)
                location.href = url;

        }
    });
}

$('#presentation_url').blur(function () {
    var str = $(this).val().split('v=');
    if (str[1] != '') {
        var image = "https://img.youtube.com/vi/" + str[1] + "/hqdefault.jpg";
        $("#presentation_image").attr('src', image);
    }
})


function publishQuestMission(id, m_id, status) {
    if (status == 'Ongoing') {
        bootbox.confirm({
            message: "<div class='boot-header'>YOU ARE ABOUT TO UNPUBLISH A DATA ENTRY ! ARE YOU SURE ?</div><div class='boot-text'>This data entry will be save in unpublished and won't be available into front anymore !</div>",
            buttons: {
                confirm: {
                    label: 'UNPUBLISHED',
                    className: 'boot-confirm'
                },
                cancel: {
                    label: 'CANCEL',
                    className: 'boot-no'
                }
            },
            callback: function (result) {
                if (result == true)
                    location.href = site_url + 'health_quest/health_quest_mission_draft/' + id + '/' + m_id;
            }
        });
    }
}

function publishQuest(id, status) {
    if (status == 'Published') {
        bootbox.confirm({
            message: "<div class='boot-header'>YOU ARE ABOUT TO UNPUBLISH A DATA ENTRY ! ARE YOU SURE ?</div><div class='boot-text'>This data entry will be save in unpublished and won't be available into front anymore !</div>",
            buttons: {
                confirm: {
                    label: 'UNPUBLISHED',
                    className: 'boot-confirm'
                },
                cancel: {
                    label: 'CANCEL',
                    className: 'boot-no'
                }
            },
            callback: function (result) {
                if (result == true)
                    location.href = site_url + 'health_quest/health_quest_published/' + id;
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: "backend/health_quest/health_quest_published_ajax",
            data: "id=" + id,
            dataType: "text",
            success: function (data) {
                if (data == 'success') {
                    bootbox.alert({
                        message: '<div class="boot-header"><div class="btn-group" role="group" aria-label="..."><button type="button" class="btn btn-default button_1 button_bg"><i class="fa fa-twitter" aria-hidden="true"></i>Invite with Twitter</button> <button type="button" class="btn btn-default button_1 button_bg1"><i class="fa fa-facebook" aria-hidden="true"></i>Invite with Facebook</button><button type="button" class="btn btn-default button_1 button_bg2">Copy share link</button><button type="button" class="btn btn-default button_1 button_bg3"><i class="fa fa-whatsapp" aria-hidden="true"></i>Invite with Whatsapp</button> <button type="button" class="btn btn-default button_1 button_bg4"><i class="fa fa-envelope" aria-hidden="true"></i>Invite with email</button></div></div>',
                        callback: function () {
                            location.reload();
                        }
                    });
                }
            }
        })


    }
}

$('#add_ebook').click(function () {
    $('#ebook_container').append($('#sample_ebook').html());
    $('.datepicker').datetimepicker();
})
$('.delete_ebook').live('click', function () {
    var eb_id = $(this).parents('.ebook_topbox').find('.eb_id').val();
    bootbox.confirm({
        message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY ! ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
        buttons: {
            confirm: {
                label: 'YES, DELETE',
                className: 'boot-confirm'
            },
            cancel: {
                label: 'CANCEL',
                className: 'boot-no'
            }
        },
        callback: function (result) {
            if (result == true) {
                var data = {'eb_id': eb_id}
                $.ajax({
                    type: "POST",
                    url: "backend/health_quest/deleteEbook",
                    data: data,
                    dataType: "text",
                    success: function (data) {
                        if (data == 'success') {
                            location.reload();
                        }
                    }
                })
            }


        }
    });

})
$('.save_ebook').live('click', function () {
    var publishDate = $(this).parents('.ebook_topbox').find('.eb_publish_date').val();
    var unpublishDate = $(this).parents('.ebook_topbox').find('.eb_unpublish_date').val();
    var title = $(this).parents('.ebook_topbox').find('.eb_title').val();
    var link = $(this).parents('.ebook_topbox').find('.eb_link').val();
    var eb_id = $(this).parents('.ebook_topbox').find('.eb_id').val();
    var hq_id = $('#hq_id').val();
    var data = {'publishDate': publishDate, 'unpublishDate': unpublishDate, 'title': title, 'link': link, 'hq_id': hq_id, 'eb_id': eb_id}
    $.ajax({
        type: "POST",
        url: "backend/health_quest/saveEbook",
        data: data,
        dataType: "text",
        success: function (data) {
            if (data == 'success') {
                location.reload();
            }
        }
    })
})

$('input[name="hqp_media_type"]').click(function () {
    if ($(this).val() == 'Image') {
        $('#post_media_video').hide();
        $('#post_media_image').show();

    } else {
        $('#post_media_image').hide();
        $('#post_media_video').show();
    }
});
$('input[name="signup_origin"]').click(function () {
    if ($(this).val() == 'Invite') {
        $('#godfather').show();

    } else {
        $('#godfather').hide();
    }
});
$('input[name="hqc_media_type"]').click(function () {
    if ($(this).val() == 'Image') {
        $('#post_media_video').hide();
        $('#post_media_image').show();

    } else {
        $('#post_media_image').hide();
        $('#post_media_video').show();
    }
});

function bulkDeleteAction(url) {

    var action = $('#actionButton').val();
    var ids = new Array();
    $("[id*='action_']").each(function (row, val) {
        if ($(this).hasClass('active') == true) {
            var id = $(this).attr('id').split('_');
            ids.push(id[1]);
        }
    })
    if (ids.length > 0) {
        if (action == 'Delete') {
            bootbox.confirm({
                message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY !ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
                buttons: {
                    confirm: {
                        label: 'YES, DELETE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {
                    if (result == true) {

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });

        } else if (action == 'Archive') {
            bootbox.confirm({
                message: "<div class='boot-header'>DO YOU REALY WANT TO ARCHIVE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in archive and won't be available into front anymore</div>",
                buttons: {
                    confirm: {
                        label: 'ARCHIVE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {

                    if (result == true) {
                        var currentLocation = window.location;
                        $.ajax({
                            type: "POST",
                            url: currentLocation + '/archive_date',
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });

        } else if (action == 'Restore') {
            bootbox.confirm({
                message: "<div class='boot-header'>DO YOU REALY WANT TO RESTORE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in published and this will be available into front</div>",
                buttons: {
                    confirm: {
                        label: 'RESTORE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {

                    if (result == true) {
                        var currentLocation = window.location;
                        $.ajax({
                            type: "POST",
                            url: currentLocation + '/restore_date',
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });
        }

    } else {
        alert('Please select any row');
    }

}




function participantBulkDeleteAction(url) {

    var action = $('#actionButton1').val();
    var action1 = $('#actionButton2').val();
    var action2 = $('#actionButton3').val();
    //alert(action);
    var ids = new Array();
    $("[id*='action_']").each(function (row, val) {
        if ($(this).hasClass('active') == true) {
            var id = $(this).attr('id').split('_');
            ids.push(id[1]);
        }
    })
    if (ids.length > 0) {
        if (action == 'Delete' || action1 == 'Delete' || action2 == 'Delete') {
            bootbox.confirm({
                message: "<div class='boot-header'>YOU ARE ABOUT TO REMOVE A DATA ENTRY !ARE YOU SURE ?</div><div class='boot-text'>You will not be able to retrive this data back !</div>",
                buttons: {
                    confirm: {
                        label: 'YES, DELETE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {
                    if (result == true) {

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });

        } else if (action == 'Archive') {
            bootbox.confirm({
                message: "<div class='boot-header'>DO YOU REALY WANT TO ARCHIVE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in archive and won't be available into front anymore</div>",
                buttons: {
                    confirm: {
                        label: 'ARCHIVE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {

                    if (result == true) {
                        var currentLocation = window.location;
                        $.ajax({
                            type: "POST",
                            url: currentLocation + '/archive_date',
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });

        } else if (action == 'Restore') {
            bootbox.confirm({
                message: "<div class='boot-header'>DO YOU REALY WANT TO RESTORE THIS DATA ENTRY ?</div><div class='boot-text'>This data entry will be save in published and this will be available into front</div>",
                buttons: {
                    confirm: {
                        label: 'RESTORE',
                        className: 'boot-confirm'
                    },
                    cancel: {
                        label: 'CANCEL',
                        className: 'boot-no'
                    }
                },
                callback: function (result) {

                    if (result == true) {
                        var currentLocation = window.location;
                        $.ajax({
                            type: "POST",
                            url: currentLocation + '/restore_date',
                            data: "ids=" + ids,
                            dataType: "text",
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }

                }
            });
        }

    } else {
        alert('Please select any row');
    }

}


function changeCompany() {
    var com = $('#allCompany').val();
    var href = window.location.href;
    location.href = 'dashboard/enterByComapany/'+com;
}