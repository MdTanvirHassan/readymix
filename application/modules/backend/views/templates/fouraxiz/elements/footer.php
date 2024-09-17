<!-- footer content -->
<footer>
    <div class="pull-right">
        Copyright @ By Karimgroup | Designed & Developed By <a href="http://4axiz.com">4axiz It Ltd</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<script src="<?php echo site_url(); ?>js/custom.min.js"></script>
<script src="<?php echo site_url(); ?>js/common/common.js"></script>
<link href="<?php echo site_url(); ?>vendors/datatables/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo site_url(); ?>vendors/datatables/responsive.dataTables.min.css" rel="stylesheet">
<link href=" https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo site_url(); ?>vendors/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>vendors/datatables/fnFilterClear.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>vendors/datatables/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>vendors/datatables/dataTables.responsive.min.js"></script>



<script src="<?php echo site_url(); ?>js/jquery_migrate.js"></script>
<style>
    .select2-input{height: 40px !important;}
.paging_full_numbers{
    width:400px !important;
}
</style>
<!-- Flot -->

<!-- JQVMap -->
<script>
    notification();
    function notification() {
        $.ajax({
            type: "POST",
            url: "backend/notification/notifications",
            dataType: "json",
            success: function (data) {
                 
                var tag ='';
                if (data.length) {

                    var count = data.length;
                    if(count != 0){
                      $('.badge').html(count);  
                    }
                    if(count>5){
                        $(".msg_list").css({"height": "300px", "overflow-y": "scroll"});
                    }
                   // alert('test');
                    
                    $.each(data, function (i, v) {
//                        var url=v.url;
//                        alert(url)
                        var str = v.title;
                        var url=v.url;
                        var title = str.substring(0, 16);
                        var rex = /(<([^>]+)>)/ig;
                        var str1 = v.notice;
                        var str2 = str1.replace(rex, " ");
                        var description = str2.substring(0, 30);
                        tag += '<li><a href="'+site_url+'notification/notice_update/'+v.id+'">';
                        tag +=' <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>';
                        tag +='<span>';
                        tag +='<span>'+title+'</span>';
                        tag +='</span>';
                        tag +='<span class="time">'+v.time+' </span>';
                        tag +=' <span class="message">'+description+'</span>';    
                        tag +=' </a></li>';
                        
                       
                    });
                    
//                    tag +=' <li>';
//                    tag +='<div class="text-center">';
//                    tag +='<a>';
//                    tag +='<strong>See All Alerts</strong>';
//                    tag +=' <i class="fa fa-angle-right"></i>';
//                    tag +='</a></div></li>';
                   
                }
                $('.msg_list').html(tag);
            }
        });
        setTimeout(notification, 12000);
    }
    
    
    $('.monthpicker').datetimepicker({
        format: 'YYYY-MM'
    });
    $('.yearpicker').datetimepicker({
        format: 'YYYY'
    });
    $('.datetimepicker').datetimepicker();
   // $('.datepicker').datepicker();
   
    $('.datepicker').datepicker({
              dateFormat: 'dd-mm-yy',
              maxDate: new Date
      });
      
  // $(".datepicker").datepicker({ maxDate: new Date });


    $('.number').on('input', function (event) {
        var val = $(this).val();
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.+$/, "");
        }
        $(this).val(val);
    });
    $('.selectAll').click(function () {
        if ($(this).hasClass('active') == false) {
            $('.datatable').find("[id*='action_']").each(function (row, val) {
                $(val).addClass('active');
            })
        } else {
            $('.datatable').find("[id*='action_']").each(function (row, val) {
                $(val).removeClass('active');
            })
        }
    });
    $('.monthpicker').datetimepicker({
        format: 'YYYY-MM'
    });
    $('.datepicker').datepicker();
    $('#datatable').dataTable({
         "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
         "pageLength": 100,
//        rowReorder: {
//            selector: 'td:nth-child(2)'
//        },
"order": [],
        "oLanguage": {"sSearch": ""},
        "fnDrawCallback": function () {
          //  $('#datatable4_info').prepend($('#datatable_length'));

        }, dom: 'Blfrtip',
        buttons: [
            {
                extend: "copy",
                className: "btn-sm", exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: "csv",
                className: "btn-sm", exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: "excel",
                className: "btn-sm", exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: "pdfHtml5",
                className: "btn-sm", exportOptions: {
                    columns: ':not(:last-child)',
                }, customize: function (doc) {
                    var colCount = new Array();
                    $('#datatable').find('tbody tr:first-child td').each(function () {
                        if ($(this).attr('colspan')) {
                            for (var i = 1; i <= $(this).attr('colspan'); $i++) {
                                colCount.push('*');
                            }
                        } else {
                            colCount.push('*');
                        }
                    });
                    doc.content[1].table.widths = colCount;
                }
            },
            {
                extend: "print", exportOptions: {
                    columns: ':not(:last-child)',
                },
                className: "btn-sm"
            },
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var col = 6;
            var is_amount = false;
            $('#datatable').find('thead').find('tr').find('th').each(function(i,v){
                if($(v).text()=='Amount'){
                    col = i;
                    is_amount = true;
                }
            })
            if(is_amount){
            $('#datatable').find('tfoot').remove();
            $('#datatable').append('<tfoot></tfoot>');
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( col )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( col, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $('#datatable').find('tfoot').html('<tr><th colspan="'+(col-1)+'" style="text-align:right"></th><th colspan="3">Sub Total : '+pageTotal.toFixed(2) +'  <br> Total : '+ total.toFixed(2) +'</th></tr>')
            // $( api.column( 8 ).footer() ).html(
            //     '$'+pageTotal +' ( $'+ total +' total)'
            // );
            }
        },
        
        responsive: true});
        
    $('.datatable').dataTable({
//        rowReorder: {
//            selector: 'td:nth-child(2)'
//        },
"order": [],
        "oLanguage": {"sSearch": ""},
        "fnDrawCallback": function () {
          //  $('#datatable4_info').prepend($('#datatable_length'));

        }, dom: 'Blfrtip',
        buttons: [
            {
                extend: "copy",
                className: "btn-sm", exportOptions: {
                    columns: "thead th:not(.noExport)"
                }
            },
            {
                extend: "csv",
                className: "btn-sm", exportOptions: {
                    columns: "thead th:not(.noExport)"
                }
            },
            {
                extend: "excel",
                className: "btn-sm", exportOptions: {
                    columns: "thead th:not(.noExport)"
                }
            },
            {
                extend: "pdfHtml5",
                className: "btn-sm", exportOptions: {
                    columns: "thead th:not(.noExport)"
                }, customize: function (doc) {
                    var colCount = new Array();
                    $('#datatable').find('tbody tr:first-child td').each(function () {
                        if ($(this).attr('colspan')) {
                            for (var i = 1; i <= $(this).attr('colspan'); $i++) {
                                colCount.push('*');
                            }
                        } else {
                            colCount.push('*');
                        }
                    });
                    doc.content[1].table.widths = colCount;
                }
            },
            {
                extend: "print", exportOptions: {
                    columns: "thead th:not(.noExport)"
                },
                className: "btn-sm"
            },
        ],
        responsive: true});
    $('div#datatable_filter input').attr('placeholder', 'Search');
    $('div#datatable_filter label').append('<span class="otherSearch glyphicon glyphicon-search"></span>');
         
       
         
         
    $(".os-tabs-controls").mCustomScrollbar({
        axis: "x",
        theme: "light-3",
        advanced: {autoExpandHorizontalScroll: true}
    });
    
   
 //Get window height and the sidebar-menu height
  
        var content = $(".right_col").height();
       $("#sidebar-menu").css("min-height", content + "px");




    
</script>
