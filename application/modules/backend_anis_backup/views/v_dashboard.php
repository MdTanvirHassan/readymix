  <!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <?php foreach ($projects as $project) { ?>
              <div class="col-lg-3 col-md-3">
                  <div class="panel panel-green">


                      <div class="panel-heading" style="background-color: #008B8B;">
                          <div class="row">
                              <div class="col-xs-3">
                                  <a href="<?php echo site_url('company_dashboard/enterByComapany/' . $project['d_id']); ?>">
                                      <?php if (!empty($project['logo']) && file_exists('assets/uploads/company_logo/' . $project['logo'])) { ?>
                                          <img style="width:50px; height:50px;" src="<?php echo site_url('assets/uploads/company_logo/' . $project['logo']); ?>">
                                      <?php } else { ?>
                                          <img style="width:50px;height:50px;" src="<?php echo site_url('images/dummy.jpg'); ?>" />
                                      <?php } ?></a><br>
                                  <h2 style="color:white;"><a style="color:white;" href="<?php echo site_url('company_dashboard/enterByComapany/' . $project['d_id']); ?>"><?php echo $project['dep_description']; ?></a></h2>
                              </div>
                              <div class="col-xs-9 text-right">

                              </div>

                          </div>
                      </div>


                      <div class="panel-footer">
                          <span class="pull-left"><a href="<?php echo site_url('company_dashboard/enterByComapany/' . $project['d_id']); ?>">View Details</a></span>
                          <span class="pull-left">&nbsp;&nbsp;&nbsp; <b><a href="<?php echo site_url('company_dashboard/enterByComapany/' . $project['d_id']); ?>"><button class="btn btn-success" style="font-size:11px;padding:4px ">Enter Here</button></a></b></span>

                          <div class="clearfix"></div>
                      </div>
                  </div>
              </div>
          <?php } ?>




      </div>
  </div>
  <!-- /page content -->