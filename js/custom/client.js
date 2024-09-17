$(document).ready(function () {
$('div.summernote').summernote();
    //$('button.multiselect').text('Task Name');

    var responsiveHelper = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    var tableElement = $('#project-table');
    tableElement.dataTable({
        "bJQueryUI": true,
        "bProcessing": true,
        "bServerSide": true,
        "sServerMethod": "GET",
        "sAjaxSource": "backend/client/load_client_data",
        "iDisplayLength": 10,
        "aLengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
        ],
        "aaSorting": [
        [0, 'desc']
        ],
        "sPaginationType": "full_numbers",
        "oTableTools": {
            "sSwfPath": "js/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
            "copy",
            "csv",
            "xls",
            {
                "sExtends": "pdf",
                "sTitle": "Report Name",
                "sPdfMessage": "Summary Info",
                "sPdfOrientation": "landscape",
                "fnClick": function (nButton, oConfig, flash) {
                    customName = 'sellsreport' + ".pdf";
                    flash.setFileName(customName);
                    this.fnSetText(flash,
                        "title:" + 'Name Of Company: ABC Construction Ltd' + "\n" +
                        "message:" + 'Report For Sales And Manegment System' + "\n" +
                        "colWidth:" + this.fnCalcColRatios(oConfig) + "\n" +
                        "orientation:" + oConfig.sPdfOrientation + "\n" +
                        "size:" + oConfig.sPdfSize + "\n" +
                        "--/TableToolsOpts--\n" +
                        this.fnGetTableData(oConfig)
                        );
                }
            },
            "print"
            ]
        },
        "fnDrawCallback": function () {
            $("a[id*='delete_']").click(function () {
                var splitedArray = $(this).attr('id').split('_');
                /*var r = confirm("Do Confirm To Delete!");
                if (!r) {
                    return false;
                }*/
                var aPos = oTable.fnGetPosition(this.parentNode.parentNode);
                var aData = oTable.fnGetData(aPos[0]);
                bootbox.confirm("Do you confirm to Delete!", function(r) {
                    if(r){
                        $.ajax({
                            type: "POST",
                            url: "backend/client/delete_clientdata",
                            data: "enq_id=" + splitedArray[1],
                            success: function (msg) {
                                oTable.fnDraw(false);
                            // oTable.fnDeleteRow(aPos[0]);
                            }
                        });
                    }
                })
            });

        },
        "aoColumns": [
        {
            "bVisible": true, 
            "bSearchable": true, 
            "bSortable": true
        },
        {
            "bVisible": true, 
            "bSearchable": true, 
            "bSortable": true
        },
        {
            "bVisible": true, 
            "bSearchable": true, 
            "bSortable": true
        },
        {
            "bVisible": true, 
            "bSearchable": true, 
            "bSortable": true
        },
        {
            "bVisible": true, 
            "bSearchable": false, 
            "bSortable": false
        }
        ],

        "oLanguage": {
            "sSearch": "Search all columns:"
        },
        "sDom": '<"clear">T<"H"Cr><"clear">lfrt<"F"ip>',
        fnPreDrawCallback: function () {
            if (!responsiveHelper) {
                responsiveHelper = new ResponsiveDatatablesHelper(tableElement, breakpointDefinition);
            }
        },
        fnRowCallback: function (nRow) {
            responsiveHelper.createExpandIcon(nRow);
        }
    }).columnFilter();
    $("tfoot input").keyup(function () {
        oTable.fnFilter(this.value, $("tfoot input").index(this));
    });
    $('table#project-table').find('tr th#lastaction input').remove();
    //$('table#project-table').find('tr th#firstaction input').remove();
    //tr th#firstaction
    // $('div.ui-toolbar:first').append('<a title="Add" id="add-item" data-toggle="modal" data-target="#myModal"   href="javascript:void(0)"><span class="add  glyphicon glyphicon-plus-sign btn-lg" style="float: right;margin-top: -15px; margin-right:10px;cursor: pointer;"></span></a><span style="float: right;margin-top: -6px;margin-right: 0px;background-color: #2A6496"><input title="All-Check" type="checkbox" class="allchk"></span><span id="delete" class="glyphicon glyphicon-remove-circle btn-lg" style="float: right;margin-right: 1%;margin-top: -15px;cursor: pointer"></span> <span id="help"  style="float: right;margin-top: -15px;cursor: pointer" class="glyphicon glyphicon-info-sign btn-lg"></span>'
    $('div.ui-toolbar:first').append('<a title="Add" id="add-item" data-toggle="modal" data-target="#myModal"   href="javascript:void(0)"><span class="add  glyphicon glyphicon-plus-sign btn-lg" style="margin-right: 2%;float: right; margin-top: -15px;cursor: pointer;"></span></a><span id="delete" title="Dleete All" class="glyphicon glyphicon-remove-circle btn-lg" style="float: right;margin-top: -15px;cursor: pointer"></span><span  style="float: right;margin-top: 0;margin-left: 2%;background-color: #2A6496"><input title="All-Check" type="checkbox" class="allchk"></span> '
        );
});

$('input.allchk').live('click', function () {
    var nodes = $('#project-table').dataTable().fnGetNodes();
    if ($(this).attr('checked')) {
        $('input.chk', nodes).attr("checked", true);
    } else {
        $('input.chk', nodes).attr("checked", false);
    }
})

$('span#delete').live('click', function () {
    var oTable = $('#project-table').dataTable();
    if ($('input.chk:checked', oTable.fnGetNodes()).length) {
        /*var r = confirm("Do Confirm To Delete!");
        if (!r) {
            return false;
        }*/
        bootbox.confirm("Do you confirm to Delete!", function(r) {
            if(r){
                var sData = $('input.chk:checked', oTable.fnGetNodes()).serialize();
                var aTrs = oTable.fnGetNodes();
                for (var i = 0; i < aTrs.length; i++) {
                    if ($('input.chk:checked', aTrs[i]).val()) {
                        $.ajax({
                            type: "POST",
                            url: "backend/client/delete_clientdata",
                            data: "enq_id=" + $('input.chk:checked', aTrs[i]).attr('id'),
                            success: function (msg) {
                                oTable.fnDraw(false);
                            }
                        });
                    }
                }
            }
        })
    } else {
        bootbox.alert("Row Select First!", function() { });
        //alert('Row Select First');
        return false;
    }
})


$('div#myModal input#add').live('click',function(e){
    var error = 0;
    if($('div#myModal input#title').val()==''){
        bootbox.alert('Please Enter Client title', function() { });
        return false;
        error = 1;
    }
    if($('div#myModal input#client').val()==''){
        bootbox.alert('Please Enter Client Name', function() { });
        return false;
        error = 1;
    }
    
    if($('div#myModal span#image').html()==''){
        bootbox.alert('Please upload Client image', function() { });
        return false;
        error = 1;
    }
    if($('div#myModal div.note-editor .note-editable').html()==''){
        bootbox.alert('Please Enter Client Description', function() { });
        return false;
        error = 1;
    }
    if(!error){
        e.preventDefault();
        var  newArray  = {
            title:$('div#myModal input#title').val(),
            client:$('div#myModal input#client').val(),
            image:$('div#myModal span#image').html(),
            details:$('div#myModal div.note-editor .note-editable').html()
        };
        
        $.post('backend/client/addClient', {
            data: newArray
        }, function (data) {
            
            if (data.success) {
                $('div#myModal').modal('hide');
                bootbox.alert(data.success, function() { });
            }else{
                bootbox.alert(data.error, function() { });
            }
            $('div#myModal input#title').val('');
            $('div#myModal input#client').val('');
            $('div#myModal div.viewimage').hide();
            $('div#myModal form#myForm').show();
            $('div#myModal div.note-editor .note-editable').html('');
            oTable.fnDraw(false);
        },'JSON');
    }
})

$('a.umodal').live('click', function () {
    var splitedArray = $(this).attr('id').split('_');
    $.ajax({
        type: "POST",
        url: "backend/client/edit_client",
        data: "edit_id=" + splitedArray[1],
        dataType: "json",
        success: function (data) {
            $(data).each(function (i, v) {
                $('div#updatemyModal div.modal-body input#title').val(v.title);
                $('div#updatemyModal div.modal-body input#client').val(v.client);
                $('div#updatemyModal div.modal-body input#image').attr('src','images/client_image/thumbnail/'+v.image);
                $('div#updatemyModal div.modal-body input#clientId').val(v.id);
                $('div#updatemyModal div.modal-body input#imageId').val(v.image);
                $('div#updatemyModal div.note-editor .note-editable').html(v.details);
              
            });
        }
    });
})

$('div#updatemyModal input#update').live('click', function (e) {
    var error = 0;
    if($('div#updatemyModal input#title').val()==''){
        bootbox.alert('Please Enter project title', function() { });
        return false;
        error = 1;
    }
    if($('div#updatemyModal input#client').val()==''){
        bootbox.alert('Please Enter Client Name', function() { });
        return false;
        error = 1;
    }
    
    if($('div#updatemyModal span#image').html()==''){
        bootbox.alert('Please upload Client image', function() { });
        return false;
        error = 1;
    }
    if($('div#updatemyModal div.note-editor .note-editable').html()==''){
        bootbox.alert('Please Enter Client Description', function() { });
        return false;
        error = 1;
    }
    if(!error){
        e.preventDefault();
        $.ajax({
            url: 'backend/client/updateClient',
            async: false,
            dataType: "json",
            data: {
                title: $.trim($('div#updatemyModal div.modal-body input#title').val()),
                client: $.trim($('div#updatemyModal div.modal-body input#client').val()),
                image: $.trim($('div#updatemyModal div.modal-body span#image').html()),
                previmage: $.trim($('div#updatemyModal div.modal-body input#imageId').val()),
                details: $.trim($('div#updatemyModal div.note-editor .note-editable').html()),
                id : $('div#updatemyModal div.modal-body input#clientId').val()
            },
            type: "POST",
            success: function (data) {
                $('div#updatemyModal').modal('hide');
                if (data.success) {
                    bootbox.alert(data.success, function() { });
                }else{
                    bootbox.alert(data.error, function() { });
                }
                $('div#updatemyModal input#title').val('');
                $('div#updatemyModal input#client').val('');
                $('div#updatemyModal div.note-editor .note-editable').html('');
                $('div#updatemyModal div.viewimage').hide();
                $('div#updatemyModal form#myForm').show();
                
                oTable.fnDraw(false);
            }
        })
    }
})


$('#myModal a#clickme').live('click', function () {
    $('#myModal input#file').click();
})

$('#myModal input#file').live('change', function (evt) {

    var fileName = evt.target.files[0].name;
    var fileArray = fileName.split('.');

    $('div#myModal #myForm').submit();
// $('div#loader').show();
});

function stopnewUpload(success, imageName) {
    if (success) {
        $('div#myModal div.viewimage').show();
        $('div#myModal div.viewimage').html('<span class="glyphicon glyphicon-paperclip"></span><span id="image" style="margin-left: 5px;">' + imageName + '</span>');
        //$('div#myModal div.viewimage').html('<img width="98%" src="uploads/'+imageName+'"> <span id="removeImage" class="glyphicon glyphicon-remove-circle" style="cursor: pointer;"></span>');
        $('div#myModal input#imageId').val(imageName);
        $('div#myModal form#myForm').hide();
    } else {
        alert('error On upload');
        return false;
    }
}


$('#updatemyModal a#clickme').live('click', function () {

    $('#updatemyModal input#file').click();
})

$('#updatemyModal input#file').live('change', function (evt) {

    var fileName = evt.target.files[0].name;
   
    var fileArray = fileName.split('.');
 
    $('div#updatemyModal #myForm').submit();
});
function stopUpload(success, imageName) {
    if (success) {
        //alert(imageName)
        $('div#updatemyModal div.viewimage').show();
        $('div#updatemyModal div.viewimage').html('<span class="glyphicon glyphicon-paperclip"></span><span id="image" style="margin-left: 5px;">' + imageName + '</span>');
        //<span class="glyphicon glyphicon-paperclip"></span>
        $('div#updatemyModal form#myForm').hide();
    } else {
        alert('error On upload');
        return false;
    }
}

$('a#add-item').live('click',function(){
    $('div#myModal input#title').val('');
    $('div#myModal input#client').val('');
    $('div#myModal div.note-editor .note-editable').html()
    $('div#myModal div.viewimage').hide();
    $('div#myModal form#myForm').show();
   
})