<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $current_user->first_name . ' ' . $current_user->last_name; ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $current_user_group[0]->description; ?>
                </a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!--        <form action="#" method="get" class="sidebar-form">-->
        <!--            <div class="input-group">-->
        <!--                <input type="text" name="q" class="form-control" placeholder="Search...">-->
        <!--              <span class="input-group-btn">-->
        <!--                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>-->
        <!--                </button>-->
        <!--              </span>-->
        <!--            </div>-->
        <!--        </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <?php if ($this->ion_auth->is_admin()): ?>
            <li class="<?php if ($this->uri->segment(1) == NULL) {
                echo "active";
            } ?>"><?php echo anchor("/", ' <i class="fa fa-tachometer"></i> <span>Dashboard</span>'); ?>
            </li>

            <li class="<?php if ($this->uri->segment(1) == "agency") {
                echo "active";
            } ?>"><?php echo anchor("agency/", ' <i class="fa fa-building-o" aria-hidden="true"></i> <span>Agencies</span>'); ?>
            </li>

            <li class="<?php if ($this->uri->segment(2) == "clients") {
                echo "active";
            } ?>"><?php echo anchor("projects/clients", ' <i class="fa fa-suitcase"></i> <span>Final clients</span>'); ?>
            </li>

            <li class="<?php if ($this->uri->segment(1) == "users") {
                echo "active";
            } ?>"><?php echo anchor("users/", ' <i class="fa fa-users"></i> <span>Users</span>'); ?>
            </li>
            <?php endif; ?>

            <li class="<?php if (($this->uri->segment(1) == "projects" && $this->uri->segment(2) == "") || ($this->uri->segment(1) == "projects" && $this->uri->segment(2) == "add") || ($this->uri->segment(1) == "projects" && $this->uri->segment(2) == "edit")) {
                echo "active";
            } ?>"><?php echo anchor("projects/", ' <i class="fa fa-suitcase"></i> <span>Projects</span>'); ?>
            </li>

            <?php if ($this->ion_auth->is_admin()): ?>
            <li class="<?php if ($this->uri->segment(1) == "form") {
                echo "active";
            } ?>"><?php echo anchor("form/", ' <i class="fa fa-check-square-o"></i> <span>Forms</span>'); ?>
            </li>
            <?php endif; ?>

            <li class="<?php if ($this->uri->segment(1) == "feedback") {
                echo "active";
            } ?>"><?php echo anchor("feedback/list_feedbacks", ' <i class="fa fa-commenting-o" aria-hidden="true"></i> <span>Feedbacks</span>'); ?>
            </li>

            <li class="<?php if ($this->uri->segment(1) == "reports") {
                echo "active";
            } ?>"><?php echo anchor("reports/agency", ' <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Reports</span>'); ?>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>