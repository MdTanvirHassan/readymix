<script type="text/javascript" src="js/common/jquery-ui.js"></script>
<style>
    .datatable-scroll {
        overflow-x: auto;
        overflow-y: visible;
    }
</style>
<div class="right_col" role="main" >
    <div class="">
        <div class="page-title">
            <div class="title_center">
                <h3>Report Module</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title clearfix">
                                        All reports
                                    </h4>
                                </div>

                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                    <div class="panel-body">
                                        <!--                <div class="pull-right"><button class="btn btn-danger" id="delete">Delete Selected</button></div>-->
                                        <table id="player_table" class=" table table-striped datatable-scroll table-bordered   responsive">
                                            <thead>

                                                <tr>
                                                    <th style="width:90px;">Report No</th>
                                                    <th>Report Name</th>
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                               <tr>
                                                   <td>1</td>
                                                   <td><a href="<?php echo site_url(); ?>report/materialStock"> Material Stock</a></td> 
                                                   
                                                </tr> 
                                                
                                                <tr>
                                                   <td>2</td>
                                                   <td><a href="<?php echo site_url(); ?>report/storeLedger">Stock Ledger Report</a></td> 
                                                   
                                                </tr> 
                                               
                                                
                                                <tr>
                                                   <td>3</td>
                                                   <td><a href="<?php echo site_url(); ?>report/binCartReport">Bin Card Report</a></td> 
                                                   
                                                </tr> 
                                                
                                                
                                                <tr>
                                                   <td>4</td>
                                                   <td><a href="<?php echo site_url(); ?>report/issueReport">Consumption Report</a></td> 
                                                   
                                                </tr> 
                                                
                                                
                                                <tr>
                                                   <td>5</td>
                                                   <td><a href="<?php echo site_url(); ?>report/adjustmentReport">Adjustment Report</a></td> 
                                                   
                                                </tr> 
                                                
                                                 <tr>
                                                    <td>6</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialRequisitionReport"> Material Requisition</a></td> 
                                                   
                                                </tr> 
                                                                                              
                                              
                                                <tr>
                                                    <td>7</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialBudgetReport">Material Budget Report</a></td> 
                                                   
                                                </tr>
                                                
                                               
                                                
                                                 <tr>
                                                    <td>8</td>
                                                    <td><a href="<?php echo site_url(); ?>report/mateialWorkOrderReport">Purchase Order Report</a></td> 
                                                   
                                                </tr>
                                                
                                                
                                                
                                                
                                               
                                                
                                                 <tr>
                                                    <td>9</td>
                                                    <td><a href="<?php echo site_url(); ?>report/ServiceWorkOrder">Service Work Order Report</a></td> 
                                                   
                                                </tr>  
                                                
                                                <tr>
                                                    <td>10</td>
                                                    <td><a href="<?php echo site_url(); ?>report/totalMaterialReceived">Total Material Received Report</a></td> 
                                                   
                                                </tr>  
                                               
                                               
                                                <tr>
                                                    <td>11</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialAverageRate">Material Average Rate Report</a></td> 
                                                   
                                                </tr>  
                                                <tr>
                                                    <td>12</td>
                                                    <td><a href="<?php echo site_url(); ?>report/serviceAverageRate">Service Average Rate Report</a></td> 
                                                   
                                                </tr>  
                                                 
                                                
                                                <tr>
                                                    <td>13</td>
                                                    <td><a href="<?php echo site_url(); ?>report/supplierLedgerReport">Supplier Ledger Report</a></td> 
                                                   
                                                </tr> 
                                                
                                                <tr>
                                                    <td>14</td>
                                                    <td><a href="<?php echo site_url(); ?>report/consumptionComparisonReport">Consumption Comparison Report</a></td> 
                                                   
                                                </tr>  
                                                
                                                 <tr>
                                                    <td>15</td>
                                                    <td><a href="<?php echo site_url(); ?>report/pendingIndentReport">Pending Indent Report</a></td> 
                                                   
                                                </tr> 
                                                
                                               <tr>
                                                    <td>16</td>
                                                    <td><a href="<?php echo site_url(); ?>report/pendingMoneyIndentReport">Pending Money Indent Report</a></td> 
                                                   
                                               </tr>  
                                                
                                               <tr>
                                                    <td>17</td>
                                                    <td><a href="<?php echo site_url(); ?>report/pendingBudgetReport">Pending Budget Report</a></td> 
                                                   
                                               </tr>  
                                               
                                               <tr>
                                                    <td>18</td>
                                                    <td><a href="<?php echo site_url(); ?>report/cashPurchaseReport">Cash Purchase Report</a></td> 
                                                   
                                               </tr>  

                                               <tr>
                                                    <td>19</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialTransfer">Material Transfer</a></td> 
                                                   
                                                </tr>  
                                                <tr>
                                                    <td>20</td>
                                                    <td><a href="<?php echo site_url(); ?>report/purchaseInvoiceReport">Purchase Invoice Report</a></td> 
                                                   
                                                </tr>  
                                                
                                                <tr>
                                                    <td>21</td>
                                                    <td><a href="<?php echo site_url(); ?>report/invoiceAgingSummaryReport">Invoice (Payable) Aging Summary Report</a></td> 
                                                   
                                                </tr> 
                                                
                                                <tr>
                                                    <td>22</td>
                                                    <td><a href="<?php echo site_url(); ?>report/supplierBalanceReport">Supplier Balance Report</a></td> 
                                                   
                                                </tr>
                                                <tr>
                                                    <td>23</td>
                                                    <td><a href="<?php echo site_url(); ?>report/assetPurchaseReport">Asset Register Report</a></td> 
                                                   
                                                </tr> 
                                                
                                                 <tr>
                                                    <td>24</td>
                                                    <td><a href="<?php echo site_url(); ?>report/assetMovementReport">Asset Movement Report (Project Wise)</a></td> 
                                                   
                                                </tr>  
                                                 <tr>
                                                    <td>25</td>
                                                    <td><a href="<?php echo site_url(); ?>report/assetMovementMachineReport">Asset Movement Report (Machine Wise)</a></td> 
                                                   
                                                </tr>  
                                                
                                               
                                                
                                            <!--   
                                                <tr>
                                                    <td>14</td>
                                                    <td><a href="<?php echo site_url(); ?>report/pettyCashReceivedReport">Petty Cash Received Report</a></td> 
                                                   
                                                </tr>  
                                                
                                                <tr>
                                                    <td>15</td>
                                                    <td><a href="<?php echo site_url(); ?>report/expenseReport">Expense Report</a></td> 
                                                   
                                                </tr>  
                                            -->
                                                
                                                
                                            </tbody>
                                            
                                            
                                            <!--
                                            <tbody>

                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                       <a href="<?php echo site_url(); ?>report/storeLedger">Store Ledger Report</a>
                                                        <a href="<?php echo site_url(); ?>report/materialStock">Current Stock of Material</a>
                                                    </td> 
                                                   
                                                </tr> 
                                                
                                                 <tr>
                                                    <td>2</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialRequisitionReport"> Material Requisition</a></td> 
                                                   
                                                </tr> 
                                                
                                                <tr>
                                                    <td>3</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialRequisitionReport"> Material Requisition Approved and Done Report</a></td> 
                                                   
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialRequisitionValueReport"> Material Requisition Approved and Done with Value Report</a></td> 
                                                   
                                                </tr>
                                                
                                                <tr>
                                                    <td>5</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialBudgetReport">Material Budget Report</a></td> 
                                                   
                                                </tr>
                                                
                                                <tr>
                                                    <td>6</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialBudgetValueReport">Material Budget With Value Report</a></td> 
                                                   
                                                </tr> 
                                                
                                                 <tr>
                                                    <td>7</td>
                                                    <td><a href="<?php echo site_url(); ?>report/mateialWorkOrderReport">Material Work Order Report</a></td> 
                                                   
                                                </tr>
                                                
                                                <tr>
                                                    <td>8</td>
                                                    <td><a href="<?php echo site_url(); ?>report/mateialWOrkorderValueReport">Material Work Order With Value Report</a></td> 
                                                   
                                                </tr> 
                                                
                                                 <tr>
                                                    <td>9</td>
                                                    <td><a href="<?php echo site_url(); ?>report/ServiceWorkOrder">Service Work Order Report</a></td> 
                                                   
                                                </tr>  
                                                
                                                <tr>
                                                    <td>10</td>
                                                    <td><a href="<?php echo site_url(); ?>report/totalMaterialReceived">Total Material Received Report</a></td> 
                                                   
                                                </tr>  
                                                <tr>
                                                    <td>11</td>
                                                    <td><a href="<?php echo site_url(); ?>report/totalMaterialReceivedValue">Total Material Received With Value Report</a></td> 
                                                   
                                                </tr>  
                                                <tr>
                                                    <td>12</td>
                                                    <td><a href="<?php echo site_url(); ?>report/totalServicecompleted">Total Service completed Report</a></td> 
                                                   
                                                </tr>  
                                                <tr>
                                                    <td>13</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialAverageRate">Material Average Rate Report</a></td> 
                                                   
                                                </tr>  
                                                <tr>
                                                    <td>14</td>
                                                    <td><a href="<?php echo site_url(); ?>report/serviceAverageRate">Service Average Rate Report</a></td> 
                                                   
                                                </tr>  
                                                <tr>
                                                    <td>15</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialTransfer">Material Transfer</a></td> 
                                                   
                                                </tr>  
                                                <tr>
                                                    <td>16</td>
                                                    <td><a href="<?php echo site_url(); ?>report/materialTransferValue">Material Transfer Value</a></td> 
                                                   
                                                </tr>  
                                                
                                                
                                            </tbody>
                                            -->
                                            
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
