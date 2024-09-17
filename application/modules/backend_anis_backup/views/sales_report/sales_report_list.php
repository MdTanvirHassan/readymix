<script type="text/javascript" src="js/common/jquery-ui.js"></script>
<style>
    .datatable-scroll {
        overflow-x: auto;
        overflow-y: visible;
    }
</style>
<?php
$employee_id = $this->session->userdata('employeeId');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$userData = $this->m_common->get_row_array('users', array('id' => $user_id), '*');

?>
<div class="right_col" role="main">
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
                                        <table id="player_table" class=" table table-striped datatable-scroll table-bordered  responsive">
                                            <thead>

                                                <tr>
                                                    <th style="width:90px;">Report No</th>
                                                    <th>Report Name</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--  
                                              <?php
                                                $this->role = checkUserPermission(16, 77, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>   
                                                <tr>
                                                    <td>1</td>
                                                    <td><a href="<?php echo site_url(); ?>sales_report/salesOrderNotExecuted">Sales Orders Not Executed </a></td> 
                                                   
                                                </tr> 
                                                 <?php } ?>  
                                                
                                                
                                             <?php
                                                $this->role = checkUserPermission(16, 78, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>       
                                                <tr>
                                                    <td>2</td>
                                                    <td><a href="<?php echo site_url(); ?>sales_report/receivableSalesOrdersBeforeDelivery">Receivable Before Delivery</a></td> 
                                                   
                                                </tr> 
                                             <?php } ?>   
                                                
                                                
                                                
                                             <?php
                                                $this->role = checkUserPermission(16, 79, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>       
                                            
                                                <tr>
                                                    <td>1</td>
                                                    <td><a href="<?php echo site_url(); ?>sales_report/receivableSalesOrders">Receivable Till To Date</a></td> 
                                                   
                                                </tr> 
                                            <?php } ?>   
                                              -->

                                                <?php
                                                $this->role = checkUserPermission(16, 80, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>1</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/chequeInAccount">Total Cheque in Accounts</a></td>

                                                    </tr>
                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 81, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>2</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/handsToDeposit">Cheque/PO/BG/Lc in Hand</a></td>

                                                    </tr>

                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 81, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>3</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/handsToRealized">Cheque/PO/BG/Lc at Bank</a></td>

                                                    </tr>

                                                <?php } ?>
                                                    
                                                
                                                
                                                    
                                                <?php
                                                $this->role = checkUserPermission(16, 81, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>4</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/totalReceivingReport">Total Receiving </a></td>

                                                    </tr>

                                                <?php } ?>    
                                                    
                                                    
                                                    
                                                    
                                                <?php
                                                $this->role = checkUserPermission(16, 81, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>5</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/realizedCheque">Honored Cheque/PO/BG/Lc </a></td>

                                                    </tr>

                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 81, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>6</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/dishonoredChequeAtHand">Dishonored Cheque/PO/BG/Lc At Hand</a></td>

                                                    </tr>

                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 81, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>7</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/dishonoredCheque">All Dishonored Cheque/PO/BG/Lc </a></td>

                                                    </tr>

                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 81, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>8</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/cashReceived">Cash Received Report</a></td>

                                                    </tr>

                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 82, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>9</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/deliveredOrdersWithoutPayment">Delivered Orders (Without Payment/Security)</a></td>

                                                    </tr>
                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 83, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>10</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/allSalesOrder">All Sales Orders</a></td>
                                                    </tr>
                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 84, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>11</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/doBalanceReport">Delivery Orders (Balance) Report</a></td>
                                                    </tr>
                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 85, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>12</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/allDeliveryOrder">All Delivery Orders</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 86, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>13</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/allDeliveryChallan">Delivery Challans</a></td>
                                                    </tr>

                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 86, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>14</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/cancelChallan">Return/Replace Challans</a></td>
                                                    </tr>

                                                <?php } ?>


                                                <?php
                                                $this->role = checkUserPermission(16, 87, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>15</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/allDeliveryChallanTimewise">Delivery Challans Time Wise</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 88, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>

                                                    <tr>
                                                        <td>16</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/customerwiseChallan">Customer Wise Delivery Challans</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 89, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>17</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/targetReport">Sales Target Report</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 90, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>18</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/targetAchievementReport">Sales Target Achievement Report</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 91, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>19</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/challanInvoiceComparison">Challan and Inovice Comparison</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 92, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>20</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/invoiceSummaryReport">Sales Invoice Report</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 93, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>21</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/agingReport">Invoice Aging Report</a></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php
                                                $this->role = checkUserPermission(16, 94, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>22</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/agingSummaryReport">Invoice (Receivable) Aging Summary Report</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 95, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>23</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/receivableSummaryReport">Receivable Summary Report</a></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php
                                                $this->role = checkUserPermission(16, 95, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>24</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/customerBalanceReport">Customer Balance Report</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 95, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>25</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/customerAgingReport">Customer Wise Aging Report</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 95, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>26</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/unsecuredCustomer">Unsecured Customer Report</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 95, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>27</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/branchWiseSalesReport">Branch Wise Sales Report</a></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                $this->role = checkUserPermission(16, 95, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>28</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/customerLedgerReport">Customer Ledger Report</a></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php
                                                $this->role = checkUserPermission(7, 98, $userData);
                                                if (!empty($this->role) && !in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>29</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/salesCommission">Sales Commission Report</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>30</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/salesAchivementSummary">Sales Achivement Summary Report</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>31</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/salesAchivementDetails">Sales Achivement Details Report</a></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php
                                                $this->role = checkUserPermission(16, 86, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>32</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/castingWiseConsumption">Castingwise Consumtion</a></td>
                                                    </tr>

                                                <?php } 
                                                $this->role = checkUserPermission(7, 98, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>33</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/daily_statement">Daily Statement</a></td>
                                                    </tr>

                                                    <?php } 
                                                $this->role = checkUserPermission(7, 98, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>34</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/deposit_statement">Deposit Statement</a></td>
                                                    </tr>

                                                    <?php } 
                                                $this->role = checkUserPermission(7, 98, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>35</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/accounts_receivable">Accounts Receivable</a></td>
                                                    </tr>

                                                <?php } ?>
                                                    
                                               
                                                <?php 
                                                $this->role = checkUserPermission(7, 98, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>36</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/cancelInvoice">Cancel Sale Invoice Report</a></td>
                                                    </tr>

                                                <?php } ?>    
                                                    
                                                <?php 
                                                $this->role = checkUserPermission(7, 98, $userData);
                                                if (!in_array(11, $this->role)) {
                                                ?>
                                                    <tr>
                                                        <td>37</td>
                                                        <td><a href="<?php echo site_url(); ?>sales_report/misReport">Mis Report</a></td>
                                                    </tr>

                                                <?php } ?>     
                                                    
                                            </tbody>


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