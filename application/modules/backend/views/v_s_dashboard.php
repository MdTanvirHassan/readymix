<style>
    .highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
.highcharts-drilldown-axis-label{
        text-decoration: none !important;
    }
    .highcharts-credits{
        display:none;
    }
</style>  
<script src="<?php echo site_url(); ?>js/chart/highcharts.js"></script>
<script src="<?php echo site_url(); ?>js/chart/drilldown.js"></script>
<script src="<?php echo site_url(); ?>js/chart/exporting.js"></script>
<!-- page content -->
        <div class="right_col">
            
            
            <div class="col-md-6" style="margin-bottom:20px;">
                <input type="text" id="datepicker" class="form-control" value="<?php echo $year; ?>"/> 
                <div id="container"  style="min-width: 310px; height: 450px; margin: 0 auto">
                    
                </div>
            </div>
            <div class="col-md-6" style="margin-bottom:20px;">
    <div id="container1"  style="min-width: 310px; height: 450px; margin: 0 auto"></div>
            </div>
            <div class="col-md-12" style="margin-bottom:20px;">
    <div id="container2"  style="min-width: 310px; height: 450px; margin: 0 auto;margin-bottom: 50px;"></div>
            </div>
        </div>
        <!-- /page content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

  
        <script>
        // Create the chart

$("#datepicker").datepicker( {
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
}).on('changeDate', function(e){
    $(this).datepicker('hide');
    location.href = '<?php echo site_url('dashboard/s_dashboard'); ?>/'+$('#datepicker').val();
});
Highcharts.chart('container', {

    chart: {
        type: 'column'
    },

    title: {
        text: 'Invoce Status at - <?php echo $year; ?>'
    },

    xAxis: {
         categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ]
    },

    yAxis: {
        allowDecimals: true,
        min: 0,
        title: {
            text: 'Invoice Amount'
        }
    },

    tooltip: {
        formatter: function () {
            return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
        }
    },

    plotOptions: {
        column: {
            stacking: 'normal'
        }
    },

    series: [{
         name: 'Invoice Paid',
        data: <?php echo $paid; ?>,
        stack: 'male',
color: '#7cb5ec'
    }, {
        name: 'Invoice Unpaid',
        data: <?php echo $unpaid; ?>,
        stack: 'male',
        color: '#f7a35c'
    }]
});

Highcharts.chart('container1', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Invoce Payment Status (%) at - <?php echo $year; ?>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Payment History',
        data: [
            ['Paid', <?php echo $percent; ?>],
            ['Unpaid',  <?php echo $percent1; ?>]
           
        ]
    }]
});

Highcharts.chart('container2', {

    chart: {
        type: 'column'
    },

    title: {
        text: 'Sales Progress status - <?php echo $year; ?>'
    },

    xAxis: {
         categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Number of Order'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Product Costing',
        data: <?php echo $costing; ?>

    }, {
       name: 'Sales Quotation',
        data: <?php echo $quotation; ?>

    }, {
       name: 'Sales Order',
        data: <?php echo $so; ?>
    }, {
       name: 'Delivery Orders',
        data: <?php echo $do; ?>
    }, {
       name: 'Sales Invoice',
        data: <?php echo $si; ?>
    }]
});
        </script>