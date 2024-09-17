<div>
    <?php
    $rank = $this->session->userdata('rank');
    if ($rank == '1') {
        ?>    <!-- This is for Main Admin user-->
        <ul class="nav nav-pills">
            <li class=""><a href="backend/stadium/view_stadium"><i class="glyphicon glyphicon-eye-open"></i><span>Stadium</span></a></li>
            <li class=""><a href="backend/brand/view_brand"><i class="glyphicon glyphicon-eye-open"></i><span>Brand</span></a></li>
            <li class=""><a href="backend/concession/view_concession"><i class="glyphicon glyphicon-eye-open"></i><span>Concession Stands</span></a></li>
            <li class=""><a href="backend/order/orders"><i class="glyphicon glyphicon-eye-open"></i><span>Orders</span></a></li>
            <li class=""><a href="backend/users"><i class="glyphicon glyphicon-eye-open"></i><span>Users</span></a></li>
            <li class=""><a href="backend/reports"><i class="glyphicon glyphicon-eye-open"></i><span>Reports</span></a></li>
            <li class=""><a href="backend/dashboard/setting"><i class="glyphicon glyphicon-eye-open"></i><span>Setting</span></a></li>

        </ul>
    <?php } else if ($rank == '2') { ?><!-- This is for brand users -->
        <ul class="nav nav-pills">
            <li class=""><a href="backend/concession/view_concession"><i class="glyphicon glyphicon-eye-open"></i><span>Concession Stands</span></a></li>
            <li class=""><a href="backend/menu_category/view_category"><i class="glyphicon glyphicon-eye-open"></i><span>Item Category</span></a></li>
            <li class=""><a href="backend/food_item"><i class="glyphicon glyphicon-eye-open"></i><span>Food Item</span></a></li>
            <li class=""><a href="backend/order/orders"><i class="glyphicon glyphicon-eye-open"></i><span>Orders</span></a></li>
            <li class=""><a href="backend/reports"><i class="glyphicon glyphicon-eye-open"></i><span>Reports</span></a></li>
            <li class=""><a href="backend/dashboard/setting"><i class="glyphicon glyphicon-eye-open"></i><span>Setting</span></a></li>
        </ul>
    <?php } else if ($rank == '3') { ?> <!-- This is for concession Users -->

        <ul class="nav nav-pills">
            <li class=""><a href="backend/menu_category/view_category"><i class="glyphicon glyphicon-eye-open"></i><span>Item Category</span></a></li>
            <li class=""><a href="backend/food_item"><i class="glyphicon glyphicon-eye-open"></i><span>Food Item</span></a></li>
            <li class=""><a href="backend/order"><i class="glyphicon glyphicon-eye-open"></i><span>Food Order</span></a></li>
            <li class=""><a href="backend/order/orders"><i class="glyphicon glyphicon-eye-open"></i><span>Orders</span></a></li>
            <li class=""><a href="backend/reports"><i class="glyphicon glyphicon-eye-open"></i><span>Reports</span></a></li>
            <li class=""><a href="backend/dashboard/setting"><i class="glyphicon glyphicon-eye-open"></i><span>Setting</span></a></li>
        </ul>
    <?php } ?>

</div>

