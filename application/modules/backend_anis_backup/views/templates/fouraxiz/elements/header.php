
<?php if ($this->session->userdata('logged_in')) { ?>
    


    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"><?php echo lang('Toggle_navigation'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>


        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if ((!empty($page_name)) && ($page_name == 'dashboard')) echo 'class="active"'; ?>><a href="backend/dashboard">Dashboard</a></li>

                <li <?php if ((!empty($page_name)) && ($page_name == 'project')) echo 'class="active"'; ?>><a href="backend/project">Projects</a></li>
                <li <?php if ((!empty($page_name)) && ($page_name == 'client')) echo 'class="active"'; ?>><a href="backend/client">Clients</a></li>
                <li <?php if ((!empty($page_name)) && ($page_name == 'news')) echo 'class="active"'; ?>><a href="backend/news">News letter</a></li>
                <li <?php if ((!empty($page_name)) && ($page_name == 'testimonial')) echo 'class="active"'; ?>><a href="backend/testimonial">Testimonial</a></li>
                <li <?php if ((!empty($page_name)) && ($page_name == 'banner')) echo 'class="active"'; ?>><a href="backend/banner">Banner</a></li>
                <li <?php if ((!empty($page_name)) && ($page_name == 'description')) echo 'class="active"'; ?>><a href="backend/description">Description</a></li>
                <div class="btn-group" style="float: left;margin-top: 2%;">
                    <button class="btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        Category <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li <?php if ((!empty($page_name)) && ($page_name == 'parentCategory')) echo 'class="active"'; ?>><a href="backend/category">Parent Category</a></li>
                        <li <?php if ((!empty($page_name)) && ($page_name == 'subCategory')) echo 'class="active"'; ?>><a href="backend/category/subCategory">Sub Category</a></li>
                    </ul>
                </div>
                <li><a href="backend/dashboard/logout">Logout</a></li>
            </ul>

        </div><!-- /.navbar-collapse -->

    </nav>

<?php } ?>



