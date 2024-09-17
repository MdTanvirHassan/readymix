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
        "sAjaxSource": "backend/category/load_subCatecory_data",
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
                            url: "backend/category/delete_subCategorydata",
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
                            url: "backend/category/delete_subCategorydata",
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
    if($('div#myModal input#sub_cat_name').val()==''){
        bootbox.alert('Please Enter Sub Category Name', function() { });
        return false;
        error = 1;
    }
    
    if($('div#myModal select#category option:selected').val()==''){
        bootbox.alert('Please Select Category Name', function() { });
        return false;
        error = 1;
    }
    if($('div#myModal select#category option:selected').val()==0){
        bootbox.alert('Please Select Category Name', function() { });
        return false;
        error = 1;
    }
    if($('div#myModal div.note-editor .note-editable').html()==''){
        bootbox.alert('Please Enter sSub Category Description', function() { });
        return false;
        error = 1;
    }
    if(!error){
        e.preventDefault();
        var  newArray  = {
            name:$('div#myModal input#sub_cat_name').val(),
            category:$('div#myModal select#category option:selected').val(),
            desc:$('div#myModal div.note-editor .note-editable').html(),
            chk:$('div#myModal input#is_active').is(':checked')
        };
        
        $.post('backend/category/addSubCategory', {
            data: newArray
        }, function (data) {
            
            if (data.success) {
                $('div#myModal').modal('hide');
                bootbox.alert(data.success, function() { });
            }else{
                bootbox.alert(data.error, function() { });
            }
            $('div#myModal input#sub_cat_name').val('');
            $('div#myModal select#category').val(0);
            $('div#myModal div.note-editor .note-editable').html('');
            $('div#myModal input#is_active').attr("checked", false);
            oTable.fnDraw(false);
        },'JSON');
    }
})

$('a.umodal').live('click', function () {
    var splitedArray = $(this).attr('id').split('_');
    $.ajax({
        type: "POST",
        url: "backend/category/edit_subCategory",
        data: "edit_id=" + splitedArray[1],
        dataType: "json",
        success: function (data) {
            $(data).each(function (i, v) {
                $('div#updatemyModal div.modal-body input#sub_cat_name').val(v.sub_cat_Name);
                $('div#updatemyModal div.modal-body select#category').val(v.parent_cat_id);
                $('div#updatemyModal div.modal-body input#sub_cat_id').val(v.sub_cat_Id);
                $('div#updatemyModal div.note-editor .note-editable').html(v.sub_cat_description);
                if(v.is_active==1){
                    $('div#updatemyModal div.modal-body input#is_active').attr("checked", true);
                }else{
                    $('div#updatemyModal div.modal-body input#is_active').attr("checked", false);
                }
                
               
            });
        }
    });
})

$('div#updatemyModal input#update').live('click', function (e) {
    var error = 0;
    if($('div#updatemyModal input#sub_cat_name').val()==''){
        bootbox.alert('Please Enter Sub Category Name', function() { });
        return false;
        error = 1;
    }
    
    if($('div#updatemyModal select#category option:selected').val()==''){
        bootbox.alert('Please Select Category Name', function() { });
        return false;
        error = 1;
    }
    if($('div#updatemyModal select#category option:selected').val()==0){
        bootbox.alert('Please Select Category Name', function() { });
        return false;
        error = 1;
    }
    if($('div#updatemyModal div.note-editor .note-editable').html()==''){
        bootbox.alert('Please Enter sSub Category Description', function() { });
        return false;
        error = 1;
    }
    if(!error){
        e.preventDefault();
        $.ajax({
            url: 'backend/category/updateSubCategory',
            async: false,
            dataType: "json",
            data: {
                sub_cat_name: $.trim($('div#updatemyModal div.modal-body input#sub_cat_name').val()),
                cat_name: $.trim($('div#updatemyModal div.modal-body select#category').val()),
                cat_desc: $.trim($('div#updatemyModal div.note-editor .note-editable').html()),
                cat_id : $('div#updatemyModal div.modal-body input#sub_cat_id').val(),
                chk: $('div#updatemyModal div.modal-body input#is_active').is(':checked')
            },
            type: "POST",
            success: function (data) {
                $('div#updatemyModal').modal('hide');
                if (data.success) {
                    bootbox.alert(data.success, function() { });
                }else{
                    bootbox.alert(data.error, function() { });
                }
                $('div#updatemyModal input#sub_cat_name').val('');
                $('div#updatemyModal select#category').val('');
                $('div#updatemyModal div.note-editor .note-editable').html('');
                
                oTable.fnDraw(false);
            }
        })
    }
})

$('a#add-item').live('click',function(){
    $('div#myModal input#sub_cat_name').val('');
    $('div#myModal select#category').val(0);
    $('div#myModal div.note-editor .note-editable').html('');
    $('div#myModal input#is_active').attr("checked", false);
})